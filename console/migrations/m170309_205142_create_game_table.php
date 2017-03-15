<?php

use yii\db\Migration;

/**
 * Handles the creation of table `game`.
 * Has foreign keys to the tables:
 *
 * - `figure`
 * - `user`
 */
class m170309_205142_create_game_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('game', [
            'id' => $this->primaryKey(),
            'white_player_id' => $this->integer(11),
            'black_player_id' => $this->integer(11),
            'message_id' => $this->integer(11),
            'date_of_match' => $this->dateTime()
        ]);

        // creates index for column `white_player_id`
        $this->createIndex(
            'idx-game-white_player_id',
            'game',
            'white_player_id'
        );

        // creates index for column `black_player_id`
        $this->createIndex(
            'idx-game-black_player_id',
            'game',
            'black_player_id'
        );

        // creates index for column `message_id`
        $this->createIndex(
            'idx-game-message_id',
            'game',
            'message_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-game-white_player_id',
            'game',
            'white_player_id',
            'user',
            'id',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-game-black_player_id',
            'game',
            'black_player_id',
            'user',
            'id',
            'CASCADE'
        );

        // add foreign key for table `message`
        $this->addForeignKey(
            'fk-game-message_id',
            'game',
            'message_id',
            'message',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `message`
        $this->dropForeignKey(
            'fk-game-message_id',
            'game'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-game-black_player_id',
            'game'
        );


        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-game-white_player_id',
            'game'
        );

        // drops index for column `message_id`
        $this->dropIndex(
            'idx-game-message_id',
            'game'
        );

        // drops index for column `black_player_id`
        $this->dropIndex(
            'idx-game-black_player_id',
            'game'
        );

        // drops index for column `white_player_id`
        $this->dropIndex(
            'idx-game-white_player_id',
            'game'
        );

        $this->dropTable('game');
    }
}
