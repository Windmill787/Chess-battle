<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attack`.
 * Has foreign keys to the tables:
 *
 * - `figure`
 */
class m170317_155829_create_attack_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('attack', [
            'id' => $this->primaryKey(),
            'figure_id' => $this->integer()->notNull(),
            'attack_row' => $this->integer(2),
            'attack_col' => $this->integer(2),
        ]);

        // creates index for column `figure_id`
        $this->createIndex(
            'idx-attack-figure_id',
            'attack',
            'figure_id'
        );

        // add foreign key for table `figure`
        $this->addForeignKey(
            'fk-attack-figure_id',
            'attack',
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
            'fk-attack-figure_id',
            'attack'
        );

        // drops index for column `figure_id`
        $this->dropIndex(
            'idx-attack-figure_id',
            'attack'
        );

        $this->dropTable('attack');
    }
}
