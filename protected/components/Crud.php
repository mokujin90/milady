<?php

class Crud extends CHtml
{

    public static function checkBox($name, $checked = false, $htmlOptions = array())
    {

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
        $htmlOptions['class'] .= ' crud';
        $htmlOptions['separator'] = Candy::get($htmlOptions['separator'],'');
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
        $htmlOptions['labels'] = empty($htmlOptions['labels']) ? array(Yii::t('main','Вкл'),Yii::t('main','Выкл')) :$htmlOptions['labels'];
        $label = $model->$attribute ? $htmlOptions['labels'][0] : $htmlOptions['labels'][1];
        $htmlOptions['class'] .= "crud";
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
    public static function activeRange(CModel $model,$attribute,array $params=array(),$htmlOptions=array()){
        $html = parent::activeTextField($model,$attribute,
            array('class'=>'crud slider',
                'data-min'=>$params['min'],'data-max'=>$params['max'],
                'data-from'=>$params['from'],'data-to'=>$params['to']));
        return $html;
    }
}