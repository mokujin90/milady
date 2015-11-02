<?php

class FavoriteFilter extends CFormModel{
    public $project_infrastruct = 1;
    public $project_innovate = 1;
    public $project_invest = 1;
    public $project_site = 1;
    public $project_business = 1;

    public $object_news = 1;
    public $object_analytics = 1;
    public $object_project_news = 1;
    public $object_comment_project = 1;

    public function rules()
    {
        return array(
            array('project_infrastruct, project_innovate, project_invest, project_site, project_business, object_comment_project, object_news, object_project_news, object_analytics', 'safe')
        );
    }

    public function filterByType($projectIdList){
        $type = array();
        if($this->project_infrastruct){
            $type[] = Project::T_INFRASTRUCT;
        }
        if($this->project_innovate){
            $type[] = Project::T_INNOVATE;
        }
        if($this->project_invest){
            $type[] = Project::T_INVEST;
        }
        if($this->project_site){
            $type[] = Project::T_SITE;
        }
        if($this->project_business){
            $type[] = Project::T_BUSINESS;
        }
        if(count($type) == 5) {
            return $projectIdList;
        }
        if(count($type)){
            return Yii::app()->db->createCommand()
                ->select('id')
                ->from("Project")
                ->where('id IN (' . implode(',',$projectIdList) . ') AND type IN (' . implode(',',$type) . ')')
                ->queryColumn();
        }
        return array();
    }
}