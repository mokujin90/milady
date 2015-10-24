<?php

class FeedFilter extends CFormModel
{
    private $feedProjects = '';
    public $hideProjectByType = '';
    public static $type = array(
        'project_comment' => 'Комментарий',
        'analytics_comment' => 'Комментарий к статье',
        'news_comment' => 'Комментарий к новости',
        'region_news' => 'Новости региона',
        'project_news' => 'Новости проекта',
        'region_project' => 'Проект в регионе',
        'analytics' => 'Аналитика',
    );
    public static $typeTimelineIcon = array(
        'project_comment' => 'comment',
        'analytics_comment' => 'comment',
        'news_comment' => 'comment',
        'region_news' => 'file-text-o',
        'project_news' => 'file-text-o',
        'region_project' => 'file-text-o',
        'analytics' => 'area-chart',
    );
    public static $typeTimelineColor = array(
        'project_comment' => 'bg-success',
        'analytics_comment' => 'bg-info',
        'news_comment' => 'bg-warning',
        'region_news' => 'bg-warning',
        'project_news' => 'bg-danger',
        'region_project' => 'bg-danger',
        'analytics' => 'bg-info',
    );
    /*public function rules()
    {
        return array(
            array('status', 'safe')
        );
    }

    public function attributeLabels()
    {
        return array(
            'status' => 'Статус объекта',
        );
    }

    public function init()
    {

    }*/

    public function apply(CActiveRecord &$user, $type)
    {
        $projectArray = Candy::get($_REQUEST['project'],array());
        $projectArray = implode(',',$projectArray);

        $this->feedProjects = empty($projectArray) ? implode(',',
            CHtml::listData($user->favorites, 'project_id', 'project_id') +
            CHtml::listData($user->projects, 'id', 'id')
        ) : $projectArray;

        $sql = Yii::app()->db->createCommand();

        if($type == 'comment'){
            $sql = $this->selectNewsComments();
            $sql = $sql->union($this->selectAnalyticsComments()->getText());
            if (!empty($this->feedProjects)) {
                $sql = $sql->union($this->selectProjectComments()->getText());
            }
        } elseif($type == 'favorite'){
            $this->feedProjects = implode(',',CHtml::listData($user->favorites, 'project_id', 'project_id'));
            if (!empty($this->feedProjects)) {
                $sql = $this->selectProjectComments();
                $sql = $sql->union($this->selectProjectNews()->getText());
            }
        } elseif($type == 'region'){
            $sql = $this->selectRegionNews($user->region_id);
            $sql = $sql->union($this->selectRegionProjects($user->region_id)->getText());
        } elseif($type == 'group'){
        } elseif($type == 'project'){
            $this->feedProjects = implode(',',CHtml::listData($user->projects, 'id', 'id'));
            if (!empty($this->feedProjects)) {
                $sql = $this->selectProjectComments();
                $sql = $sql->union($this->selectProjectNews()->getText());
            }
        } else {
            $sql = $this->selectRegionNews($user->region_id);
            $sql = $sql->union($this->selectAnalytics()->getText());
            if (!empty($this->feedProjects)) {
                $sql = $sql->union($this->selectProjectComments()->getText());
                $sql = $sql->union($this->selectProjectNews()->getText());
            }
        }


        $sql->order('create_date DESC');
        return $sql;
    }

    private function selectProjectComments()
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("project_comment") as object_name, Comment.id, Project.name, Comment.text, Comment.create_date, Project.id as target_id')
            ->from("Comment")
            ->group('Comment.id')
            ->join('Project','Project.id = Comment.object_id AND Comment.type = "project"')
            ->where('Comment.type = "project" AND Project.id IN (' . $this->feedProjects . ') ' .
                (!empty($this->hideProjectByType) ? (' AND Project.type NOT IN (' . $this->hideProjectByType . ')'): '')
            );
        return $sql;
    }

    private function selectNewsComments()
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("news_comment") as object_name, Comment.id, News.name, Comment.text, Comment.create_date, News.id as target_id')
            ->from("Comment")
            ->group('Comment.id')
            ->join('News','News.id = Comment.object_id AND Comment.type = "news"')
            ->where('Comment.type = "news"');
        return $sql;
    }
    private function selectAnalyticsComments()
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("analytics_comment") as object_name, Comment.id, Analytics.name, Comment.text, Comment.create_date, Analytics.id as target_id')
            ->from("Comment")
            ->group('Comment.id')
            ->join('Analytics','Analytics.id = Comment.object_id AND Comment.type = "analytics"')
            ->where('Comment.type = "analytics"');
        return $sql;
    }

    private function selectProjectNews()
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("project_news") as object_name, ProjectNews.id, Project.name, ProjectNews.announce as text, ProjectNews.create_date, Project.id as target_id')
            ->from("ProjectNews")
            ->group('ProjectNews.id')
            ->join('Project','Project.id = ProjectNews.project_id')
            ->where('Project.id IN (' . $this->feedProjects . ') ' .
                (!empty($this->hideProjectByType) ? (' AND Project.type NOT IN (' . $this->hideProjectByType . ')'): '')
            );
        return $sql;
    }

    private function selectRegionNews($region)
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("region_news") as object_name, id, name, announce as text, create_date, NULL as target_id')
            ->from("News")
            ->where('is_active = 1 AND region_id = :region_id' ,
                array(':region_id' => $region));
        return $sql;
    }

    private function selectRegionProjects($region)
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("region_project") as object_name, id, name, name as text, create_date, NULL as target_id')
            ->from("Project")
            ->where('status = "approved" AND is_disable = 0 AND region_id = :region_id' ,
                array(':region_id' => $region));
        return $sql;
    }

    private function selectAnalytics()
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("analytics") as object_name, id, name, announce as text, create_date, NULL as target_id')
            ->from("Analytics")
            ->where('is_active = 1');
        return $sql;
    }
    
    public function getProjectList(CActiveRecord &$user){
        $this->feedProjects = implode(',',
            CHtml::listData($user->favorites, 'id', 'id') +
            CHtml::listData($user->projects, 'id', 'id')
        );
        $result = array();
        if(!empty($this->feedProjects)){
            $sql = $this->selectProjectComments();
            $sql = $sql->union($this->selectProjectNews()->getText());
            $sql = Yii::app()->db->createCommand()
                ->select('count(*) as project_events, target_id, name')
                ->from("(" . $sql->getText() . ") tmp")
                ->group('target_id');
            foreach ($sql->queryAll() as $project) {
                $result[$project['target_id']] = "{$project['name']} ({$project['project_events']})";
            }
        }
        return $result;
    }
}
