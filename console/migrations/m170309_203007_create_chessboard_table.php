<?php

use yii\db\Migration;

/**
 * Handles the creation of table `chessboard`.
 */
class m170309_203007_create_chessboard_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('chessboard', [
            'id' => $this->primaryKey(),
            'x' => $this->integer(1),
            'y' => $this->integer(1),
        ]);

        // add data for columns `id`, `x`, `x` of table `chessboard`
        $this->batchInsert('chessboard', ['id', 'x', 'y'], [
            [1, 1, 1],
            [2, 2, 1],
            [3, 3, 1],
            [4, 4, 1],
            [5, 5, 1],
            [6, 6, 1],
            [7, 7, 1],
            [8, 8, 1],
            [9, 1, 2],
            [10, 2, 2],
            [11, 3, 2],
            [12, 4, 2],
            [13, 5, 2],
            [14, 6, 2],
            [15, 7, 2],
            [16, 8, 2],
            [17, 1, 3],
            [18, 2, 3],
            [19, 3, 3],
            [20, 4, 3],
            [21, 5, 3],
            [22, 6, 3],
            [23, 7, 3],
            [24, 8, 3],
            [25, 1, 4],
            [26, 2, 4],
            [27, 3, 4],
            [28, 4, 4],
            [29, 5, 4],
            [30, 6, 4],
            [31, 7, 4],
            [32, 8, 4],
            [33, 1, 5],
            [34, 2, 5],
            [35, 3, 5],
            [36, 4, 5],
            [37, 5, 5],
            [38, 6, 5],
            [39, 7, 5],
            [40, 8, 5],
            [41, 1, 6],
            [42, 2, 6],
            [43, 3, 6],
            [44, 4, 6],
            [45, 5, 6],
            [46, 6, 6],
            [47, 7, 6],
            [48, 8, 6],
            [49, 1, 7],
            [50, 2, 7],
            [51, 3, 7],
            [52, 4, 7],
            [53, 5, 7],
            [54, 6, 7],
            [55, 7, 7],
            [56, 8, 7],
            [57, 1, 8],
            [58, 2, 8],
            [59, 3, 8],
            [60, 4, 8],
            [61, 5, 8],
            [62, 6, 8],
            [63, 7, 8],
            [64, 8, 8]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('chessboard');
    }
}
