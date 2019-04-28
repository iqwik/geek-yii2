<?php

namespace app\components;

use yii\base\Component;
use yii\base\Event;
use app\models\tables\Tasks;

class EventSendMessage extends Component
{
    public function init(){
        $this->eventSendMessage();
    }

    private function eventSendMessage()
    {
        Event::on( Tasks::class, Tasks::EVENT_AFTER_INSERT, function($event)
        {

            $task = $event->sender;
            $app = \Yii::$app;

            $body = "Здравствуйте {$task->responsible->username},\n\n 
            На Вас назначена новая задача, <a href='http://yii.loc/?r=task%2Fview&id={$task->id}'>перейти</a>";

            $app->mailer->compose()
                        ->setTo($task->responsible->email)
                        ->setFrom([$app->params['adminEmail'] => 'Administrator'])
                        ->setSubject('Новая Задача')
                        ->setTextBody($body)
                        ->send();
            return true;
        });
    }
}