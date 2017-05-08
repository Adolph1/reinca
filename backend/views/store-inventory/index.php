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
            'buying_price',
            'selling_price',
            'qty',
            'last_updated',
            // 'maker_id',
            // 'maker_time',

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
                        $url=['transfer','id' => $model->id];
                        return Html::a('<span class="fa fa-truck"></span>', $url, [
                            'title' => 'Transfer',
                            'data-toggle'=>'tooltip','data-original-title'=>'Transfer',
                            'class'=>'btn btn-primary',

                        ]);


                    }
                ]
            ],


            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],


        ],
    ]); ?>
<?php Pjax::end(); ?></div>
