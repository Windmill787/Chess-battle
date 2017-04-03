<?php

use yii\db\Migration;

/**
 * Handles the creation of table `game`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `user`
 * - `figure`
 */
class m170403_143726_create_game_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('game', [
            'id' => $this->primaryKey(),
            'game_id' => $this->integer(11)->notNull(),
            'white_user_id' => $this->integer(11)->notNull(),
            'black_user_id' => $this->integer(11)->notNull(),
            'figure_id' => $this->integer(11)->notNull(),
            'current_x' => $this->integer(1)->notNull(),
            'current_y' => $this->integer(1)->notNull(),
            'status' => $this->string(30)->Null(),
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

        // creates index for column `figure_id`
        $this->createIndex(
            'idx-game-figure_id',
            'game',
            'figure_id'
        );

        // add foreign key for table `figure`
        $this->addForeignKey(
            'fk-game-figure_id',
            'game',
            'figure_id',
            'figure',
            'id',
            'CASCADE'
        );

        // add data for columns
        // `game_id`, `white_user_id`, `black_user_id`, `figure_id`, `current_x`, `current_y`
        // of table `game`
        $this->batchInsert('game', [
            'game_id', 'white_user_id', 'black_user_id', 'figure_id', 'current_x', 'current_y'
        ], [
            [1, 1, 2, 1, 1, 2],
            [1, 1, 2, 2, 2, 2],
            [1, 1, 2, 3, 3, 2],
            [1, 1, 2, 4, 4, 2],
            [1, 1, 2, 5, 5, 2],
            [1, 1, 2, 6, 6, 2],
            [1, 1, 2, 7, 7, 2],
            [1, 1, 2, 8, 8, 2],
            [1, 1, 2, 9, 2, 1],
            [1, 1, 2, 10, 7, 1],
            [1, 1, 2, 11, 3, 1],
            [1, 1, 2, 12, 6, 1],
            [1, 1, 2, 13, 1, 1],
            [1, 1, 2, 14, 8, 1],
            [1, 1, 2, 15, 4, 1],
            [1, 1, 2, 16, 5, 1],
            [1, 1, 2, 17, 1, 7],
            [1, 1, 2, 18, 2, 7],
            [1, 1, 2, 19, 3, 7],
            [1, 1, 2, 20, 4, 7],
            [1, 1, 2, 21, 5, 7],
            [1, 1, 2, 22, 6, 7],
            [1, 1, 2, 23, 7, 7],
            [1, 1, 2, 24, 8, 7],
            [1, 1, 2, 25, 2, 8],
            [1, 1, 2, 26, 7, 8],
            [1, 1, 2, 27, 3, 8],
            [1, 1, 2, 28, 6, 8],
            [1, 1, 2, 29, 1, 8],
            [1, 1, 2, 30, 8, 8],
            [1, 1, 2, 31, 4, 8],
            [1, 1, 2, 32, 5, 8]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
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

        // drops foreign key for table `figure`
        $this->dropForeignKey(
            'fk-game-figure_id',
            'game'
        );

        // drops index for column `figure_id`
        $this->dropIndex(
            'idx-game-figure_id',
            'game'
        );

        $this->dropTable('game');
    }
}
