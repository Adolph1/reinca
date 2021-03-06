<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Branch;

/* @var $this yii\web\View */
/* @var $model backend\models\Store */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-form">
    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="fa fa-home bg-success"></i> Store Form</h4></div>
        <div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'store_name')->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, 'branch_id')->dropDownList(Branch::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>

    <?= $form->field($model, 'store_keeper')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
