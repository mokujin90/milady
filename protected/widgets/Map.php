<?php

class Map extends CWidget
{
    public $htmlOptions = array();

    #Название места по которому будет центрироваться
    public $target = 'Москва';
    #Чем меньше тем более отдаленный зум
    public $zoom = 8;


    /**
     * @var Project[]
     */
    public $projects = array();
    #массив с обратным геокодированием по $this->target
    private $coordsCenter = array();
    private $coordsBalloon = array();
    #url для обратного геокодирования
    const NOMINATIM_URL = 'http://nominatim.openstreetmap.org/search?format=json&limit=1';

    public function run()
    {
        $this->setOptions();
        $this->setAssets();
        echo CHtml::openTag('div', $this->htmlOptions);
        echo CHtml::closeTag('div');
        $this->renderMap();
    }

    /**
     * Метод, который подготовит все параметры для дальнейшего использования
     */
    private function setOptions()
    {
        $this->setCoordsCenter();
        $this->setCoordsBalloon();
        $this->htmlOptions['id'] = $this->getId();
    }

    private function setAssets()
    {
        Yii::app()->clientScript->registerCssFile('/css/vendor/leaflet.css');
        Yii::app()->clientScript->registerScriptFile('/js/vendor/leaflet.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile('/js/map.js', CClientScript::POS_END);
    }

    private function setCoordsCenter()
    {
        $data = file_get_contents(self::NOMINATIM_URL . "&q=" . urlencode($this->target));
        $json = json_decode($data, true);
        $this->coordsCenter = $json[0];
    }

    private function setCoordsBalloon()
    {
        if (count($this->projects)) {
            foreach ($this->projects as $project) {
                if ($project->issetCoords()) {
                    $lat = $project->lat;
                    $lon = $project->lon;
                } else {
                    $lat = $this->coordsCenter['lat'];
                    $lon = $this->coordsCenter['lon'];
                }
                array_push($this->coordsBalloon, array('id' => $project->id, 'lat' => $lat, 'lon' => $lon));
            }
        }
    }

    private function renderMap()
    {
        $js = <<<JS
            var params = {
                id:'{$this->htmlOptions['id']}',
                lat:{$this->coordsCenter['lat']},
                lon:{$this->coordsCenter['lon']},
                zoom:{$this->zoom}
            }
            mapJs.init(params);
JS;
        if(count($this->coordsBalloon)){
            foreach($this->coordsBalloon as $balloon){
                $js .= <<<JS
            mapJs.addBalloon({
                lat:{$balloon['lat']},
                lon:{$balloon['lon']}
            });
JS;
            }

        }
        Yii::app()->clientScript->registerScript($this->id, $js, CClientScript::POS_END);
    }

}