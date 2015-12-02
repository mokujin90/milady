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
        $disabledWidgets = array();
        foreach (Admin2Widget::$widgets as $key => $item) {
            $disabled = false;
            if(!$this->user->canWidget($key)) continue;
            foreach ($this->user->admin2Widgets as $disabledWidget) {
                if ($disabledWidget->disabled_widget == $key) {
                    $disabled = true;
                    $disabledWidgets[] = $key;
                    break;
                }
            }
            if ($disabled) {
                continue;
            }
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
        $this->render('index',array('models' => $models, 'disabledWidgets' => $disabledWidgets));
    }

    public function actionDisableWidget($id) {
        $disableWidget = new Admin2Widget();
        $disableWidget->admin_id = $this->user->id;
        $disableWidget->disabled_widget = $id;
        $disableWidget->save();
        $this->redirect('index');
    }

    public function actionAddWidget($id) {
        Admin2Widget::model()->deleteAllByAttributes(array('disabled_widget' => $id, 'admin_id' => $this->user->id));
        $this->redirect('index');
    }
}