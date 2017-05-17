<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DebtorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Debtors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="debtor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a(Yii::t('app', 'Create Debtor'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'date',
            'name',
            'amount',
            'sales_id',

            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view} {payment}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['view','id' => $model->id];
                        return Html::a('<span class="fa fa-eye"></span>', $url, [
                            'title' => 'View',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-info',

                        ]);


                    },

                    'payment' => function ($url, $model) {
                        $url=['repayment','id' => $model->id];
                        return Html::a('<span class="fa fa-money"></span>', $url, [
                            'title' => 'Make Payment',
                            'data-toggle'=>'tooltip','data-original-title'=>'Repayment',
                            'class'=>'btn btn-warning',

                        ]);


                    }
                ]
            ],
        ],
    ]); ?>
</div>
