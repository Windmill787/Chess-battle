<?php

use yii\db\Migration;

/**
 * Handles the creation of table `move`.
 * Has foreign keys to the tables:
 *
 * - `figure`
 */
class m170317_155629_create_move_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('move', [
            'id' => $this->primaryKey(),
            'figure_id' => $this->integer()->notNull(),
            'move_row' => $this->integer(2),
            'move_col' => $this->integer(2),
        ]);

        // creates index for column `figure_id`
        $this->createIndex(
            'idx-move-figure_id',
            'move',
            'figure_id'
        );

        // add foreign key for table `figure`
        $this->addForeignKey(
            'fk-move-figure_id',
            'move',
            'figure_id',
            'figure',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `figure`
        $this->dropForeignKey(
            'fk-move-figure_id',
            'move'
        );

        // drops index for column `figure_id`
        $this->dropIndex(
            'idx-move-figure_id',
            'move'
        );

        $this->dropTable('move');
    }
}
