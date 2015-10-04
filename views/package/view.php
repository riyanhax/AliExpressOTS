<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Package */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Packages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="package-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ae_order_id',
            'price',
            'order_date',
            'description',
            [
                'attribute' => 'delivery_date',
                'value'     => $model->is_disputed==1?"N/A":($model->delivery_date=="0000-00-00"?"Waiting...":$model->delivery_date),
                'format'    => 'text'
            ],
            [
                'attribute' => 'paid_with',
                'value'     => $model->paymentMethod->name,
                'format'    => 'text'
            ],
            [
                'attribute' => 'is_disputed',
                'value'     => $model->is_disputed==1?"Yes":"No",
                'format'    => 'text'
            ],
            [
                'attribute' => 'refund_status',
                'value'     => $model->is_disputed==1?$model->refund_status:"N/A",
                'format'    => 'text'
            ],
            'notes:ntext',
            [
                'attribute' => 'created_by',
                'value'     => $model->createdByUser->username,
                'format'    => 'text'
            ],
            'created_at',
            [
                'attribute' => 'created_by',
                'value'     => $model->updatedByUser->username,
                'format'    => 'text'
            ],
            'updated_at',
        ],
    ]) ?>

</div>
