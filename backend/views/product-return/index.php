<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductReturnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Product Returns');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-return-index">

    <h1><?php // Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Add Return'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'trn_dt',
            [
                    'attribute'=>'return_type',
                    'value'=>function ($model){

                        if($model->return_type==\backend\models\ProductReturn::PURCHASE_RETURN){
                            return "Purchase Return";
                        }
                        elseif ($model->return_type==\backend\models\ProductReturn::SALES_RETURN){
                            return "Sales Return";
                        }
                    }
            ],
            [
                    'attribute'=>'product_id',
                    'value'=>'product.product_name',
            ],
            'price',
            'qty',
            'total',
            'source_ref_no',
            'description',
            //'status',
           // 'maker_id',
            //'maker_time',

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
                        return Html::a('<span class="fa fa-retweet"></span>', $url, [
                            'title' => 'Reverse',
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
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
