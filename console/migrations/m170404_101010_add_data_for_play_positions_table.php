<?php

/**
 * Created by PhpStorm.
 * User: max
 * Date: 04.04.17
 * Time: 13:33
 */
class m170404_101010_add_data_for_play_positions_table extends \yii\db\Migration
{
    public function safeUp()
    {
        // add data for columns
        // `game_id`, `figure_id`, `current_x`, `current_y`
        // of table `play_positions`
        $this->batchInsert('play_positions', [
            'game_id', 'figure_id', 'current_x', 'current_y'], [
            [1, 1, 1, 2],
            [1, 2, 2, 2],
            [1, 3, 3, 2],
            [1, 4, 4, 2],
            [1, 5, 5, 2],
            [1, 6, 6, 2],
            [1, 7, 7, 2],
            [1, 8, 8, 2],
            [1, 9, 2, 1],
            [1, 10, 7, 1],
            [1, 11, 3, 1],
            [1, 12, 6, 1],
            [1, 13, 1, 1],
            [1, 14, 8, 1],
            [1, 15, 4, 1],
            [1, 16, 5, 1],
            [1, 17, 1, 7],
            [1, 18, 2, 7],
            [1, 19, 3, 7],
            [1, 20, 4, 7],
            [1, 21, 5, 7],
            [1, 22, 6, 7],
            [1, 23, 7, 7],
            [1, 24, 8, 7],
            [1, 25, 2, 8],
            [1, 26, 7, 8],
            [1, 27, 3, 8],
            [1, 28, 6, 8],
            [1, 29, 1, 8],
            [1, 30, 8, 8],
            [1, 31, 4, 8],
            [1, 32, 5, 8]
        ]);
    }
}