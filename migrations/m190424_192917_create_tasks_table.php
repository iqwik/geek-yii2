<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tasks}}`.
 */
class m190424_192917_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tasks}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(150)->notNull(),
            'text' => $this->string(255)->notNull(),
            'author_id' => $this->integer(4)->notNull(),
            'responsible_id' => $this->integer(4)->notNull(),
            'deadline' => $this->dateTime(),
            'status_id' => $this->integer(4)->defaultValue(0)
        ], "DEFAULT CHARSET=utf8mb4");

        $this->createIndex('fk_tasks_users_author_idx', '{{%tasks}}', 'author_id');
        $this->addForeignKey(
            'fk_tasks_users_author', '{{%tasks}}', 'author_id', '{{%users}}', 'id', 'CASCADE'
        );

        $this->createIndex('fk_tasks_users_responsible_idx', '{{%tasks}}', 'responsible_id');
        $this->addForeignKey(
            'fk_tasks_users_responsible', '{{%tasks}}', 'responsible_id', '{{%users}}', 'id', 'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tasks}}');
    }
}
