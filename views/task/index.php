<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\filters\TasksFilter */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Задачи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Новая задача', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="container">
        <?=\yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => function($model){
                return \app\widgets\TaskPreview::widget(['model' => $model]);
            },
            'itemOptions' => [
                'tag' => 'div',
                'class' => 'col-md-4 col-sm-6 col-xs-12',
            ],
            'layout' => "{items}\n{pager}",
            'options' => [
                'tag' => 'div',
                'class' => 'row list-view',
            ],
        ]);
        ?>
    </div>
</div>
