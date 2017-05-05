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

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
