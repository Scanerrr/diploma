<?php

use yii\db\Migration;

/**
 * Handles the creation for table `test_table`.
 */
class m160608_211646_create_test_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%tests}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'owner_id' => $this->integer()->notNull(),
        ]);

        $this->createTable('{{%results}}', [
            'id' => $this->primaryKey(),
            'mark' => $this->integer(),
            'owner_id' => $this->integer()->notNull(),
            'test_id' => $this->integer()->notNull(),
        ]);

            $this->createTable('{{%questions}}', [
            'id' => $this->primaryKey(),
            'text' => $this->string()->notNull(),
            'test_id' => $this->integer()->notNull(),
        ]);

        $this->createTable('{{%answers}}', [
            'id' => $this->primaryKey(),
            'text' => $this->string()->notNull(),
            'question_id' => $this->integer()->notNull(),
            'isCorrect' => $this->integer()->defaultValue(0)->notNull()
        ]);

        $this->addForeignKey('user', '{{%tests}}', 'owner_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('user_result', '{{%results}}', 'owner_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('test_result', '{{%results}}', 'test_id', '{{%tests}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('test', '{{%questions}}', 'test_id', '{{%tests}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('question', '{{%answers}}', 'question_id', '{{%questions}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('question', '{{%answers}}');
        $this->dropForeignKey('test', '{{%questions}}');
        $this->dropForeignKey('test_result', '{{%results}}');
        $this->dropForeignKey('user_result', '{{%results}}');
        $this->dropForeignKey('user', '{{%tests}}');
        $this->dropTable('{{%answers}}');
        $this->dropTable('{{%questions}}');
        $this->dropTable('{{%results}}');
        $this->dropTable('{{%tests}}');
    }
}
