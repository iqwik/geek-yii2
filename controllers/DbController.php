<?php

namespace app\controllers;
use yii\web\Controller;

class DbController extends Controller
{
    public function actionIndex()
    {
        /*$res = \Yii::$app->db->createCommand(
            "SELECT t.text as text, u.name as user, u.email as email 
             FROM tasks as t 
             INNER JOIN users as u 
              ON u.id = t.user_id"
        )->queryAll();
        var_dump($res);
        exit;*/
    }
}