<?php

use yii\db\Migration;

class m160614_234610_test_user_action extends Migration
{
    public function up()
    {
        $this->createTable('{{%user_action}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'question_id' => $this->integer()->notNull(),
            'answers' => $this->string()->notNull()
        ]);

        $this->addForeignKey('action_user', '{{%user_action}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('action_question', '{{%user_action}}', 'question_id', '{{%questions}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('action_user', '{{%user_action}}');
        $this->dropForeignKey('action_question', '{{%user_action}}');
        $this->dropTable('{{%user_action}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
