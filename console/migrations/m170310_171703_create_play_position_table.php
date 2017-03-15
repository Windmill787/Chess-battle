<?php

use yii\db\Migration;

/**
 * Handles the creation of table `play_position`.
 * Has foreign keys to the tables:
 *
 * - `figure`
 * - `figure`
 * - `figure`
 */
class m170310_171703_create_play_position_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('play_position', [
            'id' => $this->primaryKey(),
            'figure_id' => $this->integer(11),
            'from_col' => $this->integer(1),
            'from_row' => $this->integer(1),
            'to_col' => $this->integer(1),
            'to_row' => $this->integer(1),
            'replaced_to' => $this->integer(11),
            'is_in_check' => $this->boolean()->defaultValue(false),
            'pawn_up_to' => $this->integer(11),
        ]);

        // creates index for column `figure_id`
        $this->createIndex(
            'idx-play_position-figure_id',
            'play_position',
            'figure_id'
        );

        // add foreign key for table `figure`
        $this->addForeignKey(
            'fk-play_position-figure_id',
            'play_position',
            'figure_id',
            'figure',
            'id',
            'CASCADE'
        );

        // creates index for column `replaced_to`
        $this->createIndex(
            'idx-play_position-replaced_to',
            'play_position',
            'replaced_to'
        );

        // add foreign key for table `figure`
        $this->addForeignKey(
            'fk-play_position-replaced_to',
            'play_position',
            'replaced_to',
            'figure',
            'id',
            'CASCADE'
        );

        // creates index for column `pawn_up_to`
        $this->createIndex(
            'idx-play_position-pawn_up_to',
            'play_position',
            'pawn_up_to'
        );

        // add foreign key for table `figure`
        $this->addForeignKey(
            'fk-play_position-pawn_up_to',
            'play_position',
            'pawn_up_to',
            'figure',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `figure`
        $this->dropForeignKey(
            'fk-play_position-figure_id',
            'play_position'
        );

        // drops index for column `figure_id`
        $this->dropIndex(
            'idx-play_position-figure_id',
            'play_position'
        );

        // drops foreign key for table `figure`
        $this->dropForeignKey(
            'fk-play_position-replaced_to',
            'play_position'
        );

        // drops index for column `replaced_to`
        $this->dropIndex(
            'idx-play_position-replaced_to',
            'play_position'
        );

        // drops foreign key for table `figure`
        $this->dropForeignKey(
            'fk-play_position-pawn_up_to',
            'play_position'
        );

        // drops index for column `pawn_up_to`
        $this->dropIndex(
            'idx-play_position-pawn_up_to',
            'play_position'
        );

        $this->dropTable('play_position');
    }
}
