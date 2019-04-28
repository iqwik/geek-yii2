<?php

use yii\db\Migration;

/**
 * Class m190427_160742_insert_status_table
 */
class m190427_160742_insert_status_table extends Migration
{
    public function up()
    {
        $this->batchInsert(
            '{{%status}}',
            ['title'],
            [
                ['Новая'],
                ['В работе'],
                ['Выполнена']
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->delete(
            '{{%status}}',
            [
                'in',
                ['title'],
                [
                    ['Новая'],
                    ['В работе'],
                    ['Выполнена']
                ]
            ]);
    }
}
