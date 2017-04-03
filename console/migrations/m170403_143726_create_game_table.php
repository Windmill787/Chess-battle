<?php

use yii\db\Migration;

/**
 * Handles the creation of table `game`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `user`
 * - `play_positions`
 */
class m170403_143726_create_game_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('game', [
            'id' => $this->primaryKey(),
            'white_user_id' => $this->integer(11)->notNull(),
            'black_user_id' => $this->integer(11)->notNull(),
            'play_position_id' => $this->integer(11)->notNull(),
        ]);

        // creates index for column `white_user_id`
        $this->createIndex(
            'idx-game-white_user_id',
            'game',
            'white_user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-game-white_user_id',
            'game',
            'white_user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `black_user_id`
        $this->createIndex(
            'idx-game-black_user_id',
            'game',
            'black_user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-game-black_user_id',
            'game',
            'black_user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `play_position_id`
        $this->createIndex(
            'idx-game-play_position_id',
            'game',
            'play_position_id'
        );

        // add foreign key for table `play_positions`
        $this->addForeignKey(
            'fk-game-play_position_id',
            'game',
            'play_position_id',
            'play_positions',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-game-white_user_id',
            'game'
        );

        // drops index for column `white_user_id`
        $this->dropIndex(
            'idx-game-white_user_id',
            'game'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-game-black_user_id',
            'game'
        );

        // drops index for column `black_user_id`
        $this->dropIndex(
            'idx-game-black_user_id',
            'game'
        );

        // drops foreign key for table `play_positions`
        $this->dropForeignKey(
            'fk-game-play_position_id',
            'game'
        );

        // drops index for column `play_position_id`
        $this->dropIndex(
            'idx-game-play_position_id',
            'game'
        );

        $this->dropTable('game');
    }
}
