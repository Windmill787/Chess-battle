<?php

use yii\db\Migration;

/**
 * Handles the creation of table `play_positions`.
 * Has foreign keys to the tables:
 *
 * - `figure`
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
            'figure_id' => $this->integer(11)->notNull(),
            'current_x' => $this->integer(1)->notNull(),
            'current_y' => $this->integer(1)->notNull(),
            'status' => $this->string(30)->Null(),
        ]);

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

        // add data for columns `id`, `figure_id`, `current_x`, `current_y` of table `play_positions`
        $this->batchInsert('play_positions', ['id', 'figure_id', 'current_x', 'current_y'], [
            [1, 1, 1, 2],
            [2, 2, 2, 2],
            [3, 3, 3, 2],
            [4, 4, 4, 2],
            [5, 5, 5, 3],
            [6, 6, 6, 2],
            [7, 7, 7, 2],
            [8, 8, 8, 2],
            [9, 9, 2, 1],
            [10, 10, 7, 1],
            [11, 11, 3, 1],
            [12, 12, 6, 1],
            [13, 13, 1, 1],
            [14, 14, 8, 1],
            [15, 15, 4, 1],
            [16, 16, 5, 1],
            [17, 17, 1, 7],
            [18, 18, 2, 7],
            [19, 19, 3, 7],
            [20, 20, 4, 7],
            [21, 21, 5, 7],
            [22, 22, 6, 7],
            [23, 23, 7, 7],
            [24, 24, 8, 7],
            [25, 25, 2, 8],
            [26, 26, 7, 8],
            [27, 27, 3, 8],
            [28, 28, 6, 8],
            [29, 29, 1, 8],
            [30, 30, 8, 8],
            [31, 31, 4, 8],
            [32, 32, 5, 8]
        ]);
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

        $this->dropTable('play_positions');
    }
}
