<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attachments}}`.
 */
class m190522_132017_create_attachments_table extends Migration
{
    protected $commentsTable = 'task_comments';
    protected $attachTable = 'task_attachments';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->commentsTable, [
            'id' => $this->primaryKey(),
            'content' => $this->string(),
            'task_id' => $this->integer(),
            'user_id' => $this->integer()
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        $taskTable = \app\models\tables\Tasks::tableName();
        $userTable = \app\models\tables\Users::tableName();

        $this->createIndex('fk_'.$this->commentsTable.'_task_idx', $this->commentsTable, 'task_id');
        $this->addForeignKey(
            'fk_'.$this->commentsTable.'_'.$taskTable.'_task', $this->commentsTable, 'task_id', $taskTable, 'id', 'CASCADE'
        );

        $this->createIndex('fk_'.$this->commentsTable.'_user_idx', $this->commentsTable, 'user_id');
        $this->addForeignKey(
            'fk_'.$this->commentsTable.'_'.$userTable.'_user', $this->commentsTable, 'user_id', $userTable, 'id', 'CASCADE'
        );

        $this->createTable($this->attachTable, [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer(),
            'filename' => $this->string(255)
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        $this->createIndex('fk_'.$this->attachTable.'_task_idx', $this->attachTable, 'task_id');
        $this->addForeignKey(
            'fk_'.$this->attachTable.'_'.$taskTable.'_task', $this->attachTable, 'task_id', $taskTable, 'id', 'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->commentsTable);
        $this->dropTable($this->attachTable);
    }
}
