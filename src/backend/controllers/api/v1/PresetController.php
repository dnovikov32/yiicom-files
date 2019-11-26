<?php

namespace yiicom\files\backend\controllers\api\v1;

use Yii;
use yii\web\ServerErrorHttpException;
use yiicom\backend\base\ApiController;
use yiicom\common\traits\ModelTrait;
use yiicom\files\common\models\Preset;
use yiicom\files\backend\models\PresetSearch;

class PresetController extends ApiController
{
    use ModelTrait;

    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PresetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->route = '#/files/preset/index';

        return $this->renderPartial('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'columns' => $this->getGridColumns(),
        ]);
    }

    /**
     * @return array
     */
    public function getGridColumns()
    {
        return [
            [
                'attribute' => 'id',
                'headerOptions' => ['class' => 'wpx-70'],
            ],
            'title',
            'name',
            'width',
            'height',
            'quality',
            'action',
            'watermark',
            [
                'attribute' => 'isDefault',
                'value' => function (PresetSearch $model) {
                    return $model->isDefault ? 'Да' : '';
                }
            ]
        ];
    }

    public function actionFind(int $id = null)
    {
        try {
            /* @var Preset $model */
            $model = $this->findOrNewModel(Preset::class, $id, true);

            if ($model->isNewRecord) {
                $model->quality = 100;
                $model->action = Preset::ACTION_RESIZE;
            }

            return $model;
        } catch (\Throwable $e) {
            throw new ServerErrorHttpException(Yii::t("commerce", "Server error: ") . $e->getMessage());
        }
    }

    public function actionSave()
    {
        try {
            /* @var Preset $model */
            $id = Yii::$app->request->post('id');
            $model = $this->findOrNewModel(Preset::class, $id, true);

            if ($model->load(Yii::$app->request->post(), '') && $model->validate()) {
                if (!$model->save(false)) {
                    throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
                }
            }

            return $model;

        } catch (\Throwable $e) {
            throw new ServerErrorHttpException(Yii::t("commerce", "Server error: ") . $e->getMessage());
        }
    }

    /**
     * @return array
     * @throws ServerErrorHttpException
     */
    public function actionDelete()
    {
        try {
            /* @var Preset $model */
            $id = Yii::$app->request->post('id');
            $model = $this->findModel(Preset::class, $id);

            if ($model->delete()) {
                return ['status' => 'success'];
            }

            throw new ServerErrorHttpException(Yii::t("commerce", "Can't delete model"));

        } catch (\Throwable $e) {
            throw new ServerErrorHttpException(Yii::t("commerce", "Server error: ") . $e->getMessage());
        }
    }
}