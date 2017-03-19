<?php

use yii\db\Migration;

/**
 * Handles the creation of table `figure`.
 * Has foreign keys to the tables:
 *
 * - `chessboard`
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
            'number' => $this->string(5),
            'start_position' => $this->integer(1)->notNull(),
        ]);

        // creates index for column `start_position`
        $this->createIndex(
            'idx-figure-start_position',
            'figure',
            'start_position'
        );

        // add foreign key for table `chessboard`
        $this->addForeignKey(
            'fk-figure-start_position',
            'figure',
            'start_position',
            'chessboard',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `chessboard`
        $this->dropForeignKey(
            'fk-figure-start_position',
            'figure'
        );

        // drops index for column `start_position`
        $this->dropIndex(
            'idx-figure-start_position',
            'figure'
        );

        $this->dropTable('figure');
    }
}
