<?php

namespace yiicom\files\backend;

use yiicom\files\common\models\Preset;

class Module extends \yiicom\files\common\Module
{
    /**
     * Return module settings for backend vue application
     * @return array
     */
    public function settings()
    {
        $settings['presets'] = [];
        $settings['presets']['default'] = Preset::findOne(['isDefault' => true]);
        $settings['presets']['actions'] = (new Preset)->actionsList();

        return $settings;
    }
}
