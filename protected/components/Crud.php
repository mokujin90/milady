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
     * @param array $params массив с ключами min,max,from,to
     * @param array $htmlOptions
     */
    public static function activeRange(CModel $model, $attribute, $params=array(),$htmlOptions=array()){
        $html = parent::textField(parent::activeName($model,$attribute), '',
            array('class'=>'crud slider',
                'data-min'=>$params['min'],'data-max'=>$params['max'],
                'data-from'=>$params['from'],'data-to'=>$params['to'])
        );
        return $html;
    }
}