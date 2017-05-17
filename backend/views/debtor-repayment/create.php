<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DebtorRepayment */

$this->title = Yii::t('app', 'Create Debtor Repayment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Debtor Repayments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="debtor-repayment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
