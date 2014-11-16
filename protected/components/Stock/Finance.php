<?php

/**
 * Компонент предназначенный для обращения в web-сервисам для считывания информации по стоимости акций
 * Class Finance
 */
class Finance extends Component
{
    /**
     * Параметр от которого зависит какой метод будет вызван (т.е. это id отдельной площадки - ЦБ, Forex и т.д.)
     * Хранится в таблице StockSection
     * @var null
     */
    public $key = null;

    /**
     * Параметры, чтобы мы могли понять акции какого объекта сейчас рассматриваются
     * Хранится в таблице Stock в сериализованном виде
     * @var array
     */
    public $params = array();

    private $stockId = null;
    private $url = '';
    private $formatDate = 'd/m/Y';

    private $stock = array();

    private static $nullablePrice = array('0.00');

    /**
     * Метод, который загрузит данные за указанный день (или за сегодня, если $date равен null)
     * @params  str|null $date в приемлимом формате типа "14.01.2014"
     */
    public function downloadStock($date = 'now')
    {
        $platforms = StockPlatform::model()->with('stocks')->active()->findAll();
        #перебирая платформы попробуем найти рабочие объекты для курсов
        foreach ($platforms as $platform) {
            if (count($platform->stocks) == 0 || $platform->key == '')
                continue;

            foreach ($platform->stocks as $model) {
                $action = "_request{$platform->key}"; //при таком варианте достаточно будет создавать отдельные методы select...()
                if (!is_callable(array($this, $action)))
                    continue;
                $this->stockId = $model->id;
                $this->params = unserialize($model->params);
                $data = $this->$action($date);
                #произошла ошибка или просто не было за это время данных
                if (!is_array($data))
                    continue;
                $history = new StockHistory();
                $history->attributes = $data;
                $history->save();
            }
        }

    }

    /**
     * Центробанк работа с валютами
     * Особенность работы в том, что на сегодня никогда нет катировок
     * @link http://www.cbr.ru/scripts/Root.asp?PrtId=SXML
     * @param $date
     * @return array
     */
    private function _requestCentralBank($date)
    {
        $this->url = 'http://www.cbr.ru/scripts/XML_dynamic.asp';
        $dateFrom = Candy::formatDate($date, $this->formatDate);
        $dateTo = Candy::editDate(Candy::formatDate($dateFrom, Candy::DATETIME, $this->formatDate), '+1 days', $this->formatDate);
        $requrl = "{$this->url}?date_req1={$dateFrom}&date_req2={$dateTo}&VAL_NM_RQ={$this->params['VAL_NM_RQ']}";

        $doc = file($requrl);
        $doc = implode($doc, '');

        $r = array();

        if (preg_match("/<ValCurs.*?>(.*?)<\/ValCurs>/is", $doc, $m))
            preg_match_all("/<Record(.*?)>(.*?)<\/Record>/is", $m[1], $r, PREG_SET_ORDER);

        $m = array();
        $d = array();

        for ($i = 0; $i < count($r); $i++) {
            if (preg_match("/Date=\"(\d{2})\.(\d{2})\.(\d{4})\"/is", $r[$i][1], $m)) {
                $dv = "{$m[1]}/{$m[2]}/{$m[3]}";
                if (preg_match("/<Nominal>(.*?)<\/Nominal>.*?<Value>(.*?)<\/Value>/is", $r[$i][2], $m)) {
                    $m[2] = preg_replace("/,/", ".", $m[2]);
                    $d[] = array($dv, $m[1], $m[2]);
                }
            }
        }

        $last = array_pop($d);
        $date = $last[0];
        $price = sprintf("%.2f", $last[2]);

        return in_array($price, self::$nullablePrice) ? false : array(
            'stock_id' => $this->stockId,
            'price' => $price,
            'date' => Candy::formatDate($date, Candy::DATETIME, $this->formatDate)
        );
    }

    private function _requestForex($date)
    {

    }
    #______________________________ Статические  методы ________________________#


    /**
     * Загрузить в таблицу данные с $dateFrom по сегодняшний день для всех возможных типов акций
     * При этом изначально данные удаляются из таблицы StockHistory
     * Обычно метод применяется один раз
     * @param $fromDate в формате MySQL
     */
    public static function reDownloadStock($dateFrom)
    {
        #очистка старых данных
        $dateFrom = Candy::formatDate($dateFrom, Candy::DATETIME);
        $criteria = new CDbCriteria();
            $criteria->addCondition('date > :date');
            $criteria->params = array(':date' => $dateFrom);
        StockHistory::model()->deleteAll($criteria);
        #рассчитаем интервалы в днях
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod(new DateTime($dateFrom), $interval, new DateTime('now'));
        $finance = new self;
        foreach ($period as $date)
            $finance->downloadStock($date->format(Candy::DATE));
    }

    /**
     * Конструтор для цепочки вызовов
     * @return Finance
     */
    public static function init()
    {
        return new self;
    }
}