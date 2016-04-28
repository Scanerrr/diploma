<?php

use yii\db\Migration;

class m160428_205231_alter_documents_user extends Migration
{
    public function up()
    {
        $this->addColumn('{{%documents}}', 'owner_id', $this->integer()->notNull());

        $this->addForeignKey('user_document', '{{%documents}}', 'owner_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->dropForeignKey('user_document', '{{%documents}}');

        $this->dropColumn('{{%documents}}', 'owner_id');
    }
}
