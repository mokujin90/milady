<?php

class Media extends CActiveRecord
{
    const CROP_SCALE='600x600';

    public static $path = 'data/mediadb/';

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getMedia()
    {
        return $this;
    }

    public function getComment()
    {
        return "";
    }

    public function tableName()
    {
        return 'Media';
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'parentmedia' => array(self::BELONGS_TO, 'Media', 'parent'),
            'medias' => array(self::HAS_MANY, 'Media', 'parent'),
        );
    }


    public function makeDirs()
    {
        $dir = substr(md5(Candy::dbName()), 0, 4);
        $path = Media::$path . $dir . '/' . $this->makePK2Path();

        if (!is_dir($path)) {
            mkdir($path, $mode = 0777, $recursive = true);
        }
        return $dir;
    }

    public function makePK2Path()
    {
        $path = str_pad($this->id, 10, "0", STR_PAD_LEFT);
        return substr($path, 0, 4) . '/' . substr($path, 4, 4) . '/';
    }

    public function makePath()
    {
        return Media::$path . $this->dir . '/' . $this->makePK2Path();
    }

    public function makeWebPath()
    {
        $path = '/' . $this->makePath() . $this->id . $this->ext;
        return $path;
    }

    public function makePreview($params)
    {
        $ext = $this->ext;
        $path = $this->makePath() . $this->id;
        $orig_path = $this->makePath() . $this->id . $ext;
        if (!file_exists($orig_path)) {
            return array("src" => '');
        }
        if (!file_exists($path)) {
            mkdir($path);
        }

        if (!isset($params['scaleMode'])) $params['scaleMode'] = 'out';
        if (!isset($params['scale'])) $params['scale'] = "";
        if (!isset($params['filter'])) $params['filter'] = '';
        if (!isset($params['upScale'])) $params['upScale'] = '';
        if (count($regs = implode('x',$params['scale']))!=2) {
            $params['scale'] = "";
        } else {
            $params['width'] = $regs[0];
            $params['height'] = $regs[1];
        }
        $path = $path . "/" . $params['scale'] . "_" . $params['scaleMode'] . '_' . $params['upScale'] . '_' . $params['filter'] . $ext;

        if (!file_exists($path)) {
            $image = Yii::app()->image->load($orig_path);
            if (strcmp($params['scale'], '') != 0) {
                $old_x = $image->width;
                $old_y = $image->height;

                # описывание
                if ($params['scaleMode'] == 'out') {

                    $default_ratio = ($params['width'] == 10000) || ($params['height'] == 10000);

                    if ($default_ratio) {
                        // "... принимаем эталонное соотношение 1.5 ширины к высоте"
                        $ratio_x = 3;
                        $ratio_y = 2;
                    } else {
                        $ratio_x = $params['width'];
                        $ratio_y = $params['height'];
                    }

                    if (round($old_x / $old_y, 1) != round($ratio_x / $ratio_y, 1)) {

                        $new_w1 = $old_x;
                        $new_h1 = round($old_x * $ratio_y / $ratio_x);
                        $new_w2 = round($old_y * $ratio_x / $ratio_y);
                        $new_h2 = $old_y;
                        if ($new_h1 > $old_y) {
                            $new_w = $new_w2;
                            $new_h = $new_h2;
                        } else {
                            $new_w = $new_w1;
                            $new_h = $new_h1;
                        }
                        $image->crop($new_w, $new_h);
                        $old_x = $new_w;
                        $old_y = $new_h;
                    }
                }

                $new_h = $params['height'];
                $new_w = $params['width'];

                if ($new_h <= $old_y || $new_w <= $old_x || $params['upScale'] == 1 || $params['upScale'] == true) {
                    $image->resize($new_w, $new_h, (($params['scaleMode'] == 'out') && !$default_ratio) ||
                        ($params['scaleMode'] == 'none') ? Image::NONE : Image::AUTO);
                }
            }
            if (strcmp($params['filter'], 'grayscale') == 0) {
                $image->grayscale();
            }
            $image->save($path);
        }
        //$image = Yii::app()->image->load($path);
        //return array("src" => "/" . $path, "image" => $image);

        return array("src" => "/" . $path, "path"=>$path);
    }


    public function crop($params)
    {
        $ext = $this->ext;
        $path = $this->makePath() . $this->id;
        $orig_path = $this->makePath() . $this->id . $ext;
        $path = $path . '_crop' . $ext;

        $image = Yii::app()->image->load($orig_path);
        $image->crop($params['width'], $params['height'], $params['left_y'], $params['left_x']);
        $image->save($path);
        return $path;
    }

    public function getTypeByExt($ext)
    {
        $ext = str_replace('.', '', $ext);
        if (in_array($ext, array("jpg", "jpeg", "gif", "png", "bmp"))) return 1;
        if (in_array($ext, array("flv", "mpeg", "avi"))) return 2;
        if (in_array($ext, array("wav", "mp3", "wave"))) return 3;
        if (in_array($ext, array("swf"))) return 4;
        return 0;
    }

    public function getMimeTypeByExt()
    {
        $ext = str_replace('.', '', $this->ext);
        if (in_array($ext, array("jpg", "jpeg"))) return 'image/jpeg';
        if (in_array($ext, array("gif"))) return 'image/gif';
        if (in_array($ext, array("png"))) return 'image/png';
        if (in_array($ext, array("bmp"))) return 'image/bmp';

        return '';
    }


    public static function upload($fieldName, $preview = array())
    {
        $res = array('error' => false, 'data' => null);

        if (isset($_FILES[$fieldName])) {
            $name = $_FILES[$fieldName]['tmp_name'];
            if (empty($name)) {
                $res['error'] = "Файл не является изображением";
                return $res;
            }
            $r_name = $_FILES[$fieldName]['name'];

            $model = new Media;
            $model->ext = strtolower(substr(basename($r_name), strrpos(basename($r_name), '.')));
            $model->type = $model->getTypeByExt($model->ext);
            $model->type = 1;
            $model->size = filesize($name);
            $model->create_date = date("Y.m.j H:i:s");

            $img_data = getimagesize($name);
            if ($img_data == false) {
                $res['error'] = "Файл не является изображением";
                return $res;
            } else {
                $model->width = $img_data[0];
                $model->height = $img_data[1];

                $img = Yii::app()->image->load($name);
                $img->strip();
            }

            $model->save();
            $model->dir = $model->makeDirs();
            $model->save();

            copy($name, $model->makePath() . $model->id . $model->ext);
            $res['data']['url'] = $model->makeWebPath();
            /*if ($model->type == 1) {
                $params = array("scale" => isset($_GET['scale'])?$_GET['scale']:Yii::app()->params['admin_preview_scale']);
                if (isset($_GET['scaleMode'])) {
                    $params['scaleMode'] = $_GET['scaleMode'];
                }
                $preview_url=$model->makePreview($params);
                $resp['preview_url'] = $preview_url['src'];
            }*/
            $res['data']['id'] = $model->id;
            $res['data']['width'] = $model->width;
            $res['data']['height'] = $model->height;
            if(count($preview)>0){
                $res['data']['preview'] = $model->makePreview($preview);
            }
        } else {
            $res['error'] = "Ошибка загрузки файла";
        }
        return $res;
    }
}