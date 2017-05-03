<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Cashbook */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cashbook-form">
    <div class="panel panel-success">
        <div class="panel-heading">Cashbook Form</div>
        <div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'trn_dt')->widget(DatePicker::ClassName(),
                [
                    //'name' => 'purchase_date',
                    //'value' => date('d-M-Y', strtotime('+2 days')),
                    'options' => ['placeholder' => 'Enter date'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);?>
    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'drcr_ind')->dropDownList(['D'=>'Payment','C'=>'Receiving'],['prompt'=>'--Select--']) ?>


    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
