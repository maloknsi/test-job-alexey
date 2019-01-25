<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'service_id',
            'numb_serial',
            'box',
            //'code',
            //'degree_wear',
            //'defects:ntext',
            //'warning:ntext',
            //'date_receipt',
            //'date_issue',
            //'status',
            //'pay_type',
            //'pay_status',
            //'shipment',
            //'price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
