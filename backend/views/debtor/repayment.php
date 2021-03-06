<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Debtor */

$this->title = Yii::t('app', 'Create Debtor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Debtors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="debtor-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_repayment', [
        'model' => $model,'repaymentModel'=>$repaymentModel
    ]) ?>

</div>
