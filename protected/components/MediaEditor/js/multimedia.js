(function ($) {

    count = 0;

    function smart_replace(string, values) {
        for (var i in values) {
            string = string.replace(i, values[i]);
        }
        return string;
    }


    $.pluploadUploader = function (el, options, swfParams, newPatterns, uploaded_files, callback) {

        count++;

        var $this = this,
            defaults_swf_param = {
                runtimes: 'gears,html5,flash,silverlight,browserplus',
                /*max_file_size : '10mb',*/
                file_data_name: 'Filedata',
                multi_selection: false
                /*resize : {width : 320, height : 240, quality : 90},*/
                /*filters: [
                 {title: "Типы файлов", extensions: "jpeg"}
                 ]*/
            },
            defaults_patterns = {
                item: '<div class="ws_item">{image}</div>',
                wait_block: '$(\'<div class="pre_ajax" id="waitLoad"></div>\')'
            },
            default_settings = {
                mode: 'single',
                mustbe: false,
                status_load: "Фото {queue_num} из {queue}: {name} - загрузка ({percent}%)", // {num} - {queue_num} - {queue} - {limit}
                status_processing: "Фото {queue_num} из {queue}: {name} - идет обработка",
                status_default: "",
                error: {
                    upload_limit: "Вы пытаетесь добавить слишком много файлов"
                }
            };

        var scaleParams = {};
        var cropParams = {};
        var response = {};

        this.init = function (el, options, swfParams, newPatterns, uploaded_files, callback) {

            $this.num = 0;

            this.fName = $(el).attr('name');
            this.cName = $(el).attr('name').replace('[]', '') + count;

            this.settings = $.extend(default_settings, {
                fieldName: this.fName,
                cName: this.cName
            }, options);
            this.patterns = $.extend(defaults_patterns, newPatterns);

            if (options.scale) {
                scaleParams['scale'] = options.scale;
                scaleParams['scaleWidth'] = options.scale.split('x')[0];
                scaleParams['scaleHeight'] = options.scale.split('x')[1];
                scaleParams['scaleMode'] = options.scaleMode;
            }

            $(el).replaceWith($this.patterns.container(this.cName));

            this.settings = $.extend(this.settings,
                {
                    progress_div: $('#ws_' + this.cName + ' .ws_progress'),
                    container: $('#ws_' + this.cName + ' .ws_containerBox'),
                    item_container: $('#' + $this.patterns.item_container_id),
                    item_crop_container: $('#' + $this.patterns.item_crop_container_id),
                    add_button: $('#ws_addButton_' + this.cName)
                }
            )

            if (this.settings.mustbe && this.settings.mode == 'single') {
                this.settings.single_id = $('<input type="hidden" />').attr({
                    'name': $this.fName,
                    'value': '',
                    'class': 'fid'
                })
                $('#ws_' + this.cName + ' .ws_containerBox').parent().append(this.settings.single_id);
            }


            $('#ws_' + this.cName + ' .ws_progress').html(this.settings.status_default);
            this.settings.del = $('#ws_' + this.cName + ' .ws_delChecked');
            this.settings.del.click(function () {
                $this.delChecked();
                return false;
            });

            if ($this.settings.mode != 'many') {
                this.settings.del.hide();
            }

            this.swf_params = $.extend(defaults_swf_param, swfParams, {
                browse_button: 'ws_addButton_' + this.cName,
                container: 'ws_' + this.cName,
                max_file_size: this.settings.file_upload_limit
            });

            this.settings.add_button.css({
                'display': 'inline-block',
                'width': this.swf_params.button_width,
                'height': this.swf_params.button_height,
                'background': 'url(' + this.swf_params.button_image_url + ') no-repeat'
            });

            /* IOs6 crutch */
            this.swf_params.oldUrl = this.swf_params.url;

            var uploader = new plupload.Uploader(this.swf_params);

            this.attachUploaderEvents(uploader);

            uploader.init();

            if (typeof(uploaded_files) != "undefined" && uploaded_files.length != 0) {
                for (i in uploaded_files) {
                    this.addFile(uploaded_files[i], {animate: false});
                    $this.num++;
                }
            }

            if (callback) {
                callback.call(element);
            }
        }

        this.insertData = function (data) {
            var photoCont = $this.settings.item_container,
                img = photoCont.find('img');

            img.attr('src', data.preview_url);
        },

            this.attachUploaderEvents = function (uploader) {
                uploader.bind('QueueChanged', function (up, files) {
                    up.start();
                });
                uploader.bind('FileUploaded', function (up, file, info) {
                    var r = $.parseJSON(info.response);

                    r.widthRatio = r.width / r.preview_width;
                    r.heightRatio = r.height / r.preview_height;

                    $this.uploadStop();

                    up.stop();
                    up.refresh();

                    response = r;

                    if ($this.settings.item_crop_container.length) {
                        $this.cropOpen(r);
                    } else {
                        $this.addFile(r, {});
                    }

                });
                uploader.bind('UploadFile', function (up, file) {
                    /* IOs6 crutch */
                    this.settings.url = $this.swf_params.oldUrl + '&v=' + Math.round(Math.random() * 1000);

                    $this.uploadStart();
                });
                uploader.bind('Error', function (up, err) {
                    $this.uploadStop();
                    up.refresh(); // Reposition Flash/Silverlight

                    if (err.code == '-600') {
                        alert('Превышен максимальный размер файла: ' + this.settings.max_file_size_text);
                    } else if (err.code == '-601') {
                        alert('Неверный тип файла');
                    } else {
                        alert(err.code + ' ' + err.message);
                    }
                });

            }

        this.cropOpen = function (data) {
            var scaleTrue = [];
            $this.settings.item_crop_container.html($('<img />').attr({'src': data['preview_url']}));
            scaleTrue['width'] = true_scale.split('x')[0];
            scaleTrue['height'] = true_scale.split('x')[1];
console.log(scaleParams);
            $('img', $this.settings.item_crop_container).Jcrop({
                onSelect: function (c) {

                    cropParams = {'width': c.w, 'height': c.h, 'left_x': c.x, 'left_y': c.y};
                },
                aspectRatio:  scaleParams.scaleWidth==scaleParams.scaleHeight ? 1 :scaleTrue['width'] / scaleTrue['height'],
                'minSize': [Math.round(scaleParams.scaleWidth / data.widthRatio), Math.round(scaleParams.scaleHeight / data.widthRatio)],
                'setSelect': [0, 0, Math.round(scaleParams.scaleWidth / data.widthRatio), Math.round(scaleParams.scaleHeight / data.widthRatio)]

            });
            $this.settings.item_crop_container.data('pluploadUploader', $this);
            $this.settings.item_crop_container.dialog('open');
        }

        this.cropSave = function () {
            $.ajax({
                url: '/media/cropFile',
                type: 'POST',
                dataType: 'json',
                data: {'data': response, 'crop': cropParams, 'scale': scaleParams},
                error: function () {
                    alert('Произошла ошибка, попробуйте позднее или обратитесь к администраторам ресурса.');
                },
                success: function (data) {
                    $this.addFile(data, {});
                }
            });
        }

        this.uploadStart = function () {
            var s = $this.settings;

            $this.current_queue_num++;
            /*this.setStats({
             successful_uploads: $this.num
             });*/
            if ($this.settings.mode == 'many') {
                wait = eval($this.patterns.wait_block);
                $this.settings['container'].append(wait);
            }
            s.progress_div.html(s.status_load);
        }

        this.uploadStop = function () {
            var s = $this.settings;

            s.progress_div.empty();
        }

        this.delChecked = function () {
            if ($this.settings.mode == 'many') {
                if (confirm("Вы действительно хотите удалить выбранные фотографии?")) {
                    num = $('#ws_' + $this.cName + ' input:checked').parents('.outer_block').remove().end().length;
                    $this.num = $this.num - num;
                }
            } else {
                if (confirm("Вы действительно хотите удалить фотографию?")) {
                    num = $('#ws_' + $this.cName + ' .outer_block').remove().length;
                    $this.num = $this.num - num;
                    $this.num = 0;

                }
                if (this.settings.mustbe && this.settings.mode == 'single') {
                    this.settings.single_id.val('');
                }

                if ($this.settings.mode != 'many') {
                    this.settings.del.hide();
                }
            }

        }

        this.delAll = function () {
            if (confirm("Вы действительно хотите удалить фотографию?")) {
                $($this.settings.container).empty();
                $this.num = 0;
                if (this.settings.mustbe && this.settings.mode == 'single') {
                    this.settings.single_id.val('');
                }
            }
        }

        this.fileQueueError = function (fileObj, errorCode, message) {
            if (errorCode === SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED) {
                if ($this.settings.mode == 'many') {
                    alert($this.settings.error.upload_limit);
                } else {
                    $this.delCheked();
                }
            }
            else {
                alert('Ошибка при добавлении файла: fileQueueError ' + errorCode + message);
            }
        },

            this.uploadError = function (fileObj, errorCode, message) {
                if (errorCode === SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED) {
                    alert($this.settings.error.upload_limit);
                }
                $("#waitLoad").remove();
            },

            this.fileDialogComplete = function (numFilesSelected, numFilesQueued) {
                $this.current_queue_num = 0;
                if ($this.settings['mode'] != 'many' && numFilesQueued > 1) {
                    alert('В данном случае можно загружать только один файл.');
                    return false;
                }
                if (numFilesQueued > 0) {
                    this.startUpload();
                }
                $this.current_queue = numFilesSelected;
            },


            this.uploadProgress = function (fileObj, bytesLoaded) {

                var str = (percent == 100 ? str = $this.settings.status_processing : $this.settings.status_load);
                var message = smart_replace(str, {
                    '{num}': $this.num + 1,
                    '{limit}': $this.settings.file_upload_limit,
                    '{name}': fileObj.name,
                    '{percent}': percent,
                    '{queue}': $this.current_queue,
                    '{queue_num}': $this.current_queue_num
                })
                $($this.settings["progress_div"]).html(message);
            },

            this.uploadSuccess = function (fileObj, server_data) {
                var file_id = null;
                try {
                    data = json = window["eval"]("(" + server_data + ")");
                    file_id = data['id'];
                } catch (ex) {
                }
                if (!(file_id > 0)) {
                    alert("Не удалось добавить файл\r\nТект ответа сервера: " + server_data);
                }
                $this.addFile(data);
            },


            this.uploadComplete = function (fileObj) {
                if ($this.settings.mode == "many") $this.num++;

                if (this.getStats().files_queued > 0) {
                    this.startUpload();
                } else {
                    $($this.settings["progress_div"]).html($this.settings.status_default);
                }
            },

            this.addFile = function (data, _opt) {

                var input;
                var alink;
                var opt = $.extend({}, _opt);
                var realThis = $this;

                if ($this.settings.mode != 'many') {
                    this.settings.del.show();
                }
                if (opt['animate'] === false) {
                    $.fx.off = true;
                }

                if (data['ext'] == '.swf') {
                    try {
                        var customFn = $this.patterns.item_flash;
                    } catch (e) {
                        var customFn = $this.patterns.item;
                    }
                    try {
                        var item = customFn(data, $this.settings);
                    } catch (ex) {
                        alert('Ошибка клиентской функции создания файла.');
                    }
                    $(item).find("div.flash").flash({swf: data['file_url'], width: data['width'], height: data['height'] });
//					swfobject.embedSWF(data['file_url'], "myContent", "300", "120", "9.0.0", "expressInstall.swf");

                } else {
                    try {
                        item = $this.patterns.item(data, $this.settings);
                        item.wrap('<span id="wrap_' + $this.settings.cName + '">');
                        itemWrap = item.parent();
                    } catch (ex) {
                        alert('Ошибка клиентской функции создания файла.');
                    }
                }


                if (this.settings.mustbe && this.settings.mode == 'single') {

                    this.settings.single_id.val(data['id']);
                } else {
                    itemWrap.append($('<input type="hidden" />').attr({
                        'name': $this.fName,
                        'value': data['id'],
                        'class': 'fid'
                    }));
                }

                $("#waitLoad").remove();
                itemWrap.hide();


                if ($this.settings['mode'] != 'many') {
                    $this.settings['container'].empty()
                }
                //console.log($this.settings['item_container']);

                $this.settings['item_container'].html(itemWrap).trigger('added');

                //itemWrap.show('fast');
                itemWrap.css({display: 'inline'});
                $.fx.off = false;
            }


        this.init(el, options, swfParams, newPatterns, uploaded_files);
    };


    $.fn.pluploadUploader = function (options, swfParams, newPatterns, uploaded_files, callback) {
        this.each(function () {
            if (this.tagName == "INPUT") q = new $.pluploadUploader(this, options, swfParams, newPatterns, uploaded_files, callback);
        });

        return this;
    };

}(jQuery));
