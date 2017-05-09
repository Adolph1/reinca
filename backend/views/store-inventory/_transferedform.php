<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\TransferedGood */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transfered-good-form">

    <?php $form = ActiveForm::begin(['action'=>['transfered-good/create']]); ?>


    <?= $form->field($transfered, 'transfer_date')->widget(DatePicker::ClassName(),
        [
            //'name' => 'purchase_date',
            //'value' => date('d-M-Y', strtotime('+2 days')),
            'options' => ['placeholder' => 'Enter date'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ]
        ]);?>

    <?= $form->field($transfered, 'store_name')->textInput(['value'=>$model->store->store_name,'readonly'=>'readonly',]) ?>
    <?= Html::activeHiddenInput($transfered, 'store_id',['value'=>$model->store_id])?>
    <?= Html::activeHiddenInput($transfered, 'product_id',['value'=>$model->product_id])?>

    <?= $form->field($transfered, 'product_name')->textInput(['maxlength' => true,'readonly'=>'readonly','value'=>$model->product->product_name]) ?>

    <?= $form->field($transfered, 'balance')->textInput(['maxlength' => true,'readonly'=>'readonly','value'=>$model->qty]) ?>
    <?= $form->field($transfered, 'qty')->textInput(['maxlength' => true,'value'=>0,'onblur'=>'jsDispalyBalance(this)','onkeyup'=>'jsDispalyBalance(this)']) ?>
    <?= $form->field($transfered, 'remaining')->textInput(['maxlength' => true,'readonly'=>'readonly','value'=>$model->qty]) ?>

    <?= $form->field($transfered, 'horse_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($transfered, 'trailer_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($transfered, 'driver_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($transfered, 'driver_phonenumber')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($transfered->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $transfered->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<script>
    function jsDispalyBalance(data)
    {
        var tranferqty=document.getElementById('transferedgood-qty').value;
        var balance=document.getElementById('transferedgood-balance').value;
         //alert(tranferqty);

        document.getElementById("transferedgood-remaining").value =balance-tranferqty;

    }
</script>
