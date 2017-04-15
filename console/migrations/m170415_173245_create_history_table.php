<?php

use yii\db\Migration;

/**
 * Handles the creation of table `history`.
 * Has foreign keys to the tables:
 *
 * - `game`
 * - `figure`
 */
class m170415_173245_create_history_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('history', [
            'id' => $this->primaryKey(),
            'game_id' => $this->integer(11)->notNull(),
            'figure_id' => $this->integer(11)->notNull(),
            'from_x' => $this->integer(1)->notNull(),
            'from_y' => $this->integer(1)->notNull(),
            'to_x' => $this->integer(1)->notNull(),
            'to_y' => $this->integer(1)->notNull(),
        ]);

        // creates index for column `game_id`
        $this->createIndex(
            'idx-history-game_id',
            'history',
            'game_id'
        );

        // add foreign key for table `game`
        $this->addForeignKey(
            'fk-history-game_id',
            'history',
            'game_id',
            'game',
            'id',
            'CASCADE'
        );

        // creates index for column `figure_id`
        $this->createIndex(
            'idx-history-figure_id',
            'history',
            'figure_id'
        );

        // add foreign key for table `figure`
        $this->addForeignKey(
            'fk-history-figure_id',
            'history',
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
        // drops foreign key for table `game`
        $this->dropForeignKey(
            'fk-history-game_id',
            'history'
        );

        // drops index for column `game_id`
        $this->dropIndex(
            'idx-history-game_id',
            'history'
        );

        // drops foreign key for table `figure`
        $this->dropForeignKey(
            'fk-history-figure_id',
            'history'
        );

        // drops index for column `figure_id`
        $this->dropIndex(
            'idx-history-figure_id',
            'history'
        );

        $this->dropTable('history');
    }
}
