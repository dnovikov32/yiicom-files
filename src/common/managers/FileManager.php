<?php

namespace yiicom\files\common\managers;


use Yii;
use yii\base\ErrorException;
use yii\base\InvalidConfigException;
use yii\helpers\FileHelper;
use yii\helpers\Inflector;
use yii\imagine\Image;
use Imagine\Image\ManipulatorInterface;
use yiicom\files\common\models\File;
use yiicom\files\common\models\Preset;

class FileManager
{
    /**
     * @var File
     */
    private $_file;

    /**
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->_file = $file;
    }

    /**
     * Returns the new unique file name for specified folder
     * @param string $dir Folder to upload
     * @return string
     */
    public function getUniqueFilename(string $dir)
    {
        $dir = Yii::getAlias($dir);
        $pathinfo = pathinfo($this->_file->nameOriginal);
        $name = Inflector::slug($pathinfo['filename'], '_', true);
        $extension = mb_strtolower($pathinfo['extension']);

        $filename = "{$name}.{$extension}";
        $filepath = "{$dir}/{$filename}";
        $count = 0;

        while (file_exists($filepath)) {
            $filename = "{$name}_{$count}.{$extension}";
            $filepath = "{$dir}/{$filename}";
            $count++;
        }

        return $filename;
    }

    /**
     * @param string $newPath
     * @return bool
     * @throws \yii\base\Exception
     */
    public function move(string $newPath = '')
    {
        if (empty($newPath)) {
            $newPath = $this->_file->getStorageDirPath();
        }

        FileHelper::createDirectory(Yii::getAlias($newPath));

        $oldFullPath = $this->_file->getFullPath();
        $this->_file->name = $this->getUniqueFilename($newPath);
        $this->_file->path = $newPath;
        $newFullPath = $this->_file->getFullPath();

        return rename($oldFullPath, $newFullPath);
    }

    /**
     * @param string $name
     * @return bool|string
     * @throws InvalidConfigException
     * @throws \yii\base\Exception
     */
    public function createPreset(string $name = '')
    {
        if ($name) {
            $preset = Preset::findOne(['name' => $name]);
        } else {
            $preset = Preset::findOne(['isDefault' => true]);
        }

        if (null === $preset) {
            throw new InvalidConfigException("Preset not found");
        }

        $dir = $this->_file->getStorageDirName();
        $origFile = $this->_file->getFullPath();
        $newFile = Yii::getAlias("@storage/public/{$dir}/{$preset->name}/{$this->_file->name}");

        FileHelper::createDirectory(dirname($newFile));

        switch ($preset->action) {
            case Preset::ACTION_THUMBNAIL_OUTBOUND:
                $image = Image::thumbnail($origFile, $preset->width, $preset->height, ManipulatorInterface::THUMBNAIL_OUTBOUND);
                break;

            case Preset::ACTION_THUMBNAIL_INSET:
                $image = Image::thumbnail($origFile, $preset->width, $preset->height, ManipulatorInterface::THUMBNAIL_INSET);
                break;

            case Preset::ACTION_RESIZE:
            default:
                $image = Image::resize($origFile, $preset->width, $preset->height);
                break;
        }

        $image = $image->save($newFile, ['quality' => $preset->quality]);
//        $this->addWatermark($image, $newFile, $preset->watermark);

        if ($preset->watermark) {
            $imagine = Image::getImagine();
            $watermark = $imagine->open($preset->watermark);
            $imageSize = $image->getSize();
            $imageWidth = $imageSize->getWidth();
            $imageHeight = $imageSize->getHeight();

            $markSize = $watermark->getSize();

            if ($markSize->getWidth() >= $imageWidth) {
                $watermark = Image::resize($preset->watermark, $imageWidth - $imageWidth * 0.1, $imageHeight - $imageHeight * 0.1);
                $markSize = $watermark->getSize();
            }

            $position = [
                $imageWidth / 2 - $markSize->getWidth() / 2 ,
                $imageHeight / 2 - $markSize->getHeight() / 2
            ];

            Image::watermark($newFile, $watermark, $position)->save($newFile);
        }

        return $newFile;
    }


    /**
     * @return AttachedFile
     * @throws ErrorException
     */
//    public function copy()
//    {
//        $model = new AttachedFile();
//        $model->setAttributes($this->getAttributes(), false);
//        $model->id = null;
//        $model->created_at = null;
//        if ($model->save() == false) {
//            throw new ErrorException('Can not copy model');
//        }
//        $ext = pathinfo($this->getFileFullPath(), PATHINFO_EXTENSION);
//        $model->file_name = $model->id . '.' . $ext;
//        copy($this->getFileFullPath(), $model->getFileFullPath());
//        $model->updateAttributes(['file_name']);
//        return $model;
//    }


//    public function getFileType()
//    {
//        $ext = pathinfo($this->original_name, PATHINFO_EXTENSION);
//        $ext = strtolower($ext);
//        switch (true) {
//            case in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp']):
//                return self::FILE_TYPE_IMAGE;
//            default:
//                return self::FILE_TYPE_FILE;
//        }
//    }

}