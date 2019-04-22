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
            ['username','password','authKey','accessToken','role_id'],
            [
                ['admin','admin','test1key','1-token',99],
                ['manager','123456','test2key','2-token',2],
                ['demo','demo','test3key','3-token',1]
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
                ['username','password','authKey','accessToken','role_id'],
                [
                    ['admin','admin','test1key','1-token',99],
                    ['manager','123456','test2key','2-token',2],
                    ['demo','demo','test3key','3-token',1]
                ]
            ]);
    }
}
