<?php

use yii\db\Migration;

/**
 * Handles the creation of table `message`.
 */
class m170309_204355_create_message_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('message', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30),
            'status' => $this->string(30),
            'from' => $this->string(5)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('message');
    }
}
