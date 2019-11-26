<?php

namespace yiicom\files\console\controllers;

use yii\helpers\Console;
use yii\console\ExitCode;
use yii\console\Controller;
use yiicom\files\common\models\Preset;

class CreateController extends Controller
{
    /**
     * Creates default image preset 100x100
     * @return int
     */
    public function actionDefault()
    {
        $defaultPreset = Preset::findOne(['isDefault' => true]);

        if ($defaultPreset) {
            Console::output(Console::ansiFormat("Default preset already exists", [Console::FG_YELLOW]));

            return ExitCode::OK;
        }

        $preset = new Preset;
        $preset->title = '100x100';
        $preset->name = '100x100';
        $preset->width = 100;
        $preset->height = 100;
        $preset->quality = 80;
        $preset->action = Preset::ACTION_RESIZE;
        $preset->isDefault = true;

        if (! $preset->save()) {
            Console::output(
                Console::ansiFormat(
                    "Preset save error: "  . implode(', ', $preset->getFirstErrors()),
                    [Console::FG_RED]
                )
            );

            return ExitCode::UNSPECIFIED_ERROR;
        }

        Console::output(Console::ansiFormat("Default image preset created successfully", [Console::FG_GREEN]));

        return ExitCode::OK;
    }
}