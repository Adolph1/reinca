<?php

use yii\helpers\Html;
use fedemotta\datatables\DataTables;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoreInventorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Branch inventories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-inventory-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    $searchModel = new \backend\models\StoreInventorySearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    ?>
<?php Pjax::begin(); ?>    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'store_id',
                'value'=>'store.store_name'
            ],
            [
                'attribute'=>'product_id',
                'value'=>'product.product_name'
            ],
            //'buying_price',
            'qty',
            'last_updated',
            // 'maker_id',
            // 'maker_time',

<<<<<<< HEAD
            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view} {block}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['view','id' => $model->id];
                        return Html::a('<span class="fa fa-eye"></span>', $url, [
                            'title' => 'View',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-info',

                        ]);


                    },

                    'block' => function ($url, $model) {
                        $url=['reverse','id' => $model->id];
                        return Html::a('<span class="fa fa-truck"></span>', $url, [
                            'title' => 'Transfer',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-primary',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to reverse this product?'),
                                'method' => 'post',
                            ],

                        ]);


                    }
                ]
            ],
=======
            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
>>>>>>> a80eafb421ddeb89bbf279bff9574ebdbb6e20f1
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
