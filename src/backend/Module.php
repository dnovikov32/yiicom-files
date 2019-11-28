<?php

namespace yiicom\files\backend;

use yiicom\files\common\models\Preset;

class Module extends \yiicom\files\common\Module
{
    /**
     * @inheritDoc
     */
    public function settings()
    {
        $settings = [
            'files' => [
                'presets' => [
                    'default' => Preset::findOne(['isDefault' => true]),
                    'actions' => (new Preset)->actionsList(),
                ],
            ]
        ];
        
        return $settings;
    }

    /**
     * @inheritDoc
     */
    public function adminMenu()
    {
        return [
            'label' => 'Файлы',
            'url' => '/files/preset/index',
            'icon' => 'fa fa-image',
            'items' => [
                [
                    'label' => 'Пресеты',
                    'url' => '/files/preset/index',
                    'icon' => 'fa fa-crop-alt',
                ]
            ]
        ];
    }
}
