<?php

class BannerWidget extends CWidget
{
    public $regionId = null;
    public $bannerCount = 3;
    public $url = 'banner/view';


    /**
     * выбираем из таблицы BannerDivision набор слотов котрые нужно показвать (тек. раздел находится в $this->BannerDivision), далее баннеры которые нужно показывать в этих слотах и выводим их в foreach ом методом renderBanner()
     * @return bool|void
     */
    public function run()
    {
        $userBanner = Banner::model()->findActiveBanner($this->regionId, $this->bannerCount);
        foreach($userBanner as $banner){
            $this->renderBanner($banner);
        }
    }

    /**
     * Отрисовать один баннер по переданному модели UserBanner
     * @param UserBanner $userBanner
     */
    public function renderBanner(Banner $userBanner)
    {
        $bannerId = 'banner' . $userBanner->id;
        echo CHtml::openTag('div', array('class' => 'side-adv-block responsive-770',  'id' => $bannerId));
        echo CHtml::closeTag('div');

        $url = Yii::app()->createUrl($this->url, array('bannerId' => $userBanner->id));
        Yii::app()->clientScript->registerScript($bannerId, '$.getScript("' . $url . '");');
    }

    public static function renderImage($container, $src, $width, $height, $click_url)
    {
        $banner_html = '<img src="' . $src . '" alt="" width="' . $width . '" height="' . $height . '"/>';
        if (!empty($click_url)) {
            $banner_html = '<a href="' . $click_url . '" target="_blank" class="bounceIn animation-delay3">' . $banner_html . '</a>';
        }
        $banner_html = CJavaScript::quote($banner_html);
        $js = <<<EOD
            $('#$container').html("$banner_html");
EOD;
        return $js;
    }
}
