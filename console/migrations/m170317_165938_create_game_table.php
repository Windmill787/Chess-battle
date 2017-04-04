<?php

use yii\db\Migration;

/**
 * Handles the creation of table `game`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `user`
 */
class m170317_165938_create_game_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('game', [
            'id' => $this->primaryKey(),
            'white_user_id' => $this->integer(11)->notNull(),
            'black_user_id' => $this->integer(11)->notNull(),
            'status' => $this->string(30)->notNull()->defaultValue('in progress'),
            'move' => $this->integer(11)->defaultValue(1)
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
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
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

        $this->dropTable('game');
    }
}
