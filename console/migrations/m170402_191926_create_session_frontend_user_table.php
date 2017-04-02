<?php

use yii\db\Migration;

/**
 * Handles the creation of table `session_frontend_user`.
 */
class m170402_191926_create_session_frontend_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('session_frontend_user', [
            'id' => $this->string(80)->notNull(),
            'user_id' => $this->integer(11)->defaultValue(null),
            'ip' => $this->string(11),
            'expire' => $this->integer(11)->defaultValue(null),
            'data' => 'LONGBLOB'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('session_frontend_user');
    }
}
