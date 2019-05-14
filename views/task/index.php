<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\filters\TasksFilter */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="tasks-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Новая задача', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="container">
        <?=\yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => function($model){
                return \app\widgets\TaskPreview::widget(['model' => $model]);
            },
            'itemOptions' => [
                'tag' => 'div',
                'class' => 'col-md-4 col-sm-6 col-xs-12 row',
            ],
            'summary' => "Показано: {count} из {totalCount}",
            'layout' => "<div class='small'>{summary}</div><div class='list-view row'>{items}</div>{pager}",
            'options' => [
                'class' => 'list-view row'
            ]
        ]);
        ?>
    </div>
</div>
