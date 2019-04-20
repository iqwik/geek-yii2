<?php

use yii\db\Migration;

/**
 * Class m190420_110239_insert_to_roles
 */
class m190420_110239_insert_to_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->batchInsert(
            'roles',
            ['id','name'],
            [
                [1,'user'],[2,'manager'],[99,'admin']
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->delete(
            'roles',
            [
                'in',
                ['id','name'],
                [
                    [1,'user'],[2,'manager'],[99,'admin']
                ]
            ]);
    }

}
