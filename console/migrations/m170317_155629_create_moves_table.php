<?php

use yii\db\Migration;

/**
 * Handles the creation of table `moves`.
 * Has foreign keys to the tables:
 *
 * - `figure`
 */
class m170317_155629_create_moves_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('moves', [
            'id' => $this->primaryKey(),
            'figure_id' => $this->integer()->notNull(),
            'move' => $this->string(255),
            'attack' => $this->string(255),
            'first_move' => $this->string(255)
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

        // add data for columns `id`, `figure_id`, `move`, `attack`, `first_move` of table `moves`
        $this->batchInsert('moves', ['id', 'figure_id', 'move', 'attack', 'first_move'], [
            [1, 1, 'a:1:{i:0;a:2:{i:0;i:0;i:1;i:1;}}', 'a:2:{i:0;a:2:{i:0;i:-1;i:1;i:1;}i:1;a:2:{i:0;i:1;i:1;i:1;}}', 'a:2:{i:0;i:0;i:1;i:2;}'],
            [2, 2, 'a:1:{i:0;a:2:{i:0;i:0;i:1;i:1;}}', 'a:2:{i:0;a:2:{i:0;i:-1;i:1;i:1;}i:1;a:2:{i:0;i:1;i:1;i:1;}}', 'a:2:{i:0;i:0;i:1;i:2;}'],
            [3, 3, 'a:1:{i:0;a:2:{i:0;i:0;i:1;i:1;}}', 'a:2:{i:0;a:2:{i:0;i:-1;i:1;i:1;}i:1;a:2:{i:0;i:1;i:1;i:1;}}', 'a:2:{i:0;i:0;i:1;i:2;}'],
            [4, 4, 'a:1:{i:0;a:2:{i:0;i:0;i:1;i:1;}}', 'a:2:{i:0;a:2:{i:0;i:-1;i:1;i:1;}i:1;a:2:{i:0;i:1;i:1;i:1;}}', 'a:2:{i:0;i:0;i:1;i:2;}'],
            [5, 5, 'a:1:{i:0;a:2:{i:0;i:0;i:1;i:1;}}', 'a:2:{i:0;a:2:{i:0;i:-1;i:1;i:1;}i:1;a:2:{i:0;i:1;i:1;i:1;}}', 'a:2:{i:0;i:0;i:1;i:2;}'],
            [6, 6, 'a:1:{i:0;a:2:{i:0;i:0;i:1;i:1;}}', 'a:2:{i:0;a:2:{i:0;i:-1;i:1;i:1;}i:1;a:2:{i:0;i:1;i:1;i:1;}}', 'a:2:{i:0;i:0;i:1;i:2;}'],
            [7, 7, 'a:1:{i:0;a:2:{i:0;i:0;i:1;i:1;}}', 'a:2:{i:0;a:2:{i:0;i:-1;i:1;i:1;}i:1;a:2:{i:0;i:1;i:1;i:1;}}', 'a:2:{i:0;i:0;i:1;i:2;}'],
            [8, 8, 'a:1:{i:0;a:2:{i:0;i:0;i:1;i:1;}}', 'a:2:{i:0;a:2:{i:0;i:-1;i:1;i:1;}i:1;a:2:{i:0;i:1;i:1;i:1;}}', 'a:2:{i:0;i:0;i:1;i:2;}'],
            [9, 9, 'a:8:{i:0;a:2:{i:0;i:1;i:1;i:2;}i:1;a:2:{i:0;i:-1;i:1;i:2;}i:2;a:2:{i:0;i:1;i:1;i:-2;}i:3;a:2:{i:0;i:-1;i:1;i:-2;}i:4;a:2:{i:0;i:2;i:1;i:1;}i:5;a:2:{i:0;i:-2;i:1;i:1;}i:6;a:2:{i:0;i:2;i:1;i:-1;}i:7;a:2:{i:0;i:-2;i:1;i:-1;}}', NULL, NULL],
            [10, 10, 'a:8:{i:0;a:2:{i:0;i:1;i:1;i:2;}i:1;a:2:{i:0;i:-1;i:1;i:2;}i:2;a:2:{i:0;i:1;i:1;i:-2;}i:3;a:2:{i:0;i:-1;i:1;i:-2;}i:4;a:2:{i:0;i:2;i:1;i:1;}i:5;a:2:{i:0;i:-2;i:1;i:1;}i:6;a:2:{i:0;i:2;i:1;i:-1;}i:7;a:2:{i:0;i:-2;i:1;i:-1;}}', NULL, NULL],
            [11, 11, 'a:4:{i:0;a:2:{i:0;i:1;i:1;i:1;}i:1;a:2:{i:0;i:-1;i:1;i:1;}i:2;a:2:{i:0;i:1;i:1;i:-1;}i:3;a:2:{i:0;i:-1;i:1;i:-1;}}', NULL, NULL],
            [12, 12, 'a:4:{i:0;a:2:{i:0;i:1;i:1;i:1;}i:1;a:2:{i:0;i:-1;i:1;i:1;}i:2;a:2:{i:0;i:1;i:1;i:-1;}i:3;a:2:{i:0;i:-1;i:1;i:-1;}}', NULL, NULL],
            [13, 13, 'a:4:{i:0;a:2:{i:0;i:0;i:1;i:1;}i:1;a:2:{i:0;i:0;i:1;i:-1;}i:2;a:2:{i:0;i:1;i:1;i:0;}i:3;a:2:{i:0;i:-1;i:1;i:0;}}', NULL, NULL],
            [14, 14, 'a:4:{i:0;a:2:{i:0;i:0;i:1;i:1;}i:1;a:2:{i:0;i:0;i:1;i:-1;}i:2;a:2:{i:0;i:1;i:1;i:0;}i:3;a:2:{i:0;i:-1;i:1;i:0;}}', NULL, NULL],
            [15, 15, 'a:8:{i:0;a:2:{i:0;i:1;i:1;i:1;}i:1;a:2:{i:0;i:-1;i:1;i:1;}i:2;a:2:{i:0;i:1;i:1;i:-1;}i:3;a:2:{i:0;i:-1;i:1;i:-1;}i:4;a:2:{i:0;i:0;i:1;i:1;}i:5;a:2:{i:0;i:0;i:1;i:-1;}i:6;a:2:{i:0;i:1;i:1;i:0;}i:7;a:2:{i:0;i:-1;i:1;i:0;}}', NULL, NULL],
            [16, 16, 'a:8:{i:0;a:2:{i:0;i:1;i:1;i:1;}i:1;a:2:{i:0;i:-1;i:1;i:1;}i:2;a:2:{i:0;i:1;i:1;i:-1;}i:3;a:2:{i:0;i:-1;i:1;i:-1;}i:4;a:2:{i:0;i:0;i:1;i:1;}i:5;a:2:{i:0;i:0;i:1;i:-1;}i:6;a:2:{i:0;i:1;i:1;i:0;}i:7;a:2:{i:0;i:-1;i:1;i:0;}}', NULL, NULL],
            [17, 17, 'a:1:{i:0;a:2:{i:0;i:0;i:1;i:1;}}', 'a:2:{i:0;a:2:{i:0;i:-1;i:1;i:1;}i:1;a:2:{i:0;i:1;i:1;i:1;}}', 'a:2:{i:0;i:0;i:1;i:2;}'],
            [18, 18, 'a:1:{i:0;a:2:{i:0;i:0;i:1;i:1;}}', 'a:2:{i:0;a:2:{i:0;i:-1;i:1;i:1;}i:1;a:2:{i:0;i:1;i:1;i:1;}}', 'a:2:{i:0;i:0;i:1;i:2;}'],
            [19, 19, 'a:1:{i:0;a:2:{i:0;i:0;i:1;i:1;}}', 'a:2:{i:0;a:2:{i:0;i:-1;i:1;i:1;}i:1;a:2:{i:0;i:1;i:1;i:1;}}', 'a:2:{i:0;i:0;i:1;i:2;}'],
            [20, 20, 'a:1:{i:0;a:2:{i:0;i:0;i:1;i:1;}}', 'a:2:{i:0;a:2:{i:0;i:-1;i:1;i:1;}i:1;a:2:{i:0;i:1;i:1;i:1;}}', 'a:2:{i:0;i:0;i:1;i:2;}'],
            [21, 21, 'a:1:{i:0;a:2:{i:0;i:0;i:1;i:1;}}', 'a:2:{i:0;a:2:{i:0;i:-1;i:1;i:1;}i:1;a:2:{i:0;i:1;i:1;i:1;}}', 'a:2:{i:0;i:0;i:1;i:2;}'],
            [22, 22, 'a:1:{i:0;a:2:{i:0;i:0;i:1;i:1;}}', 'a:2:{i:0;a:2:{i:0;i:-1;i:1;i:1;}i:1;a:2:{i:0;i:1;i:1;i:1;}}', 'a:2:{i:0;i:0;i:1;i:2;}'],
            [23, 23, 'a:1:{i:0;a:2:{i:0;i:0;i:1;i:1;}}', 'a:2:{i:0;a:2:{i:0;i:-1;i:1;i:1;}i:1;a:2:{i:0;i:1;i:1;i:1;}}', 'a:2:{i:0;i:0;i:1;i:2;}'],
            [24, 24, 'a:1:{i:0;a:2:{i:0;i:0;i:1;i:1;}}', 'a:2:{i:0;a:2:{i:0;i:-1;i:1;i:1;}i:1;a:2:{i:0;i:1;i:1;i:1;}}', 'a:2:{i:0;i:0;i:1;i:2;}'],
            [25, 25, 'a:8:{i:0;a:2:{i:0;i:1;i:1;i:2;}i:1;a:2:{i:0;i:-1;i:1;i:2;}i:2;a:2:{i:0;i:1;i:1;i:-2;}i:3;a:2:{i:0;i:-1;i:1;i:-2;}i:4;a:2:{i:0;i:2;i:1;i:1;}i:5;a:2:{i:0;i:-2;i:1;i:1;}i:6;a:2:{i:0;i:2;i:1;i:-1;}i:7;a:2:{i:0;i:-2;i:1;i:-1;}}', NULL, NULL],
            [26, 26, 'a:8:{i:0;a:2:{i:0;i:1;i:1;i:2;}i:1;a:2:{i:0;i:-1;i:1;i:2;}i:2;a:2:{i:0;i:1;i:1;i:-2;}i:3;a:2:{i:0;i:-1;i:1;i:-2;}i:4;a:2:{i:0;i:2;i:1;i:1;}i:5;a:2:{i:0;i:-2;i:1;i:1;}i:6;a:2:{i:0;i:2;i:1;i:-1;}i:7;a:2:{i:0;i:-2;i:1;i:-1;}}', NULL, NULL],
            [27, 27, 'a:4:{i:0;a:2:{i:0;i:1;i:1;i:1;}i:1;a:2:{i:0;i:-1;i:1;i:1;}i:2;a:2:{i:0;i:1;i:1;i:-1;}i:3;a:2:{i:0;i:-1;i:1;i:-1;}}', NULL, NULL],
            [28, 28, 'a:4:{i:0;a:2:{i:0;i:1;i:1;i:1;}i:1;a:2:{i:0;i:-1;i:1;i:1;}i:2;a:2:{i:0;i:1;i:1;i:-1;}i:3;a:2:{i:0;i:-1;i:1;i:-1;}}', NULL, NULL],
            [29, 29, 'a:4:{i:0;a:2:{i:0;i:0;i:1;i:1;}i:1;a:2:{i:0;i:0;i:1;i:-1;}i:2;a:2:{i:0;i:1;i:1;i:0;}i:3;a:2:{i:0;i:-1;i:1;i:0;}}', NULL, NULL],
            [30, 30, 'a:4:{i:0;a:2:{i:0;i:0;i:1;i:1;}i:1;a:2:{i:0;i:0;i:1;i:-1;}i:2;a:2:{i:0;i:1;i:1;i:0;}i:3;a:2:{i:0;i:-1;i:1;i:0;}}', NULL, NULL],
            [31, 31, 'a:8:{i:0;a:2:{i:0;i:1;i:1;i:1;}i:1;a:2:{i:0;i:-1;i:1;i:1;}i:2;a:2:{i:0;i:1;i:1;i:-1;}i:3;a:2:{i:0;i:-1;i:1;i:-1;}i:4;a:2:{i:0;i:0;i:1;i:1;}i:5;a:2:{i:0;i:0;i:1;i:-1;}i:6;a:2:{i:0;i:1;i:1;i:0;}i:7;a:2:{i:0;i:-1;i:1;i:0;}}', NULL, NULL],
            [32, 32, 'a:8:{i:0;a:2:{i:0;i:1;i:1;i:1;}i:1;a:2:{i:0;i:-1;i:1;i:1;}i:2;a:2:{i:0;i:1;i:1;i:-1;}i:3;a:2:{i:0;i:-1;i:1;i:-1;}i:4;a:2:{i:0;i:0;i:1;i:1;}i:5;a:2:{i:0;i:0;i:1;i:-1;}i:6;a:2:{i:0;i:1;i:1;i:0;}i:7;a:2:{i:0;i:-1;i:1;i:0;}}', NULL, NULL]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
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
