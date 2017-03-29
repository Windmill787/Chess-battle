<?php

use yii\db\Migration;

/**
 * Handles the creation of table `chessboard`.
 */
class m170309_203007_create_chessboard_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('chessboard', [
            'id' => $this->primaryKey(),
            'x' => $this->integer(1),
            'y' => $this->integer(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('chessboard');
    }
}
