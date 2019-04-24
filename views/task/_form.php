<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\tables\Users;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author_id')->dropDownList(ArrayHelper::map(Users::find()->where(['id' => Yii::$app->user->id])->all(), 'id', 'username')) ?>

    <?= $form->field($model, 'responsible_id')->dropDownList(ArrayHelper::map(Users::find()->all(), 'id', 'username'), ['prompt' => 'Выбрать']) ?>

    <?= $form->field($model, 'deadline')->textInput() ?>

    <?= $form->field($model, 'status_id')->dropDownList(['0' => 'Новая']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
