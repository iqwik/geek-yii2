<?php

namespace app\components;

use Yii;
use yii\base\Event;
use app\models\tables\Users;

class EventSendMessage extends Event
{
    public $id;

    public function send()
    {
        $mailer = Yii::$app->mailer;
        $mailer->useFileTransport = true;

        $mailer->compose()
               ->setTo($this->email())
               ->setFrom([Yii::$app->params['adminEmail'] => 'Administrator'])
               ->setSubject('Новая задача')
               ->setTextBody('На Вас назначена новая задача')
               ->send();
        return true;
    }

    protected function email()
    {
        return Users::find()
                    ->select('email')
                    ->where(['id' => $this->id])
                    ->indexBy('id')
                    ->one()
                    ->email;
    }
}