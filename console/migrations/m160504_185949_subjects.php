<?php

use yii\db\Migration;

class m160504_185949_subjects extends Migration
{
    public function up()
    {
        $this->createTable('{{%subjects}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);

        $this->addColumn('{{%documents}}', 'subject_id', $this->integer()->notNull());
        $this->addForeignKey('document_subject', '{{%documents}}', 'subject_id', '{{%subjects}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('document_subject', '{{%documents}}');
        $this->dropTable('{{%subjects}}');
        $this->dropColumn('{{%documents}}', 'subject_id');
    }

}
