<?php

namespace yiicom\files\backend\controllers\api\v1;

use Yii;
use yii\web\ServerErrorHttpException;
use yiicom\backend\base\ApiController;
use yiicom\files\common\models\FileUpload;

class UploadController extends ApiController
{
    public function actionImage()
    {
        $model = new FileUpload();
        $model->loadWithFile();

        if (false === $model->save() && false === $model->hasErrors()) {
            throw new ServerErrorHttpException(Yii::t("commerce", "Can't save model"));
        }

        return $model;
    }
}