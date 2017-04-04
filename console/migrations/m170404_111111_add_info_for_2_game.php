<?php

/**
 * Created by PhpStorm.
 * User: max
 * Date: 04.04.17
 * Time: 19:27
 */
class m170404_111111_add_info_for_2_game extends \yii\db\Migration
{
    public function safeUp()
    {
        // add data for columns
        // `game_id`, `figure_id`, `current_x`, `current_y`
        // of table `play_positions`
        $this->batchInsert('play_positions', [
            'game_id', 'figure_id', 'current_x', 'current_y'], [
            [2, 1, 1, 2],
            [2, 2, 2, 2],
            [2, 3, 3, 2],
            [2, 4, 4, 2],
            [2, 5, 5, 2],
            [2, 6, 6, 2],
            [2, 7, 7, 2],
            [2, 8, 8, 2],
            [2, 9, 2, 1],
            [2, 10, 7, 1],
            [2, 11, 3, 1],
            [2, 12, 6, 1],
            [2, 13, 1, 1],
            [2, 14, 8, 1],
            [2, 15, 4, 1],
            [2, 16, 5, 1],
            [2, 17, 1, 7],
            [2, 18, 2, 7],
            [2, 19, 3, 7],
            [2, 20, 4, 7],
            [2, 21, 5, 7],
            [2, 22, 6, 7],
            [2, 23, 7, 7],
            [2, 24, 8, 7],
            [2, 25, 2, 8],
            [2, 26, 7, 8],
            [2, 27, 3, 8],
            [2, 28, 6, 8],
            [2, 29, 1, 8],
            [2, 30, 8, 8],
            [2, 31, 4, 8],
            [2, 32, 5, 8]
        ]);
    }
}