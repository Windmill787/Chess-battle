<?php

use yii\db\Migration;

/**
 * Handles the creation of table `play_positions`.
 * Has foreign keys to the tables:
 *
 * - `figure`
 * - `game`
 */
class m170318_182119_create_play_positions_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('play_positions', [
            'id' => $this->primaryKey(),
            'game_id' => $this->integer(11)->notNull(),
            'figure_id' => $this->integer(11)->notNull(),
            'current_x' => $this->integer(1)->notNull(),
            'current_y' => $this->integer(1)->notNull(),
            'status' => $this->string(30)->Null(),
        ]);

        // creates index for column `game_id`
        $this->createIndex(
            'idx-play_positions-game_id',
            'play_positions',
            'game_id'
        );

        // add foreign key for table `game`
        $this->addForeignKey(
            'fk-play_positions-game_id',
            'play_positions',
            'game_id',
            'game',
            'id',
            'CASCADE'
        );

        // creates index for column `figure_id`
        $this->createIndex(
            'idx-play_positions-figure_id',
            'play_positions',
            'figure_id'
        );

        // add foreign key for table `figure`
        $this->addForeignKey(
            'fk-play_positions-figure_id',
            'play_positions',
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
            'fk-play_positions-figure_id',
            'play_positions'
        );

        // drops index for column `figure_id`
        $this->dropIndex(
            'idx-play_positions-figure_id',
            'play_positions'
        );

        // drops foreign key for table `game`
        $this->dropForeignKey(
            'fk-play_positions-game_id',
            'play_positions'
        );

        // drops index for column `game_id`
        $this->dropIndex(
            'idx-play_positions-game_id',
            'play_positions'
        );

        $this->dropTable('play_positions');
    }
}
