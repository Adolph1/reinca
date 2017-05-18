<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TransferedGood */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '#'), 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfered-good-view">

    <h1><?php // Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'transfer_date',
            [
                'attribute'=>'store_id',
                'value'=>$model->store->store_name,
            ],

            'qty',
            'balance',
            'horse_number',
            'trailer_number',
            'driver_name',
            'driver_phonenumber',
        ],
    ]) ?>


    <?php
    $searchModel = new \backend\models\AdjustmentSearch();
    $dataProvider = $searchModel->searchbyId($model->id);
    ?>
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'transfered_good_id',
            'total_qty',
            'adjusted_stock',
            'transfered_qty',
            'comment',

            /*[
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{reverse}',
                'buttons'=>[
                    'reverse' => function ($url, $model) {
                        $url=['adjustment/reverse','id' => $model->id];
                        return Html::a('<span class="fa fa-retweet"></span>', $url, [
                            'title' => 'Reverse',
                            'data-toggle'=>'tooltip','data-original-title'=>'Reverse',
                            'class'=>'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to reverse this transaction?'),
                                'method' => 'post',
                            ],

                        ]);


                    }


                ]
            ],*/
        ],
    ]); ?>

</div>
