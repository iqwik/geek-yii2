<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'author_id')->dropDownList($usersList, ['prompt' => 'Выбрать']) ?>

    <?= $form->field($model, 'responsible_id')->dropDownList($usersList, ['prompt' => 'Выбрать']) ?>

    <?= $form->field($model, 'deadline')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'status_id')->dropDownList($status, ['prompt' => 'Выбрать']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
