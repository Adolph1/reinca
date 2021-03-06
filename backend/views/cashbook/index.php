<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CashbookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cashbook Transactions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashbook-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Post Cash'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $searchModel = new \backend\models\CashbookSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    ?>
<?php Pjax::begin(); ?>    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'trn_dt',
            'amount',
            [
                'attribute'=>'drcr_ind',
                'value'=>function ($model){

                    if($model->drcr_ind==\backend\models\Cashbook::PAYMENT){
                        return "Payment";
                    }
                    elseif ($model->drcr_ind==\backend\models\Cashbook::RECEIPT){
                        return "Receipt";
                    }
                    elseif ($model->drcr_ind==\backend\models\Cashbook::EXPENSE){
                        return "Expense";
                    }
                }
            ],
            'description',
            'maker_id',
            'maker_time',
            // 'auth_status',
            // 'checker_id',
            // 'checker_time',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
