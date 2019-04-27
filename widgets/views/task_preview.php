<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */

$this->title = $model->title;

\yii\web\YiiAsset::register($this);
?>
<a class="task_item" href="<?= Url::to(['view', 'id' => $model->id]) ?>">
    <h3><?=Html::encode($model->title) ?></h3>
    <p><?=Html::encode($model->text);?></p>
    <p><?=Html::encode($model->responsible->username);?></p>
    <p><?=Html::encode($model->status->title);?></p>
    <p><?=Yii::$app->formatter->asDatetime($model->deadline,  'php:d.m.Y');?></p>
</a>
