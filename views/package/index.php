<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Packages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="package-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('New Package', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ae_order_id',
            'price',
            'order_date',
            'description',
            //'delivery_date',
            // 'arrived_in',
            [
                'attribute' => 'paid_with',
                'value'     => function ($data) {
                    return $data->paymentMethod->name;
                },
                'format'    => 'text'
            ],
            // 'is_disputed',
            // 'refund_status',
            // 'notes:ntext',
            // 'created_by',
            // 'created_at',
            // 'updated_by',
            // 'updated_at',
            [
                'label'   => 'status',
                'format' => 'raw',
                'value'   => function ($data) {
                    if ($data->is_disputed==1) {
                        return "Disputed";
                    } else if ($data->delivery_date<>"0000-00-00") {
                        return "Received on ".$data->delivery_date;
                    } else if ($data->delivery_date=="0000-00-00" && \app\models\Shipment::isShipped($data->id)==true) {
                        return "en-route since ".\app\models\Package::getDaysElapsed($data->id);
                    } else {
                        return "Shipping...";
                    }
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
