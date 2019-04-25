<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */

$this->title = $model->title;

\yii\web\YiiAsset::register($this);
?>
<div class="task_item">
    <h3><?= Html::encode($this->title) ?></h3>
    <p><?=HtmlPurifier::process($model->text);?></p>
    <div class="btn-group" role="group" aria-label="Basic example">
        <?= Html::a('View', ['view', 'id' => $model->id], ['class' => 'btn btn-link']) ?>
        <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-link']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-link',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
</div>
    <?/*= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'text',
           // 'author_id',
           // 'responsible_id',
           // 'deadline',
           // 'status_id',
        ],
    ]) */?>

