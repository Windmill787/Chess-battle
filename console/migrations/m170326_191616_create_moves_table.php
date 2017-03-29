<?php

use yii\db\Migration;

/**
 * Handles the creation of table `moves`.
 * Has foreign keys to the tables:
 *
 * - `figure`
 */
class m170326_191616_create_moves_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('moves', [
            'id' => $this->primaryKey(),
            'figure_id' => $this->integer(11)->notNull(),
            'move' => $this->string(255)->notNull(),
        ]);

        // creates index for column `figure_id`
        $this->createIndex(
            'idx-moves-figure_id',
            'moves',
            'figure_id'
        );

        // add foreign key for table `figure`
        $this->addForeignKey(
            'fk-moves-figure_id',
            'moves',
            'figure_id',
            'figure',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `figure`
        $this->dropForeignKey(
            'fk-moves-figure_id',
            'moves'
        );

        // drops index for column `figure_id`
        $this->dropIndex(
            'idx-moves-figure_id',
            'moves'
        );

        $this->dropTable('moves');
    }
}
