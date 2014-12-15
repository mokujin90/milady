<?php

class FeedFilter extends CFormModel
{
    private $feedProjects = '';
    public $hideProjectByType = '';
    public static $type = array(
        'project_comment' => 'Комментарий',
        'region_news' => 'Новости регона',
        'project_news' => 'Новости проекта',
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

    public function apply(CActiveRecord &$user)
    {
        $projectArray = Candy::get($_REQUEST['project'],array());
        $projectArray = implode(',',$projectArray);

        $this->feedProjects = empty($projectArray) ? implode(',',
            CHtml::listData($user->favorites, 'id', 'id') +
            CHtml::listData($user->projects, 'id', 'id')
        ) : $projectArray;

        $sql = $this->selectRegionNews($user->region_id);
        if(!empty($this->feedProjects)){
            $sql = $sql->union($this->selectProjectComments()->getText());
            $sql = $sql->union($this->selectProjectNews()->getText());
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
