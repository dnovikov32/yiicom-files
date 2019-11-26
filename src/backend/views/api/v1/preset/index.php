<?php

use yii\web\View;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yiicom\files\backend\models\PresetSearch;
use yiicom\backend\grid\ActionColumn;

/**
 * @var View $this
 * @var PresetSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 * @var array $columns
 */

?>

<?php echo GridView::widget([
    'id' => 'grid-presets',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => array_merge(
        $columns, [
        [
            'class' => ActionColumn::class,
            'template' => '{update} {delete}',
            'controller' => '/#/files/preset',
            'headerOptions' => ['class' => 'wpx-75'],
        ]
    ]),
]); ?>