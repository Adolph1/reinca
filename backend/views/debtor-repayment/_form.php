<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DebtorRepayment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="debtor-repayment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'trn_dt')->textInput() ?>

    <?= $form->field($model, 'debtor_id')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'balance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maker_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maker_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
