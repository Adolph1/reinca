<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Adjustment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adjustment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'transfered_good_id')->textInput() ?>

    <?= $form->field($model, 'total_qty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adjusted_stock')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transfered_qty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maker_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maker_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
