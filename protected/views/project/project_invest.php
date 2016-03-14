<?
/**
 *
 * @var $this SiteController
 * @var $project Project
 * @var $params array
 */
Yii::app()->clientScript->registerScript('init', 'projectDetailPart.init();', CClientScript::POS_READY);
$isFavorite = $project->isFavorite(); //начальное значение
?>
<div class="card-header">
    <img class="card-header__bg" src="/images/card/item-1.jpg" alt="Фон"/>
    <div class="card-header-right">
        <p class="card__company"><?=$project->getCompanyAttr('company_name');?></p>
        <div class="card-company-logo">
            <?= Candy::preview(array($project->logo, 'scale' => '187x157','class'=>'pos-center')) ?>
        </div><!--card-company-logo-->

    </div><!--card-header-right-->

    <p class="card__name"><?= $project->type != Project::T_SITE ? $project->name : $tmp[$project->{Project::$params[$project->type]['relation']}->site_type] ?></p>
    <p class="card__type">
        <i class="icon icon-card-type-1"></i>
        <span><?=$project->getProjectType()?></span>
    </p>

    <p class="card__viewed">
        <em><?=number_format($project->view_count);?></em> <?=Candy::getNumEnding($project->view_count,array(Yii::t('main','просмотр'),Yii::t('main','просмотра'),Yii::t('main','просмотров')));?>
    </p>
    <button class="blue-btn card__review"><?=Yii::t('main','Оставить отклик');?></button>

        <button data-project-id="<?=$project->id;?>" class="blue-btn card__favorites favorite <?if($isFavorite):?>add<?endif;?>"><?=Yii::t('main',$isFavorite ? "В избранном" : 'Добавить в избранное');?></button>



    <form class="card-recom" action="">
        <span class="card-recom__close"></span>
        <p class="card-recom__title"><?=Yii::t('main','Порекомендовать проект');?></p>
        <?=CHtml::textField('invite_email','',array('class'=>'card-recom__field','placeholder'=>'введите e-mail'));?>
        <button class="blue-btn card-recom__btn">Отправить</button>

    </form>

</div><!--card-header-->

<div class="card-data-wrap">
    <ul class="card-data-list">
        <li class="card-data-item">
                <span class="card-data-item__i-wrap">
                    <i class="icon icon-card-data-4"></i>
                </span>
            <span class="card-data-item__name"><?=Yii::t('main','Форма инвестиций');?></span>
            <div class="card-data-item__desc">
                <?foreach($model->investment->formFormat as $item):?>

                <?endforeach;?>
                <span>Долевое финансирование</span>
                <span>Долговое финансирование</span>
            </div><!--card-data-item__desc-->
        </li>

        <li class="card-data-item">
                <span class="card-data-item__i-wrap">
                    <i class="icon icon-card-data-5"></i>
                </span>
            <span class="card-data-item__name">Сумма инвестиций</span>
            <div class="card-data-item__desc">
                500 млн <i class="icon icon-rub-black"></i>
            </div><!--card-data-item__desc-->
        </li>

        <li class="card-data-item">
                <span class="card-data-item__i-wrap">
                    <i class="icon icon-card-data-6"></i>
                </span>
            <span class="card-data-item__name">Выручка</span>
            <div class="card-data-item__desc">
                5 300 млн <i class="icon icon-rub-black"></i>
            </div><!--card-data-item__desc-->
        </li>

        <li class="card-data-item">
                <span class="card-data-item__i-wrap">
                    <i class="icon icon-card-data-7"></i>
                </span>
            <span class="card-data-item__name">NPV</span>
            <div class="card-data-item__desc">
                1 035 млн <i class="icon icon-rub-black"></i>
            </div><!--card-data-item__desc-->
        </li>

        <li class="card-data-item">
                <span class="card-data-item__i-wrap">
                    <i class="icon icon-card-data-8"></i>
                </span>
            <span class="card-data-item__name">IRR</span>
            <div class="card-data-item__desc">
                45,5%
            </div><!--card-data-item__desc-->
        </li>

        <li class="card-data-item">
                <span class="card-data-item__i-wrap">
                    <i class="icon icon-card-data-9"></i>
                </span>
            <span class="card-data-item__name">Возврат инвестиций</span>
            <div class="card-data-item__desc">
                4 года
            </div><!--card-data-item__desc-->
        </li>

    </ul>

    <div class="card-data">
            <span class="card-data__icon-wrap">
                <i class="icon icon-card-data-1"></i>
            </span>
            <span class="card-data__name">
                Направление инвестиций
            </span>

        <div class="card-data__desc">
            <span>Капитальное строительство,</span>
            <span>закупка оборудования,</span>
                <span>
                    финансирование первоначального <br/>резерва оборотных средств.
                </span>

        </div><!--card-data__desc-->

    </div><!--card-data-->

    <div class="card-data">
            <span class="card-data__icon-wrap">
                <i class="icon icon-card-data-2"></i>
            </span>
            <span class="card-data__name">
                Основные условия финансирования
            </span>

        <div class="card-data__desc">
            <span>Выход ивестора из проекта в течении 6-ти лет. </span>
                <span>
                    Приоритетный выкуп доли инвестора <br/> инициатором проекта.
                </span>

        </div><!--card-data__desc-->

    </div><!--card-data-->

    <div class="card-data">
            <span class="card-data__icon-wrap">
                <i class="icon icon-card-data-3"></i>
            </span>
            <span class="card-data__name">
                Отрасль
            </span>

        <div class="card-data__desc">
            <span>Машиностроение и металлообработка.</span>

        </div><!--card-data__desc-->

    </div><!--card-data-->

</div><!--card-data-wrap-->

<div class="card-tabs-wrap tabs-wrap">
    <div class="card-tab-links tab-links">
        <span class="card-tab-link tab-link active" data-index="0">Финансовый план</span>
        <span class="card-tab-link tab-link" data-index="1">Производственный план</span>
        <span class="card-tab-link tab-link" data-index="2">Организационный план</span>
    </div><!--card-tab-links-->

    <div class="card-tabs tabs">
        <div class="card-tab tab active">
            <div class="statistic">
                <ul class="statistic-list">
                    <li class="statistic-item">
                            <span class="statistic-item__icon-wrap">
                                <i class="icon icon-statistic-1"></i>
                            </span>
                        <span class="statistic-item__name">Выручка*</span>
                    </li>

                    <li class="statistic-item">
                            <span class="statistic-item__icon-wrap">
                                <i class="icon icon-statistic-2"></i>
                            </span>
                        <span class="statistic-item__name">Чистая прибыль*</span>
                    </li>

                    <li class="statistic-item">
                            <span class="statistic-item__icon-wrap">
                                <i class="icon icon-statistic-3"></i>
                            </span>
                        <span class="statistic-item__name">EBITDA</span>
                    </li>

                </ul>

                <div class="statistic-table">
                    <p class="statistic-row-header">
                        <span class="statistic-col-1">1 год</span>
                        <span class="statistic-col-2">2 год</span>
                        <span class="statistic-col-3">3 год</span>
                    </p>

                    <p class="statistic-row">
                        <span class="statistic-col-1">1 000</span>
                        <span class="statistic-col-2">1 000</span>
                        <span class="statistic-col-3">1 000</span>
                    </p>

                    <p class="statistic-row">
                        <span class="statistic-col-1">1 000</span>
                        <span class="statistic-col-2">1 000</span>
                        <span class="statistic-col-3">1 000</span>
                    </p>

                    <p class="statistic-row">
                        <span class="statistic-col-1">1 000</span>
                        <span class="statistic-col-2">1 000</span>
                        <span class="statistic-col-3">1 000</span>
                    </p>

                    <p class="statistic-table__info">*миллионов Р</p>

                </div><!--statistic-table-->

            </div><!--statistic-->

            <div class="card-tab-right clear-fix">
                <p class="card-tab-right__title">Гарантии возврата инвестиций</p>
                <p class="card-tab-right__desc">
                    Текст в 160 символов. Цель проекта - создание нового
                    нструментального завода в Свердловской области. Проект
                    предполагает выпуск продукции следующих товарных групп:
                    Твердосплавный монолитный
                    режущий инструмент Быстрорежущий монолитный инструмент
                </p>

                <button class="blue-btn card-tab__btn">
                    <i class="icon icon-card-pdf"></i>
                    <span>Финансовый план</span>
                </button>

            </div><!--card-tab-right-->

        </div><!--card-tab-->

        <div class="card-tab tab">
            <div class="card-text">
                <p class="card-text__title">Предполагаемая к выпуску продукци</p>
                <p class="card-text__desc">
                    Текст в 500 символов. Цель проекта - создание нового
                    нструментального завода в Свердловской области. Проект
                    предполагает выпуск продукции следующих товарных групп:
                    Твердосплавный монолитный режущий инструмент Быстрорежущий
                    монолитный инструмент <br/>
                    Быстрорежущий биметаллический инструмент Корпусной
                    инструмент с механическим креплением пластин <br/>
                    Специальный  и сложнорежущий инструмент <br/>
                    Вспомогательный инструмент и технологическая оснастка
                </p>

            </div><!--card-text-->

            <div class="card-tab-right clear-fix card-tab-right_fix">
                <p class="card-tab-right__title">
                    Предполагаемый максимальный объем производства <br/>
                    млн. руб. \ Р (по видам продукции)
                </p>
                <p class="card-tab-right__desc">
                    Текст в 500 символов. Цель проекта - создание нового
                    нструментального завода в Свердловской области. Проект
                    предполагает выпуск продукции следующих товарных групп:
                    Твердосплавный монолитный
                    режущий инструмент Быстрорежущий монолитный инструмент
                </p>

                <button class="blue-btn card-tab__btn">
                    <i class="icon icon-card-pdf"></i>
                    <span>Производственный <br/> план</span>
                </button>

            </div><!--card-tab-right-->

        </div><!--card-tab-->

        <div class="card-tab tab">
            <div class="card-text">
                <p class="card-text__title">Предполагаемое капстроительство</p>
                <p class="card-text__desc">
                    Текст в 500 символов. Цель проекта - создание нового
                    нструментального завода в Свердловской области. Проект
                    предполагает выпуск продукции следующих товарных групп:
                    Твердосплавный монолитный режущий инструмент Быстрорежущий
                    монолитный инструмент Быстрорежущий биметаллический инструмент
                    Корпусной инструмент с механическим креплением пластин Специальный
                    и сложнорежущий инструмент Вспомогательный инструмент и технологическая оснастка
                    Технологическая оснастка и внутристаночная автоматизация.
                </p>

            </div><!--card-text-->

            <div class="card-tab-right clear-fix card-tab-right_mt">
                <button class="blue-btn card-tab__btn">
                    <i class="icon icon-card-pdf"></i>
                    <span>Организационный <br/> план</span>
                </button>

            </div><!--card-tab-right-->

        </div><!--card-tab-->

    </div><!--card-tabs-->

</div><!--card-tabs-wrap-->

<div class="card-block card-block_cont">
    <h2 class="card-block__title">
        <i class="icon icon-prof-3"></i>
        <span>Контактное лицо</span>
    </h2>

    <ul class="card-block-data card-block-data_first">
        <li>
            <span class="card-block-data__name">ФИО</span>
                <span class="card-block-data__desc">
                    Иванов Иван Иванович
                </span>
        </li>

        <li>
            <span class="card-block-data__name">Должность</span>
                <span class="card-block-data__desc">
                    Директор
                </span>
        </li>

    </ul>

    <ul class="card-block-data card-block-data_second">
        <li>
            <span class="card-block-data__name">Телефон</span>
                <span class="card-block-data__desc">
                    8 (495) 123-45-67
                </span>
        </li>

        <li>
            <span class="card-block-data__name">e-mail</span>
                <span class="card-block-data__desc">
                    infa@mail
                </span>
        </li>

    </ul>

</div><!--card-block-->

<div class="card-block card-block_comp">
    <h2 class="card-block__title">
        <i class="icon icon-prof-1"></i>
        <span>Компания</span>
    </h2>

    <ul class="card-block-data card-block-data_first">
        <li>
            <span class="card-block-data__name">Наименование</span>
                <span class="card-block-data__desc">
                    Название ООО
                </span>
        </li>

        <li>
            <span class="card-block-data__name">e-mail</span>
                <span class="card-block-data__desc">
                    info@mail
                </span>
        </li>

        <li>
            <span class="card-block-data__name">Отрасль</span>
                <span class="card-block-data__desc">
                    Название отрасли
                </span>
        </li>

    </ul>

    <ul class="card-block-data card-block-data_second">
        <li>
            <span class="card-block-data__name">Телефон</span>
                <span class="card-block-data__desc">
                    8 (495) 123-45-67
                </span>
        </li>

        <li>
            <span class="card-block-data__name">ИНН</span>
                <span class="card-block-data__desc">
                    123
                </span>
        </li>

        <li>
            <span class="card-block-data__name">ОГРН</span>
                <span class="card-block-data__desc">
                    123
                </span>
        </li>

    </ul>

</div><!--card-block-->

<div class="card-block card-block_doc">
    <h2 class="card-block__title">
        <i class="icon icon-prof-2"></i>
        <span>Документы</span>
    </h2>

    <div class="card-docs">
        <div class="card-docs__item">
            <i class="icon icon-doc-1"></i>
            <span>Организационный план</span>
        </div><!--card-docs__item-->

        <div class="card-docs__item">
            <i class="icon icon-doc-2"></i>
            <span>Производственный план</span>
        </div><!--card-docs__item-->

        <div class="card-docs__item">
            <i class="icon icon-doc-3"></i>
            <span>Презентация</span>
        </div><!--card-docs__item-->

    </div><!--card-docs-->

</div><!--card-block-->

<div class="card-block">
    <a class="card-block__regio-link" href="#">Страница региона</a>
    <h2 class="card-block__title">
        <i class="icon icon-prof-4"></i>
        <span>Место реализации проекта</span>
    </h2>

    <p class="card-block__address">
        Россия, Свердловская область, г. Екатеринбург, Промышленный проезд, 9
    </p>

    <div id="card-map"></div>

</div><!--card-block-->

<div class="card-block clear-fix card-block_about">
    <h2 class="card-block__title">
        <i class="icon icon-prof-5"></i>
        <span>Описание проекта</span>
    </h2>

    <iframe width="440" height="265" src="http://www.youtube.com/embed/FUgM105uN4c?rel=0" frameborder="0" allowfullscreen></iframe>

    <div class="card-about">
        <p class="card-about__desc">
            Цель проекта - создание нового инструментального завода в
            Свердловской области. Проект предполагает выпуск продукции
            следующих товарных групп: Твердосплавный монолитный режущий
            инструмент Быстрорежущий монолитный инструмент Быстрорежущий
            биметаллический инструмент Корпусной инструмент с механическим
            креплением пластин Специальный  и сложнорежущий инструмент
            Вспомогательный инструмент и технологическая оснастка
            Технологическая оснастка и внутристаночная автоматизация
        </p>

        <p class="card-about__desc">
            Цель проекта - создание нового инструментального завода
            в Свердловской области. Проект
            предполагает выпуск продукции следующих товарных групп:
        </p>

        <a class="card-about__view-all" href="#">Показать еще</a>

    </div><!--card-about-->

</div><!--card-block-->