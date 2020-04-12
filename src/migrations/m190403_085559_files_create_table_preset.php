<?php

use yii\db\Migration;

class m190403_085559_files_create_table_preset extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%files_preset}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'name' => $this->string(64),
            'width' => $this->integer(4),
            'height' => $this->integer(4),
            'quality' => $this->tinyInteger(3),
            'action' => $this->string(64),
            'watermark' => $this->string(),
            'isDefault' => $this->boolean()->defaultValue(false),
            'position' => $this->tinyInteger(3)->defaultValue(0),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
        ], 'ENGINE=InnoDB CHARSET=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%files_preset}}');
    }
}
