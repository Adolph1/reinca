<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransferedGoodSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transfered-good-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'transfer_date') ?>

    <?= $form->field($model, 'store_id') ?>

    <?= $form->field($model, 'qty') ?>

    <?= $form->field($model, 'balance') ?>

    <?php // echo $form->field($model, 'horse_number') ?>

    <?php // echo $form->field($model, 'trailer_number') ?>

    <?php // echo $form->field($model, 'driver_name') ?>

    <?php // echo $form->field($model, 'driver_phonenumber') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
