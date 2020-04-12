<?php

use yii\db\Migration;

class m180312_162205_files_create_table_file extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%files_file}}', [
            'id' => $this->primaryKey(),
            'modelClass' => $this->string(),
            'modelId' => $this->integer(),
            'field' => $this->string(64),
            'nameOriginal' => $this->string(),
            'name' => $this->string(),
            'extension' => $this->string(16),
            'path' => $this->string(),
            'size' => $this->integer(),
            'position' => $this->tinyInteger(3)->defaultValue(0),
            'status' => $this->tinyInteger(1)->defaultValue(1),
            'alt' => $this->string(),
            'title' => $this->string(),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
        ], 'ENGINE=InnoDB CHARSET=utf8');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%files_file}}');
    }
}
