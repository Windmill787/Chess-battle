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
            'status' => $this->string(10)->defaultValue('active')
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

        $this->batchInsert('figure', ['id', 'color', 'name', 'number', 'start_position', 'status'], [
            [1, 'white', 'pawn', '1', 9, 'active'],
            [2, 'white', 'pawn', '2', 10, 'active'],
            [3, 'white', 'pawn', '3', 11, 'active'],
            [4, 'white', 'pawn', '4', 12, 'active'],
            [5, 'white', 'pawn', '5', 13, 'active'],
            [6, 'white', 'pawn', '6', 14, 'active'],
            [7, 'white', 'pawn', '7', 15, 'active'],
            [8, 'white', 'pawn', '8', 16, 'active'],
            [9, 'white', 'knight', '1', 2, 'active'],
            [10, 'white', 'knight', '2', 7, 'active'],
            [11, 'white', 'bishop', '1', 3, 'active'],
            [12, 'white', 'bishop', '2', 6, 'active'],
            [13, 'white', 'rook', '1', 1, 'active'],
            [14, 'white', 'rook', '2', 8, 'active'],
            [15, 'white', 'queen', NULL, 4, 'active'],
            [16, 'white', 'king', NULL, 5, 'active'],
            [17, 'black', 'pawn', '1', 49, 'active'],
            [18, 'black', 'pawn', '2', 50, 'active'],
            [19, 'black', 'pawn', '3', 51, 'active'],
            [20, 'black', 'pawn', '4', 52, 'active'],
            [21, 'black', 'pawn', '5', 53, 'active'],
            [22, 'black', 'pawn', '6', 54, 'active'],
            [23, 'black', 'pawn', '7', 55, 'active'],
            [24, 'black', 'pawn', '8', 56, 'active'],
            [25, 'black', 'knight', '1', 58, 'active'],
            [26, 'black', 'knight', '2', 63, 'active'],
            [27, 'black', 'bishop', '1', 59, 'active'],
            [28, 'black', 'bishop', '2', 62, 'active'],
            [29, 'black', 'rook', '1', 57, 'active'],
            [30, 'black', 'rook', '2', 64, 'active'],
            [31, 'black', 'queen', NULL, 60, 'active'],
            [32, 'black', 'king', NULL, 61, 'active']
        ]);
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
