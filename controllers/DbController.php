<?php

namespace app\controllers;
use yii\web\Controller;

class DbController extends Controller
{
    public function actionIndex()
    {
        $res = \Yii::$app->db->createCommand(
            "SELECT users.*, roles.name FROM users INNER JOIN roles 
              ON users.role_id = roles.id"
        )->queryAll();

        ?><pre><?print_r($res);?></pre><?
        exit;
    }
}