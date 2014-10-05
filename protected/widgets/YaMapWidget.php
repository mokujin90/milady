<?php

/**
 * class YaMapWidget
 * @version 0.41
 * @author Sergei Gulin <gulin-sergei@ya.ru>
 *
 */

class YaMapWidget extends CWidget
{
	public $debug = false;
	public $options;
	public $tagName = 'div';
	public $scriptUrl = 'http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU';
	public $htmlOptions = array();
	public $width;
	public $height;
	public $defaultZoom = 16;
	public $defaultMapControls = array(
		array('controls'=>'zoomControl'),
		array('controls'=>'typeSelector'),
		array('controls'=>'mapTools'),
		array('controls'=>'smallZoomControl', 'position'=>array('right'=>'5px', 'top'=>'75px')),
		// array('controls'=>'searchControl'),
	);

	public function init()
	{
		$this->validateMapState();
		$this->validateMapControls();

		$js = $this->scriptMap();

		Yii::app()->clientScript->registerScriptFile($this->scriptUrl, CClientScript::POS_END);
		if(!$this->debug)
		{
			$js = self::reduceString($js);
		}

		Yii::app()->clientScript->registerScript('js', $js, CClientScript::POS_END);

		isset($this->htmlOptions['id']) ? $this->htmlOptions['id'] : $this->htmlOptions['id'] = $this->getId();
		if(!isset($this->options['mapState']['mapId']))
		{
			$this->options['mapId'] = $this->htmlOptions['id'];
		}
		$params = array(
			'|id|'=>$this->htmlOptions['id'],
			'|width|'=>substr($this->width,-1)=='%' ? $this->width : "{$this->width}px",
			'|height|'=>$this->height,
		);
		Yii::app()->clientScript->registerCss('yamap_css', strtr('div#|id| {width:|width|; height:|height|px;}', $params));
	}

	public function run()
	{
		$options = CJavaScript::encode($this->options);
		echo CHtml::openTag($this->tagName, $this->htmlOptions);
		echo CHtml::closeTag($this->tagName);
		Yii::app()->clientScript->registerScript('yamap_js',
			'ymaps.ready(init('.$options.'));'
		);
	}

	protected function validateMapState()
	{
		if(!isset($this->options['mapState']['center']))
		{
			throw new CException('Не определенны координаты или адрес объекта');
		}

		if(!isset($this->options['mapState']['zoom']))
		{
			$this->options['mapState']['zoom'] = $this->defaultZoom;
		}
	}

	protected function validateMapControls()
	{
		if(isset($this->options['mapControls']['default']) && $this->options['mapControls']['default'] === true)
		{
			$this->options['mapControls'] = $this->defaultMapControls;
		}
	}

	protected function scriptMap()
	{
		if(is_string($this->options['mapState']['center']))
		{
			$this->mapCode = strtr($this->geocodeTemplate,  array(':mapCode:'=>$this->mapCode));
		}

		$js = strtr($this->mapInit,  array(':mapCode:'=>$this->mapCode));
		$js = strtr($js,  array(':controls:'=>$this->controlsJs));
		$js = strtr($js,  array(':placemark:'=>$this->placemarkJs));

		return $js;
	}

	protected static function reduceString($str)
	{
		$str = preg_replace(array(
				'#^\s*//(.+)$#m',
				'#^\s*/\*(.+)\*/#Us',
				'#/\*(.+)\*/\s*$#Us'
			), '', $str);
		$str = preg_replace("/\s+/", " ", $str);
		return trim($str);
	}

	protected $mapCode = "
		var myMap = new ymaps.Map(options['mapId'], options['mapState']);
		var myCollection = new ymaps.GeoObjectCollection();

		:controls:
		:placemark:";

	protected $mapInit = "
		function init(options)
		{
			var yaMapFunc = function()
			{
				:mapCode:
				if(options['userFunc'] != undefined)
				{
					if(typeof(options['userFunc']) == 'function')
					{
						options['userFunc']();
					}
					else
					{
						options['userFunc'];
					}
				}
			};

			return yaMapFunc;
		}";

	protected $geocodeTemplate = "
		ymaps.geocode(options['mapState']['center'], { results: 1 }).then(
			function (res)
			{
				// Выбираем первый результат геокодирования
				var coords = res.geoObjects.get(0).geometry.getCoordinates();
				options['mapState']['center'] = coords;

				:mapCode:

			});
";

	protected $controlsJs = "
		if(options['mapControls'] != undefined)
		{
			for (var i = 0; i < options['mapControls'].length; i++)
			{
				myMap.controls.add(options['mapControls'][i]['controls'], options['mapControls'][i]['position']);
			};
		}
";

	protected $placemarkJs = "
	if(options['mapPlacemarks'] != undefined)
	{
		for (var i = 0; i < options['mapPlacemarks'].length; i++)
		{
			if(options['mapPlacemarks'][i]['geometry'] == undefined)
			{
				options['mapPlacemarks'][i]['geometry'] = options['mapState']['center'];
			}

			myPlacemark = new ymaps.Placemark(
				options['mapPlacemarks'][i]['geometry'],
				options['mapPlacemarks'][i]['properties'],
				options['mapPlacemarks'][i]['options']
			);
			myCollection.add(myPlacemark);

		myMap.geoObjects.add(myCollection);
		};
	}
";
}
