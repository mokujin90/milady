<?php
class MediaEditor extends CWidget
{
    public $data;
    public $script = "multimedia.js";
    public $view = 'mediaEditor';
    public $scale;
    public $scaleMode = 'in';
    public $hasfullscript = true;
    public $needfields = 'false';
    public $needbackground = 'true';
    public $fileUploadLimit = '5mb';
    public $fileUploadLimitText = '5 Мб';
    public $fileTypes = 'jpg,jpeg,png,gif';
    public $crop = false;
    public $callback = null;
    //public $min_size = array();

    public function run()
    {
        $this->registerClientScript();
        global $admin_preview_scale;

        if (!isset($this->data['mode'])) {
            $this->data['mode'] = 'single';
        }
        if ($this->data['mode'] != 'many' && $this->data['mode'] != 'single') {
            throw new Exception('Допускается mode many или single, по умолчанию single');
        };

        $new_items = array();
        if (!is_array($this->data['items'])) {
            $this->data['items'] = array($this->data['items']);
        };
        foreach ($this->data['items'] as $item) {
            if ($item) {
                $cAttr = array();
                $cAttr['file_url'] = $item->makeWebPath();
                if ($item->type == 1) {
                    $cAttr['preview_url'] = $item->makePreview(array("scale" => $this->scale, 'scaleMode' => $this->scaleMode));
                    $cAttr['preview_url'] = $cAttr['preview_url']['src'];
                }
                $cAttr['comment'] = '';
                $cAttr['source'] = '';

                $new_items[] = array_merge($item->attributes, $cAttr);
            }
        };
        $this->data['items'] = CJSON::encode($new_items);
        $this->data['needfields'] = $this->needfields;
        $this->data['needbackground'] = $this->needbackground;
//        if(count($this->min_size)>0){
//            $this->data['minheight'] = $this->min_size['height'];
//            $this->data['minwidth'] = $this->min_size['width'];
//        }
        $this->render($this->view, $this->data);
    }


    protected function registerClientScript()
    {
        $cs = Yii::app()->clientScript;
        if (!$this->hasfullscript) {
            $jsFile = Yii::app()->assetManager->publish(dirname(__FILE__) . '/js/browserplus-min.js');
            $cs->registerScriptFile($jsFile);
        }
        if ($this->script) {
            $jsFile = Yii::app()->assetManager->publish(dirname(__FILE__) . '/js' . DIRECTORY_SEPARATOR . $this->script);
            $cs->registerScriptFile($jsFile);
        }
        if ($this->crop) {
            $jsFile = Yii::app()->assetManager->publish(dirname(__FILE__) . '/js/jcrop/js/jquery.Jcrop.min.js');
            $cs->registerScriptFile($jsFile);
            $cssDir = Yii::app()->assetManager->publish(dirname(__FILE__) . '/js/jcrop/css/');
            $cs->registerCssFile($cssDir . '/jquery.Jcrop.css');
        }

        $jsFile = Yii::app()->assetManager->publish(dirname(__FILE__) . '/js/plupload.js');
        $cs->registerScriptFile($jsFile);
        $jsFile = Yii::app()->assetManager->publish(dirname(__FILE__) . '/js/plupload.html5.js');
        $cs->registerScriptFile($jsFile);
        $jsFile = Yii::app()->assetManager->publish(dirname(__FILE__) . '/js/plupload.html4.js');
        $cs->registerScriptFile($jsFile);
        $jsFile = Yii::app()->assetManager->publish(dirname(__FILE__) . '/js/plupload.flash.js');
        $cs->registerScriptFile($jsFile);
        $jsFile = Yii::app()->assetManager->publish(dirname(__FILE__) . '/js/plupload.gears.js');
        $cs->registerScriptFile($jsFile);
        $jsFile = Yii::app()->assetManager->publish(dirname(__FILE__) . '/js/plupload.silverlight.js');
        $cs->registerScriptFile($jsFile);
        $swfFile = Yii::app()->assetManager->publish(dirname(__FILE__) . '/js/plupload.flash.swf');
        $cs->registerScript('swfUrl', 'swf_file="' . $swfFile . '"');
        $xapFile = Yii::app()->assetManager->publish(dirname(__FILE__) . '/js/plupload.silverlight.xap');
        $cs->registerScript('silverlightUrl', 'xap_file="' . $xapFile . '"');
        $addImgFile = Yii::app()->assetManager->publish(dirname(__FILE__) . '/js/icons/add_swf.gif');
        $cs->registerScript('addImgUrl', 'addImg_file="' . $addImgFile . '"');
        //$cssFile=Yii::app()->assetManager->publish(dirname(__FILE__).'/css/multimedia.css');
        //$cs->registerCssFile($cssFile);
        //$delImgFile=Yii::app()->assetManager->publish(dirname(__FILE__).'/css/icons');
        $cssDir = Yii::app()->assetManager->publish(dirname(__FILE__) . '/css');
        $cs->registerCssFile($cssDir . '/multimedia.css');
    }

}

?>