<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */
/* @var $taskCommentForm app\models\tables\TaskComments */
/* @var $taskAttachmentForm \app\models\TaskAttachmentsAddForm */
/* @var $user_id Yii::$web->user->id */

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
    <div class="tasks-atachments">
        <? $form = ActiveForm::begin([
            'action' => Url::to(['task/add-attachment']),
            'options' => ['class' => 'form-inline']
        ]);?>
            <?=$form->field($taskAttachmentForm, 'task_id')->hiddenInput(['value' => $model->id])->label(false);?>
            <?=$form->field($taskAttachmentForm, 'attachment')->fileInput();?>
            <?=Html::submitButton('Добавить', ['class' => 'btn btn-default']);?>
        <? ActiveForm::end();?>

        <?foreach($model->taskAttachments as $file):?>
            <a href="/img/tasks/<?=$file->filename;?>">
                <img src="/img/tasks/thumb/<?=$file->filename;?>" alt="">
            </a>
        <?endforeach;?>
    </div>
    <div class="tasks-comments">
        <? $form = ActiveForm::begin(['action' => Url::to(['task/add-comment'])]);?>
            <?=$form->field($taskCommentForm, 'user_id')->hiddenInput(['value' => $user_id])->label(false);?>
            <?=$form->field($taskCommentForm, 'task_id')->hiddenInput(['value' => $model->id])->label(false);?>
            <?=$form->field($taskCommentForm, 'content')->textarea();?>
            <?=Html::submitButton('Ответить',['class'=>'btn bnt-default']);?>
        <? ActiveForm::end()?>

        <?foreach($model->taskComments as $comment):?>
            <p>
                <b><?=$comment->user->username?>:</b> <?=$comment->content?>
            </p>
        <?endforeach;?>
    </div>
</div>
