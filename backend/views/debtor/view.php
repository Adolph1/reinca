<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Debtor */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Debtors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="debtor-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date',
            'name',
            'amount',
            'sales_id',
        ],
    ]) ?>
    <?php
    $searchModel = new \backend\models\DebtorRepaymentSearch();
    $dataProvider = $searchModel->searchbyId($model->id);
    ?>
<?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'trn_dt',
            //'debtor_id',
            'amount',
            'balance',
            'maker_id',
            'maker_time',

            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{reverse}',
                'buttons'=>[
                    'reverse' => function ($url, $model) {
                        $url=['debtor-repayment/reverse','id' => $model->id];
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
            ],
        ],
    ]); ?>

</div>
