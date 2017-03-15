<?php

use yii\db\Migration;

/**
 * Handles the creation of table `start_position`.
 * Has foreign keys to the tables:
 *
 * - `figure`
 */
class m170310_164225_create_start_position_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('start_position', [
            'id' => $this->primaryKey(),
            'figure_id' => $this->integer(11),
            'start_col' => $this->integer(1),
            'start_row' => $this->integer(1),
        ]);

        // creates index for column `figure_id`
        $this->createIndex(
            'idx-start_position-figure_id',
            'start_position',
            'figure_id'
        );

        // add foreign key for table `figure`
        $this->addForeignKey(
            'fk-start_position-figure_id',
            'start_position',
            'figure_id',
            'figure',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `figure`
        $this->dropForeignKey(
            'fk-start_position-figure_id',
            'start_position'
        );

        // drops index for column `figure_id`
        $this->dropIndex(
            'idx-start_position-figure_id',
            'start_position'
        );

        $this->dropTable('start_position');
    }
}
