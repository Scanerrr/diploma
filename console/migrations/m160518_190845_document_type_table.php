<?php

use yii\db\Migration;

class m160518_190845_document_type_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%documents}}', 'type_id', $this->integer());

        $this->createTable(
            '{{%document_types}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string()
            ]
        );

        $this->addForeignKey('documents_types','{{%documents}}', 'type_id', '{{%document_types}}', 'id', 'CASCADE', 'CASCADE');

        $this->insert('{{%document_types}}', [
            'name' => 'Лекція'
        ]);
        $this->insert('{{%document_types}}', [
            'name' => 'Самостійна робота'
        ]);
        $this->insert('{{%document_types}}', [
            'name' => 'Практична робота'
        ]);
    }

    public function safeDown()
    {
        $this->dropForeignKey('documents_types', '{{%documents}}');

        $this->dropTable('{{%document_types}}');

        $this->dropColumn('{{%documents}}', 'type_id');

        return true;
    }

}
