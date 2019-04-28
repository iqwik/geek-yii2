<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>
<div class="tasks-view">
    <mark>Задача №<?= Html::encode($model->id) ?></mark>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'usersList' => $usersList,
        'status' => $status
    ]) ?>
    <!--ul class="list-group">
        <li class="list-group-item"><small>Описание:</small> <?= Html::encode($model->text) ?></li>
        <li class="list-group-item"><small>Исполнитель:</small> <?= Html::encode($model->responsible->username) ?></li>
        <li class="list-group-item"><small>Автор:</small> <?= Html::encode($model->author->username) ?></li>
        <li class="list-group-item"><small>Статус:</small> <?= Html::encode($model->status->title) ?></li>
        <li class="list-group-item"><small>Дата сдачи:</small> <?= Yii::$app->formatter->asDatetime($model->deadline,  'php:d.m.Y'); ?></li>
    </ul>
    <p>
        <?/*= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить задачу?',
                'method' => 'post',
            ],
        ])*/ ?>
    </p-->
</div>
