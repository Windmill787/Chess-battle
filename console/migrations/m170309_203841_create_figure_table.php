<?php

use yii\db\Migration;

/**
 * Handles the creation of table `figure`.
 */
class m170309_203841_create_figure_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('figure', [
            'id' => $this->primaryKey(),
            'color' => $this->string(5)->defaultValue('white'),
            'name' => $this->string(6)->defaultValue('pawn'),
            'number' => $this->string(5)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('figure');
    }
}
