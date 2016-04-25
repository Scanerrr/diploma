<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'role' => $this->integer()->notNull()
        ], $tableOptions);

        $this->createTable('{{%roles}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'description' => $this->text()
        ], $tableOptions);

        $this->insert('{{%roles}}', ['name' => 'Администратор', 'description' => 'Роль, имеющая больше всего привелегий']);
        $this->insert('{{%roles}}', ['name' => 'Преподаватель', 'description' => 'Стандартная роль для преподователей']);
        $this->insert('{{%roles}}', ['name' => 'Студент', 'description' => 'Стандартная роль для студентов']);

        $this->addForeignKey('roles_key', '{{%user}}', 'role', '{{%roles}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
