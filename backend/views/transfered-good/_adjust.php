<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Adjustment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adjustment-form">
    <div class="panel panel-success">
        <div class="panel-heading"><?= Yii::t('app','Transfered Stock Adjustment Form');?></div>
        <div class="panel-body">
    <?php $form = ActiveForm::begin(['action'=>['adjustment/create']]); ?>

     <?= Html::activeHiddenInput($adjustModel, 'transfered_good_id',['value'=>$model->id])?>
    <?= $form->field($adjustModel, 'total_qty')->textInput(['maxlength' => true,'readonly'=>'readonly','value'=>$model->qty]) ?>

    <?= $form->field($adjustModel, 'adjusted_stock')->textInput(['maxlength' => true,'value'=>0,'onblur'=>'jsDispalyAdjBalance(this)','onkeyup'=>'jsDispalyAdjBalance(this)']) ?>

    <?= $form->field($adjustModel, 'transfered_qty')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>

     <?= $form->field($adjustModel, 'comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($adjustModel->isNewRecord ? Yii::t('app', 'Adjust') : Yii::t('app', 'Update'), ['class' => $adjustModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


<script>
    function jsDispalyAdjBalance(data)
    {
        var tranferqty=document.getElementById('adjustment-adjusted_stock').value;
        var balance=document.getElementById('adjustment-total_qty').value;
        //alert(tranferqty);

        document.getElementById("adjustment-transfered_qty").value =balance-tranferqty;

    }
</script>