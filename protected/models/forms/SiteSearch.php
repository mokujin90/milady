<?php

class SiteSearch extends CFormModel
{
    public $search = '';
    public $sort = null;
    public static $type = array(
        'project' => 'Проект',
        'project_comment' => 'Комментарий',
        'region_news' => 'Новости региона',
        'project_news' => 'Новости проекта',
        'global_news' => 'Новости',
        'analytics' => 'Аналитика',
        'event' => 'Мероприятия',
        'prof_opinion' => 'Проф. мнение',
        'law' => 'Законодат.',
        'library' => 'Библиотека',
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

    public function apply()
    {
        //$this->attributes = $_REQUEST[CHtml::modelName($this)];


        if(mb_substr($this->search,0,1)=='#'){
            $this->search = mb_substr($this->search,1);
            $sql = $this->selectTagNews();
            $sql = $sql->union($this->selectTagGlobalNews()->getText());
            $sql = $sql->union($this->selectTagAnalytics()->getText());
            $sql = $sql->union($this->selectTagEvents()->getText());
        }
        else{
            $sql = $this->selectNews();
            $sql = $sql->union($this->selectGlobalNews()->getText());
            $sql = $sql->union($this->selectProjects()->getText());
            $sql = $sql->union($this->selectProjectComments()->getText());
            $sql = $sql->union($this->selectProjectNews()->getText());
            $sql = $sql->union($this->selectAnalytics()->getText());
            $sql = $sql->union($this->selectEvents()->getText());
            //$sql = $sql->union($this->selectProfOpinion()->getText());
            $sql = $sql->union($this->selectLaw()->getText());
            $sql = $sql->union($this->selectLibrary()->getText());
        }
        if($this->sort =='date_up'){
            $sql->order('create_date ASC');
        }
        elseif($this->sort=='view_up'){
            $sql->order('view ASC');
        }
        elseif($this->sort=='view_down'){
            $sql->order('view DESC');
        }
        else{
            $sql->order('create_date DESC');
        }
        return $sql;
    }

    private function selectProjects()
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("project") as object_name, id, name, type as text, create_date, NULL as target_id,view_count as view')
            ->from("Project")
            ->where('name LIKE :search',
                array(':search' => "%$this->search%"));
        return $sql;
    }

    private function selectProjectComments()
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("project_comment") as object_name, Comment.id, Project.name, Comment.text, Comment.create_date, Project.id as target_id,NULL as view')
            ->from("Comment")
            ->group('Comment.id')
            ->join('Project','Project.id = Comment.object_id AND Comment.type = "project"')
            ->where('Comment.type = "project" AND (Comment.text LIKE :search)',
                array(':search' => "%$this->search%"));
        return $sql;
    }

    private function selectProjectNews()
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("project_news") as object_name, ProjectNews.id, Project.name, ProjectNews.announce as text, ProjectNews.create_date, Project.id as target_id,NULL as view')
            ->from("ProjectNews")
            ->group('ProjectNews.id')
            ->join('Project','Project.id = ProjectNews.project_id')
            ->where('ProjectNews.announce LIKE :search',
                array(':search' => "%$this->search%"));
        return $sql;
    }

    private function selectNews()
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("region_news") as object_name, id, name, announce as text, create_date, NULL as target_id, view')
            ->from("News")
            ->where('region_id IS NOT NULL AND is_active = 1 AND (name LIKE :search OR announce LIKE :search)',
                array(':search' => "%$this->search%"));
        return $sql;
    }

    private function selectGlobalNews()
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("global_news") as object_name, id, name, announce as text, create_date, NULL as target_id, view')
            ->from("News")
            ->where('region_id IS NULL AND is_active = 1 AND (name LIKE :search OR announce LIKE :search)',
                array(':search' => "%$this->search%"));
        return $sql;
    }

    private function selectAnalytics()
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("analytics") as object_name, id, name, announce as text, create_date, NULL as target_id, view')
            ->from("Analytics")
            ->where('is_active = 1 AND (name LIKE :search OR announce LIKE :search)',
                array(':search' => "%$this->search%"));
        return $sql;
    }

    private function selectTagNews()
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("region_news") as object_name, id, name, announce as text, create_date, NULL as target_id, view')
            ->from("News")
            ->where('region_id IS NOT NULL AND is_active = 1 AND (tags LIKE :search)',
                array(':search' => "%$this->search%"));
        return $sql;
    }

    private function selectTagGlobalNews()
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("global_news") as object_name, id, name, announce as text, create_date, NULL as target_id, view')
            ->from("News")
            ->where('region_id IS NULL AND is_active = 1 AND (tags LIKE :search)',
                array(':search' => "%$this->search%"));
        return $sql;
    }

    private function selectTagAnalytics()
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("analytics") as object_name, id, name, announce as text, create_date, NULL as target_id, view')
            ->from("Analytics")
            ->where('is_active = 1 AND (tags LIKE :search)',
                array(':search' => "%$this->search%"));
        return $sql;
    }

    private function selectTagEvents()
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("event") as object_name, id, name, announce as text, create_date, NULL as target_id, view')
            ->from("Event")
            ->where('is_active = 1 AND (tags LIKE :search)',
                array(':search' => "%$this->search%"));
        return $sql;
    }

    private function selectEvents()
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("event") as object_name, id, name, announce as text, create_date, NULL as target_id, view')
            ->from("Event")
            ->where('is_active = 1 AND (name LIKE :search OR announce LIKE :search)',
                array(':search' => "%$this->search%"));
        return $sql;
    }

    private function selectProfOpinion()
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("prof_opinion") as object_name, id, name, announce as text, create_date, NULL as target_id,NULL as view')
            ->from("ProfOpinion")
            ->where('is_active = 1 AND (name LIKE :search OR announce LIKE :search)',
                array(':search' => "%$this->search%"));
        return $sql;
    }

    private function selectLaw()
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("law") as object_name, id, title as name, NULL as text, create_date, NULL as target_id,NULL as view')
            ->from("Law")
            ->where('title LIKE :search',
                array(':search' => "%$this->search%"));
        return $sql;
    }

    private function selectLibrary()
    {
        $sql = Yii::app()->db->createCommand()
            ->select('("library") as object_name, id, title as name, NULL as text, create_date, NULL as target_id, NULL as view')
            ->from("Library")
            ->where('title LIKE :search',
                array(':search' => "%$this->search%"));
        return $sql;
    }
}
