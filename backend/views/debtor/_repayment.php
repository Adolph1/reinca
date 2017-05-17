<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Debtor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="debtor-form">
    <div class="panel panel-success">
        <div class="panel-heading">Debtor Repayment Form</div>
        <div class="panel-body">
    <?php $form = ActiveForm::begin(['action'=>['debtor-repayment/create']]); ?>
     <?= Html::activeHiddenInput($repaymentModel, 'debtor_id',['value'=>$model->id])?>
      <?= $form->field($repaymentModel, 'trn_dt')->widget(DatePicker::ClassName(),
                [
                    //'name' => 'purchase_date',
                    //'value' => date('d-M-Y', strtotime('+2 days')),
                    'options' => ['placeholder' => 'Enter date'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);?>

    <?= $form->field($repaymentModel, 'debtor_name')->textInput(['value'=>$model->name,'readonly'=>'readonly']) ?>

    <?= $form->field($repaymentModel, 'due_amount')->textInput(['maxlength' => true,'readonly'=>'readonly','value'=>$model->amount,]) ?>

    <?= $form->field($repaymentModel, 'amount')->textInput(['maxlength' => true,'value'=>0,'onblur'=>'jsDispalyBalance(this)','onkeyup'=>'jsDispalyBalance(this)']) ?>

    <?= $form->field($repaymentModel, 'balance')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>

    <div class="form-group">
        <?= Html::submitButton($repaymentModel->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $repaymentModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>


<script>
    function jsDispalyBalance(data)
    {
        var tranferqty=document.getElementById('debtorrepayment-amount').value;
        var balance=document.getElementById('debtorrepayment-due_amount').value;
        //alert(tranferqty);

        document.getElementById("debtorrepayment-balance").value =balance-tranferqty;

    }
</script>

