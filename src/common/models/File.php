<?php

namespace yiicom\files\common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\helpers\StringHelper;
use yiicom\common\interfaces\ModelStatus;
use yiicom\common\traits\ModelStatusTrait;
use yiicom\files\common\managers\FileManager;

/**
 * @property integer $id
 * @property string $modelClass
 * @property integer $modelId
 * @property string $field
 * @property string $nameOriginal
 * @property string $name
 * @property string $extension
 * @property string $path
 * @property integer $size
 * @property integer $position
 * @property integer $status
 * @property string $alt
 * @property string $title
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property FileManager $fileManager
 * @property string $fullPath
 * @property string $storageDirName
 * @property string $storageDirPath
 */
class File extends ActiveRecord implements ModelStatus
{
    use ModelStatusTrait;

    /**
     * @var FileManager
     */
    private $_fileManager;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%files}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'integer'],

            ['modelClass', 'required'],
            ['modelClass', 'string', 'max' => 255],
            ['modelClass', 'string'],

            ['modelId', 'integer'],

            ['field', 'string', 'max' => 64],

            ['nameOriginal', 'filter', 'filter' => 'trim'],
            ['nameOriginal', 'string', 'max' => 255],

            ['name', 'string', 'max' => 255],

            ['extension', 'string', 'max' => 10],

            ['path', 'string', 'max' => 255],

            ['size', 'integer'],

            ['position', 'integer'],
            ['position', 'default', 'value' => 0],

            ['status', 'in', 'range' => $this->statusesOptions()],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],

            ['alt', 'filter', 'filter' => 'trim'],
            ['alt', 'string', 'max' => 255],

            ['title', 'filter', 'filter' => 'trim'],
            ['title', 'string', 'max' => 255],

            [['createdAt', 'updatedAt'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'modelId' => 'ID модели',
            'modelClass' => 'Класс модели',
            'field' => 'Поле',
            'nameOriginal' => 'Оригинальное имя',
            'name' => 'Имя файла',
            'extension' => 'Расширение',
            'path' => 'Путь',
            'size' => 'Размер',
            'position' => 'Позиция',
            'status' => 'Статус',
            'alt' => 'Альтернативный текст',
            'title' => 'Заголовок изображения',
            'createdAt' => 'Дата создания',
            'updatedAt' => 'Дата изменения',
        ];
    }

    /**
     * @inheritDoc
     */
	public function behaviors()
	{
		return [
            'Timestamp' => [
				'class' => TimestampBehavior::class,
				'value' => new Expression('NOW()'),
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
			],
		];
	}

    /**
     * @inheritDoc
     */
	public function fields()
    {
        return [
            'id',
            'modelClass',
            'modelId',
            'nameOriginal',
            'name',
            'path',
            'extension',
            'size',
            'status',
            'position',
            'alt',
            'title',
            'url' => function (File $model) {
                return $model->modelId
                    ? $model->fileManager->getUrl()
                    : "temp/{$model->name}";
            }
        ];
    }

    /**
     * @inheritDoc
     */
    public function afterDelete()
    {
        parent::afterDelete();

//        $this->deleteWithPresets();
//        @unlink($this->getFileFullPath());
    }

    /**
     * @return FileManager
     */
    public function getFileManager()
    {
        if (null === $this->_fileManager) {
            $this->_fileManager = new FileManager($this);
        }

        return $this->_fileManager;
    }

    /**
     * Returns the absolute path to original file.
     * @return string
     */
    public function getFullPath()
    {
        return Yii::getAlias("$this->path/$this->name");
    }

    /**
     * Returns the name of directory in storage folder for save original files.
     * @return string Default is model class name (e.g. product or page).
     */
    public function getStorageDirName()
    {
        return mb_strtolower(StringHelper::basename($this->modelClass));
    }

    /**
     * Returns the path to original files (e.g. storage/product).
     * @return string
     */
    public function getStorageDirPath()
    {
        return "@storage/" . $this->getStorageDirName();
    }

}
