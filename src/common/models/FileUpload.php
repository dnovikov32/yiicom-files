<?php

namespace yiicom\files\common\models;

use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class FileUpload extends File
{
    /**
     * @var UploadedFile
     */
    public $file;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            ['path', 'required'],

            [
                'file',
                'file',
                'skipOnEmpty' => false,
                'extensions' => 'gif, jpg, jpeg, png',
                'maxSize' => 10 * 1024 * 1024,
                'when' => function (FileUpload $model) {
                    return $model->isNewRecord;
                }
            ],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getStorageDirName()
    {
        return 'temp';
    }

    /**
     * Loads default model data and uploaded file.
     * @return bool
     */
    public function loadWithFile()
    {
        $this->modelClass = static::class;
        $this->path = $this->getStorageDirPath();
        $this->file = UploadedFile::getInstanceByName('file');

        return true;
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($this->file instanceof UploadedFile) {
            $this->upload($this->file);
        }

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @param UploadedFile $file
     * @return bool
     * @throws \yii\base\Exception
     */
    public function upload(UploadedFile $file)
    {
        $this->nameOriginal = $file->name;
        $this->name = $this->fileManager->getUniqueFilename($this->getStorageDirPath());
        $this->extension = $file->getExtension();
        $this->size = filesize($file->tempName);

        $this->updateAttributes(['nameOriginal', 'name', 'extension', 'size']);

        $filePath = $this->getFullPath();
        FileHelper::createDirectory(dirname($filePath));

        return $this->file->saveAs($filePath);
    }

}
