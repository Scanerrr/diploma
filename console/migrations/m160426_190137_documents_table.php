<?php

use yii\db\Migration;

class m160426_190137_documents_table extends Migration
{
    public function up()
    {
        $this->createTable("{{%documents}}", [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'text' => $this->text()->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%documents}}');

        return true;
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
