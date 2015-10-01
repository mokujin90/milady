<?php

class MediaController extends CController
{
    public function actionUploadFile()
    {
        global $admin_preview_scale;
        $resp = array();

        if (isset($_FILES['Filedata'])) {
            $name = $_FILES['Filedata']['tmp_name'];
            $r_name = $_FILES['Filedata']['name'];

            $model = new Media;

            $model->ext = strtolower(substr(basename($r_name), strrpos(basename($r_name), '.')));
            $model->type = $model->getTypeByExt($model->ext);
            //$model->type = 1;
            $model->size = filesize($name);
            $model->create_date = date("Y.m.j H:i:s");
            if ($model->type == 1) {
                $img_data = getimagesize($name);
                if ($img_data == false) {
                    $resp['error_text'] = "file not a picture";
                } else {
                    $model->width = $img_data[0];
                    $model->height = $img_data[1];

                    $img = Yii::app()->image->load($name);
                    $img->strip();
                }
            }

            if ($model->type == 4) {
                $img_data = getimagesize($name);
                if ($img_data == false) {
                    $resp['error_text'] = "can't read flash size";
                } else {
                    $model->width = $img_data[0];
                    $model->height = $img_data[1];
                }
            }


            $model->save();
            $model->dir = $model->makeDirs();
            $model->save();
            copy($name, $model->makePath() . $model->id . $model->ext);

            $resp['file_url'] = $model->makeWebPath();

            if ($model->type == 1) {
                $params = array("scale" => isset($_GET['scale']) ? $_GET['scale'] : Yii::app()->params['admin_preview_scale']);
                if (isset($_GET['scaleMode'])) {
                    $params['scaleMode'] = $_GET['scaleMode'];
                }
                $preview_url = $model->makePreview($params);
                $resp['preview_url'] = $preview_url['src'];
                $img_data = getimagesize($preview_url['path']);
                $resp['preview_width']= $img_data[0];
                $resp['preview_height']= $img_data[1];
            }
            $resp['old_name']=$r_name; #дополнение, необходимое для отображения старого имени
            $resp = array_merge($resp, $model->attributes);

        }
        echo CJSON::encode($resp);
    }


    public function actionCropFile()
    {
        $resp = array();

        $origModel = Media::model()->findByPk($_POST['data']['id']);

        $image = Yii::app()->image->load($origModel->makePath() . $origModel->id . $origModel->ext);
        $image->crop(
            round($_POST['crop']['width']*$_POST['data']['widthRatio']),
            round($_POST['crop']['height']*$_POST['data']['widthRatio']),
            round($_POST['crop']['left_y']*$_POST['data']['heightRatio']),
            round($_POST['crop']['left_x']*$_POST['data']['widthRatio']));

        $model = new Media;
        $model->type = $origModel->type;
        $model->size = $origModel->size;
        $model->ext = $origModel->ext;
        $model->create_date = $origModel->create_date;
        $model->parent_id = $origModel->id;
        $model->save();
        $model->dir = $model->makeDirs();
        $model->save();

        $cropPath = $model->makePath() . $model->id . $model->ext;
        $image->save($cropPath);
        $model->size = filesize($cropPath);
        $img_data = getimagesize($cropPath);
        $model->width = $img_data[0];
        $model->height = $img_data[1];
        $model->save(false);

        $resp['file_url'] = $model->makeWebPath();
        $params = array("scale" => $_POST['scale']['scale']);
        if (isset($_POST['scale']['scaleMode'])) {
            $params['scaleMode'] = $_POST['scale']['scaleMode'];
        }
        $preview_url = $model->makePreview($params);
        $resp['preview_url'] = $preview_url['src'];
        $resp = array_merge($resp, $model->attributes);

        //ob_clean();
        header('Content-type: application/json');
        echo json_encode($resp);
    }

}
