<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\filters\TasksFilter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-search">
    <div class="col-md-2">
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>

        <?
        $items = [
            '1' => 'Январь',
            '2' => 'Февраль',
            '3' => 'Март',
            '4' => 'Апрель',
            '5' => 'Май',
            '6' => 'Июнь',
            '7' => 'Июль',
            '8' => 'Август',
            '9' => 'Сентябрь',
            '10' => 'Октябрь',
            '11' => 'Ноябрь',
            '12' => 'Декабрь',
        ];
        $params = [
            'prompt' => 'Выбрать месяц...'
        ];
        echo $form->field($model, 'deadline')->dropDownList($items,$params); ?>
    </div>
    <div class="form-group col-md-12">
        <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
        <a class="btn btn-outline-secondary" href="<?= Url::to(['index']) ?>">Сбросить</a>
    </div>
    <?php ActiveForm::end(); ?>
</div>
