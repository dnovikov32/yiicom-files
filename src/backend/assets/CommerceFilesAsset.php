<?php

namespace yiicom\files\backend\assets;

use yii\web\AssetBundle;
use yiicom\backend\assets\CommerceAsset;

/**
 * @inheritdoc
 */
class CommerceFilesAsset extends AssetBundle
{
    public $sourcePath = '@modules/files/backend/assets/dist';

    public $css = [
		'css/files.css',
    ];

    public $js = [
        'js/files.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        CommerceAsset::class,
    ];
}
