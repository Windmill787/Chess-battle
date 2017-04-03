<?php

use yii\db\Migration;

/**
 * Handles the creation of table `messages`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `user`
 */
class m170403_090322_create_messages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('messages', [
            'id' => $this->primaryKey(),
            'from_user_id' => $this->integer(11)->notNull(),
            'to_user_id' => $this->integer(11)->notNull(),
            'status' => $this->string(30)->notNull()->defaultValue('pending'),
        ]);

        // creates index for column `from_user_id`
        $this->createIndex(
            'idx-messages-from_user_id',
            'messages',
            'from_user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-messages-from_user_id',
            'messages',
            'from_user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `to_user_id`
        $this->createIndex(
            'idx-messages-to_user_id',
            'messages',
            'to_user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-messages-to_user_id',
            'messages',
            'to_user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-messages-from_user_id',
            'messages'
        );

        // drops index for column `from_user_id`
        $this->dropIndex(
            'idx-messages-from_user_id',
            'messages'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-messages-to_user_id',
            'messages'
        );

        // drops index for column `to_user_id`
        $this->dropIndex(
            'idx-messages-to_user_id',
            'messages'
        );

        $this->dropTable('messages');
    }
}
