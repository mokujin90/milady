<?php

class Crud extends CHtml
{

    public static function checkBox($name, $checked = false, $htmlOptions = array(), $label = '')
    {
        $htmlOptions['class'] = (isset($htmlOptions['class']) ? $htmlOptions['class'] : '') . ' lk-crud';
        $htmlOptions['id'] = Makeup::id();
        return parent::checkBox($name, $checked, $htmlOptions) . parent::label($label, Makeup::id());
    }

    /**
     * Обычный активный список из радиокнопок, с той лишь разницей, что используется уже предрасположенный класс
     * @param CModel $model
     * @param string $attribute
     * @param array $data
     * @param array $htmlOptions
     * @return string
     */
    public static function activeRadioButtonList($model, $attribute, $data, $htmlOptions = array())
    {
        $htmlOptions['class'] = (isset($htmlOptions['class']) ? $htmlOptions['class'] : '') . ' crud';
        $htmlOptions['separator'] = Candy::get($htmlOptions['separator'], '');
        return parent::activeRadioButtonList($model, $attribute, $data, $htmlOptions);
    }

    /**
     * Переключатель в виде ползунка. Так же необходимо использовать js для смены текста
     * @param CModel $model
     * @param string $attribute
     * @param array $htmlOptions
     * @return string
     */
    public static function activeCheckBox($model, $attribute, $htmlOptions = array())
    {
        $label = $model->$attribute ? Yii::t('main','Вкл') :Yii::t('main','Выкл');
        $htmlOptions['class'] = Candy::get($htmlOptions['class'],'') . " crud";
        $htmlOptions['uncheckValue'] = Candy::get($htmlOptions['uncheckValue'],null); #отключим hidden-поля

        $html = parent::openTag('div', array('class' => 'swipe')) .
            parent::activeCheckBox($model, $attribute, $htmlOptions) .
            parent::label($label, CHtml::activeId($model, $attribute)) .
            parent::closeTag('div');
        return $html;
    }

    /**
     * @param CModel $model
     * @param str $attribute
     * @param array $params массив с ключами min,max
     * @param array $htmlOptions
     */
    public static function activeRange(CModel $model, $attribute, $params=array(),$htmlOptions=array()){
        $value = self::getRange($model->$attribute);
        $html = parent::textField(parent::activeName($model,$attribute), '',
            array('class'=>'crud slider',
                'data-min'=>$params['min'],'data-max'=>$params['max'],
                'data-from'=>$value['from'],'data-to'=>$value['to'])
        );

        return $html;
    }

    /**
     * Метод, который разобъет строку "12;25" на два элемента массива
     * @param $value
     */
    public static function getRange($value){
        $array =  is_array($value) ? $value : explode(';',$value);
        return array('from'=>$array[0],'to'=>$array[1]);
    }

    /**
     * request -> activeRecord[]
     * @param $modelName
     * @return CActiveRecord[]
     */
    public static function gridRequest2Models($modelName, $requestName = null){
        $requestName = $requestName ? $requestName : $modelName;
        $models = array();
        if(!isset($_REQUEST[$requestName]))
            return $models;
        $mainKey = reset($_REQUEST[$requestName]);
        foreach($mainKey as $key=>$item){
            $attributes = array();
            foreach($_REQUEST[$requestName] as $attrName=>$data){
                $attributes[$attrName] = $_REQUEST[$requestName][$attrName][$key];
            }
            if(count(array_filter($attributes))==0) //если ничего не написано - удалим
                continue;
            $model = new $modelName;
            $model->setAttributes($attributes,true);
            $models[] = $model;
        }
        return $models;
    }

    public static function gridRequest2Serialize($requestKey){
        $result = array();
        if(isset($_REQUEST[$requestKey])){
            foreach($_REQUEST[$requestKey] as $key=> $row){
                $result[$key] = $row[0];
            }

        }
        return serialize($result);
    }

}