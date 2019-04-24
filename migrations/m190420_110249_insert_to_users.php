<?php

use yii\db\Migration;

/**
 * Class m190420_110249_insert_to_users
 */
class m190420_110249_insert_to_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->batchInsert(
            'users',
            ['username','password','authKey','accessToken'],
            [
                ['admin','admin','test1key','1-token'],
                ['manager','manager','test2key','2-token'],
                ['demo','demo','test3key','3-token']
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
                ['username','password','authKey','accessToken'],
                [
                    ['admin','admin','test1key','1-token'],
                    ['manager','manager','test2key','2-token'],
                    ['demo','demo','test3key','3-token']
                ]
            ]);
    }
}
