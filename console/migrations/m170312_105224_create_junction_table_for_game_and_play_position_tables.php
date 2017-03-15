<?php

use yii\db\Migration;

/**
 * Handles the creation of table `game_play_position`.
 * Has foreign keys to the tables:
 *
 * - `game`
 * - `play_position`
 */
class m170312_105224_create_junction_table_for_game_and_play_position_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('game_play_position', [
            'game_id' => $this->integer(),
            'play_position_id' => $this->integer(),
            'PRIMARY KEY(game_id, play_position_id)',
        ]);

        // creates index for column `game_id`
        $this->createIndex(
            'idx-game_play_position-game_id',
            'game_play_position',
            'game_id'
        );

        // add foreign key for table `game`
        $this->addForeignKey(
            'fk-game_play_position-game_id',
            'game_play_position',
            'game_id',
            'game',
            'id',
            'CASCADE'
        );

        // creates index for column `play_position_id`
        $this->createIndex(
            'idx-game_play_position-play_position_id',
            'game_play_position',
            'play_position_id'
        );

        // add foreign key for table `play_position`
        $this->addForeignKey(
            'fk-game_play_position-play_position_id',
            'game_play_position',
            'play_position_id',
            'play_position',
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
            'fk-game_play_position-game_id',
            'game_play_position'
        );

        // drops index for column `game_id`
        $this->dropIndex(
            'idx-game_play_position-game_id',
            'game_play_position'
        );

        // drops foreign key for table `play_position`
        $this->dropForeignKey(
            'fk-game_play_position-play_position_id',
            'game_play_position'
        );

        // drops index for column `play_position_id`
        $this->dropIndex(
            'idx-game_play_position-play_position_id',
            'game_play_position'
        );

        $this->dropTable('game_play_position');
    }
}
