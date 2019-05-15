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
            '-01-' => 'Январь',
            '-02-' => 'Февраль',
            '-03-'=>'Март',
            '-04-'=>'Апрель',
            '-05-'=>'Май',
            '-06-'=>'Июнь',
            '-07-'=>'Июль',
            '-08-'=>'Август',
            '-09-'=>'Сентябрь',
            '-10-'=>'Октябрь',
            '-11-'=>'Ноябрь',
            '-12-'=>'Декабрь',
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
