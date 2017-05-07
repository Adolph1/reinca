<?php

use yii\helpers\Html;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransferedGoodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Transfered Stocks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfered-good-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    $searchModel = new \backend\models\TransferedGoodSearch();
    $dataProvider = $searchModel->canceled(Yii::$app->request->queryParams);
    ?>
    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'transfer_date',
            [
                'attribute'=>'store_id',
                'value'=>'store.store_name'
            ],
            [
                'attribute'=>'product_id',
                'value'=>'product.product_name'
            ],
            'qty',
            'balance',
            'horse_number',
            'trailer_number',
            'driver_name',
            'driver_phonenumber',
            [
                'attribute'=>'Stock Status',
                'value'=>function ($searchModel)
                {
                    if($searchModel->status==\backend\models\TransferedGood::PENDING) {

                        return 'Pending';
                    }
                    elseif($searchModel->status==\backend\models\TransferedGoodSearch::RECEIVED){
                        return 'Received';
                    }
                    elseif($searchModel->status==\backend\models\TransferedGoodSearch::CANCELED){
                        return 'Reversed';
                    }
                }
            ],

            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{confirm} {reverse}',
                'buttons'=>[
                    'confirm' => function ($url, $model) {
                        $url=['confirm','id' => $model->id];
                        return Html::a('<span class="fa fa-check"></span>', $url, [
                            'title' => 'Received',
                            'data-toggle'=>'tooltip','data-original-title'=>'Confirm',
                            'class'=>'btn btn-info',

                        ]);


                    },

                    'reverse' => function ($url, $model) {
                        $url=['reverse','id' => $model->id];
                        return Html::a('<span class="fa fa-retweet"></span>', $url, [
                            'title' => 'Reverse',
                            'data-toggle'=>'tooltip','data-original-title'=>'Reverse',
                            'class'=>'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to reverse this batch?'),
                                'method' => 'post',
                            ],

                        ]);


                    }
                ]
            ],
        ],
    ]); ?>
</div>
