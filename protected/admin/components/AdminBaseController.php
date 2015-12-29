<?php
class AdminBaseController extends BaseController
{
    public $menu;
    public $breadcrumbs;
    public $mainMenuActiveId;
    public $pageIcon;
    public $pageCaption;
    public $defaultAction = 'index';
    public $activeMenu = array();
    public $layout = 'adminLayout';

    public function init()
    {
        Yii::app()->setComponent('user', Yii::app()->adminUser);
    }

    public function filters()
    {
        return array(
            'accessControl - login',
            'init - login, logout',
            //'roleAccessControl - login, logout'
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }


    public function filterInit($filterChain)
    {
        if (!($this->user = AdminUser::model()->findByPk(Yii::app()->user->id))) {
            Yii::app()->user->logout(false);
            Yii::app()->user->loginRequired();
        }

        $filterChain->run();
    }

    public function returnUrl($action = '')
    {
        $return_url = '/admin';
        if (!empty($_SERVER['HTTP_REFERER'])) {
            if (Yii::app()->request->hostInfo . Yii::app()->request->requestUri == $_SERVER['HTTP_REFERER']) {
                if (isset($_POST['return_url'])) {
                    $return_url = $_POST['return_url'];
                }
            } else {
                $return_url = $_SERVER['HTTP_REFERER'];
            }
        } else {
            if ($action) {
                $return_url = $this->createUrl($action);
            }
        }

        return $return_url;
    }

    public function redirectByRole()
    {
        $this->redirect('/admin/Site');
    }

    public function getPagetitle()
    {
        return Yii::app()->name;
    }

    public function updatePageSize(){
        if ( isset( $_GET[ 'pageSize' ] ) )
        {
            Yii::app()->user->setState( 'pageSize', (int) $_GET[ 'pageSize' ] );
            unset( $_GET[ 'pageSize' ] );
        }
    }


    public function getSideMenu(){
        return array(
            array(
                'id' => 'index',
                'title' => 'Главная',
                'icon' => 'cube',
                'url' => 'adminSite/index'
            ),
            array(
                'id' => 'region',
                'title' => 'Регионы',
                'icon' => 'cubes',
                'url' => 'adminRegion/index'
            ),
            array(
                'id' => 'project',
                'title' => 'Проекты',
                'icon' => 'cube',
                'url' => 'adminProject/index'
            ),
            array(
                'id' => 'content',
                'title' => 'Контент',
                'icon' => 'cubes',
                'items' => array(
                    array(
                        'id' => 'news',
                        'title' => 'Новости',
                        'icon' => 'cube',
                        'url' => 'adminNews/index'
                    ),
                    array(
                        'id' => 'analytics',
                        'title' => 'Аналитика',
                        'icon' => 'cube',
                        'url' => 'adminAnalytics/index'
                    ),
                    array(
                        'id' => 'library',
                        'title' => 'Библиотека',
                        'icon' => 'cube',
                        'url' => 'adminLibrary/index'
                    ),
                    array(
                        'id' => 'event',
                        'title' => 'События',
                        'icon' => 'cube',
                        'url' => 'adminEvent/index'
                    ),
                    array(
                        'id' => 'law',
                        'title' => 'Законодательство',
                        'icon' => 'cube',
                        'url' => 'adminLaw/index'
                    ),
                    array(
                        'id' => 'stat-content',
                        'title' => 'Контент',
                        'icon' => 'cube',
                        'url' => 'adminContent/index'
                    ),
                )
            ),
            array(
                'id' => 'adv',
                'title' => 'Реклама',
                'icon' => 'cubes',
                'items' => array(
                    array(
                        'id' => 'banner',
                        'title' => 'Баннеры',
                        'icon' => 'cube',
                        'url' => 'adminBanner/index'
                    ),
                    array(
                        'id' => 'feed',
                        'title' => 'Объявления',
                        'icon' => 'cube',
                        'url' => 'adminFeedBanner/index'
                    ),
                    array(
                        'id' => 'stat-banner',
                        'title' => 'Статические банеры',
                        'icon' => 'cube',
                        'url' => 'adminStaticBanner/index'
                    ),
                    array(
                        'id' => 'slider',
                        'title' => 'Слайдер',
                        'icon' => 'cube',
                        'url' => 'adminSlider/index'
                    ),
                )
            ),
            array(
                'id' => 'user',
                'title' => 'Пользователи',
                'icon' => 'cube',
                'items' => array(
                    array(
                        'id' => 'user-list',
                        'title' => 'Список',
                        'icon' => 'cube',
                        'url' => 'adminUser/index'
                    ),
                    array(
                        'id' => 'message',
                        'title' => 'Сообщения',
                        'icon' => 'cube',
                        'url' => 'adminMessages/inbox'
                    ),
                    array(
                        'id' => 'feedback',
                        'title' => 'Обратная связь',
                        'icon' => 'cube',
                        'url' => 'adminFeedback/index'
                    ),
                )
            ),
            array(
                'id' => 'setting',
                'title' => 'Настройки',
                'icon' => 'cube',
                'url' => 'adminSetting/index'
            ),
            array(
                'id' => 'stat',
                'title' => 'Статистика',
                'icon' => 'cubes',
                'items' => array(
                    array(
                        'id' => 'parsing',
                        'title' => 'Парсинг новостей',
                        'icon' => 'cube',
                        'url' => 'adminParserLog/index'
                    ),
                )
            ),
            array(
                'id' => 'admin-user',
                'title' => 'Администраторы',
                'icon' => 'cube',
                'url' => 'adminAdminUser/index'
            ),
            array(
                'id' => 'reference',
                'title' => 'Справочники',
                'icon' => 'cubes',
                'items' => array(
                    array(
                        'id' => 'city',
                        'title' => 'Города',
                        'icon' => 'cube',
                        'url' => 'adminCity/index'
                    ),
                    array(
                        'id' => 'transport',
                        'title' => 'Транспорт',
                        'icon' => 'cube',
                        'url' => 'adminReferenceTransport/index'
                    ),
                    array(
                        'id' => 'ReferenceIndustry',
                        'title' => 'Отрасли промышленности',
                        'icon' => 'cube',
                        'url' => 'adminReference/index?ref=ReferenceIndustry'
                    ),
                    array(
                        'id' => 'ReferenceNatureZone',
                        'title' => 'Природные зоны',
                        'icon' => 'cube',
                        'url' => 'adminReference/index?ref=ReferenceNatureZone'
                    ),
                    array(
                        'id' => 'ReferenceRegionCompany',
                        'title' => 'Компании (регионы)',
                        'icon' => 'cube',
                        'url' => 'adminReferenceCompany/index'
                    ),
                    array(
                        'id' => 'ReferenceRegionCompanyType',
                        'title' => 'Типы компаний (регионы)',
                        'icon' => 'cube',
                        'url' => 'adminReference/index?ref=ReferenceRegionCompanyType'
                    ),
                )
            ),
            array(
                'id' => 'statistic',
                'title' => 'Статистика по сайту',
                'icon' => 'cubes',
                'items' => array(
                    array(
                        'id' => 'statUser',
                        'title' => 'Пользователи',
                        'icon' => 'cube',
                        'url' => 'adminStatistic/index?ref=User'
                    ),array(
                        'id' => 'statBanner',
                        'title' => 'Банеры',
                        'icon' => 'cube',
                        'url' => 'adminStatistic/index?ref=Banner'
                    ),array(
                        'id' => 'statFeedBanner',
                        'title' => 'Реклама',
                        'icon' => 'cube',
                        'url' => 'adminStatistic/index?ref=FeedBanner'
                    ),array(
                        'id' => 'statNews',
                        'title' => 'Новости',
                        'icon' => 'cube',
                        'url' => 'adminStatistic/index?ref=News'
                    ),array(
                        'id' => 'statAnalytics',
                        'title' => 'Аналитика',
                        'icon' => 'cube',
                        'url' => 'adminStatistic/index?ref=Analytics'
                    ),array(
                        'id' => 'statEvent',
                        'title' => 'События',
                        'icon' => 'cube',
                        'url' => 'adminStatistic/index?ref=Event'
                    ),array(
                        'id' => 'statProject',
                        'title' => 'Проекты',
                        'icon' => 'cube',
                        'url' => 'adminStatistic/index?ref=Project'
                    )

                ),
            array(
                'id' => 'faq',
                'title' => 'FAQ',
                'icon' => 'cube',
                'url' => 'adminFAQ/index'
            ),
            array(
                'id' => 'comment',
                'title' => 'Комментарии',
                'icon' => 'cube',
                'url' => 'adminComment/index'
            ),
            array(
                'id' => 'group',
                'title' => 'Группы',
                'icon' => 'cube',
                'url' => 'adminGroup/index'
            ),
        )
        );
    }
}

?>
