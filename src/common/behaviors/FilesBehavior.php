<?php

namespace yiicom\files\common\behaviors;

use yii\base\Behavior;
use yii\base\Exception;
use yiicom\common\models\ActiveRecord;
use modules\pages\common\interfaces\ModelPageUrl;
use yiicom\files\common\models\File;

class FilesBehavior extends Behavior
{
    /**
     * @var string
     */
    public $attribute = 'files';

    /**
     * @inheritdoc
     */
	public function events()
	{
		return [
			ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
			ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
			ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
		];
	}

    /**
     * @return \yii\db\ActiveQuery
     */
	public function getFiles()
	{
        /* @var ActiveRecord|ModelPageUrl $owner */
        $owner = $this->owner;

		return $owner->hasMany(File::class, ['modelId' => 'id'])
            ->onCondition(['{{%files}}.modelClass' => $owner->modelClass()])
			->orderBy(['{{%files}}.position' => SORT_ASC]);
	}

    /**
     * @param array $value
     */
	public function setFiles($value)
	{
		$this->owner->{$this->attribute} = $value;
	}

    /**
     * @return bool
     * @throws Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
	public function afterSave()
	{
        /* @var ActiveRecord|ModelPageUrl $owner */
        $owner = $this->owner;
        $files = $owner->{$this->attribute};

		if (empty($files)) {
			return false;
		}

		foreach ($files as $index => $file) {
		    /* @var File $file */

            if (!$file->status) {
                $file->delete();
                unset($files[$index]);

                continue;
            }

            $model = File::findOne(['id' => $file->id]);

            if (! $model) {
                throw new Exception("Can't find model");
            }

            $model->load($file->attributes, '');
            $model->modelId = $owner->id;
            $model->modelClass = $owner->modelClass();
            $model->position = $index;
            $model->touch('createdAt');

            if (! $model->save()) {
                throw new Exception("Can't save file model: " . implode(', ', $file->getFirstErrors()));
            }

            if (! $file->modelId) {
                $model->fileManager->move();
                $model->updateAttributes(['name', 'path']);
                $model->fileManager->createPreset();
            }

            $files[$index] = $model;
		}

        // Reindex the array with a zero key, to remove keys from JSON result
        $owner->{$this->attribute} = array_values($files);
	}

	public function afterDelete()
	{
		foreach($this->owner->{$this->attribute} as $file) {
		    /* @var ActiveRecord $file */
		    // TODO: delete all presets
            $file->delete();
		}
	}

}