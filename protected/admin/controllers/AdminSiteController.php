<?php
class AdminSiteController extends AdminBaseController
{
    public $defaultAction = 'index';

    protected function beforeAction($action){
        parent::beforeAction($action);
        $this->mainMenuActiveId = 'setting';
        $this->pageCaption = 'Главная';
        $this->activeMenu = array('index');
        return true;
    }

    public $widgets = array(
        'news' => array(
            'name' => 'Новости',
            'model' => 'News',
            'icon' => 'file-text-o'
        ),
        'analytics' => array(
            'name' => 'Аналитика',
            'model' => 'Analytics',
            'icon' => 'area-chart',
        ),
        'events' => array(
            'name' => 'События',
            'model' => 'Event',
            'icon' => 'file-text-o'
        ),
        'project' => array(
            'name' => 'Проекты',
            'model' => 'Project',
            'icon' => 'file-text-o'
        ),
        'project-comment' => array(
            'name' => 'Комментарии к проектам',
            'model' => 'Comment',
            'icon' => 'comment',
            'condition' => 'type = "project"'
        ),
        'news-comment' => array(
            'name' => 'Комментарии к новостям',
            'model' => 'Comment',
            'icon' => 'comment',
            'condition' => 'type = "news"'
        ),
        'analytics-comment' => array(
            'name' => 'Комментарии к статьям',
            'model' => 'Comment',
            'icon' => 'comment',
            'condition' => 'type = "analytics"'
        ),
        'adv' => array(
            'name' => 'Реклама',
            'model' => 'Banner',
            'icon' => 'star',
        ),
    );
    public function actionIndex()
    {
        $interval = array(
            'today' => array(
                'modify' => null,
                'sign' => '='
            ),
            'yesterday' => array(
                'modify' => ' 1 days',
                'sign' => '='
            ),
            '7days' => array(
                'modify' => '- 6 days',
                'sign' => '>='
            ),
            '30days' => array(
                'modify' => '- 23 days',
                'sign' => '>='
            ),
        );
        foreach ($this->widgets as $key => $item) {
            if($key == 'adv'){
                $criteria = new CDbCriteria();
                $criteria->addColumnCondition(array('status' => 'moderation'));
                $models[$key]['moderation'] = $item['model']::model()->count($criteria);

                $criteria = new CDbCriteria();
                $criteria->addColumnCondition(array('status' => 'approved'));
                $models[$key]['approved'] = $item['model']::model()->count($criteria);
                continue;
            }
            $limitDate = new DateTime();
            foreach ($interval as $intervalKey => $data) {
                if (!empty($data['modify'])) {
                    $limitDate->modify($data['modify']);
                }
                $criteria = new CDbCriteria();
                $criteria->addCondition('DATE(create_date) ' . $data['sign'] . ' "' . $limitDate->format('Y-m-d') . '"');
                if (isset($item['condition'])) {
                    $criteria->addCondition($item['condition']);
                }
                $models[$key][$intervalKey] = $item['model']::model()->count($criteria);
            }
        }
        $this->render('index',array('models' => $models));
    }
}

?>
