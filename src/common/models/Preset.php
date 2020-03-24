<?php

namespace yiicom\files\common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yiicom\common\interfaces\ModelStatus;
use yiicom\common\traits\ModelStatusTrait;
use yiicom\files\common\managers\FileManager;

/**
 * @property integer $id
 * @property string $title
 * @property string $name
 * @property integer $width
 * @property integer $height
 * @property integer $quality
 * @property string $action
 * @property string $watermark
 * @property boolean $isDefault
 * @property integer $position
 * @property string $createdAt
 * @property string $updatedAt
 */
class Preset extends ActiveRecord implements ModelStatus
{
    use ModelStatusTrait;

    const ACTION_RESIZE = 'resize';
    const ACTION_THUMBNAIL_OUTBOUND = 'thumbnail_outbound';
    const ACTION_THUMBNAIL_INSET = 'thumbnail_inset';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%files_presets}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['title', 'filter', 'filter' => 'trim'],
            ['title', 'string', 'max' => 255],
            ['title', 'required'],

            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'filter', 'filter' => 'strtolower'],
            ['name', 'string', 'max' => 64],
            ['name', 'match', 'pattern' => '/^[\w\-]+$/'],
            ['name', 'required'],

            ['width', 'integer', 'min' => 1, 'max' => 1900],
            ['width', 'required'],

            ['height', 'integer', 'min' => 1, 'max' => 1200],
            ['height', 'required'],

            ['quality', 'integer', 'min' => 1, 'max' => 100],
            ['quality', 'required'],
            ['quality', 'default', 'value' => 100],

            ['action', 'in', 'range' => array_keys(self::actionsList())],
            ['action', 'required'],
            ['action', 'default', 'value' => self::ACTION_RESIZE],

            ['watermark', 'filter', 'filter' => 'trim'],
            ['watermark', 'string', 'max' => 255],

            ['isDefault', 'boolean'],
            ['isDefault', 'default', 'value' => false],

            ['position', 'integer'],
            ['position', 'default', 'value' => 0],

            [['createdAt', 'updatedAt'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Название',
            'name' => 'Системное название',
            'width' => 'Ширина',
            'height' => 'Высота',
            'quality' => 'Качество',
            'action' => 'Действие',
            'watermark' => 'Копирайт',
            'isDefault' => 'Использовать по умолчанию',
            'position' => 'Позиция',
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
            'title',
            'name',
            'width',
            'height',
            'quality',
            'watermark',
            'action',
            'isDefault',
            'position',
        ];
    }

    /**
     * @return array
     */
    public function actionsList()
    {
        return [
            self::ACTION_RESIZE => 'Resize',
            self::ACTION_THUMBNAIL_INSET => 'Thumbnail Inset',
            self::ACTION_THUMBNAIL_OUTBOUND => 'Thumbnail Outbound',
        ];
    }

}
