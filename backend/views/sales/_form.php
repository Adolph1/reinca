<?php

use yii\helpers\Html;
use backend\models\PaymentMethod;
use backend\models\Cart;
use backend\models\Inventory;
use yii\bootstrap\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use backend\models\Product;
use kartik\spinner\Spinner;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\editable\Editable;

/* @var $this yii\web\View */
/* @var $model backend\models\Sales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-form">
    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="fa fa-bars bg-success"></i> Sales Register</h4></div>
        <div class="panel-body">

    <div class="row">
        <div class="col-md-8">
            <?php

            $data = Product::find()
                ->select(['product_name as value', 'product_name as  label','id as id'])
                ->asArray()
                ->all();

            //echo 'Product Name' .'<br>';
            echo AutoComplete::widget([
                    'options'=>[
                        'placeholder'=>'Enter product name or barcode',
                        'style'=>'width:300px;padding:8px'
                    ],
                'clientOptions' => [
                    'source' => $data,
                    'minLength'=>'3',
                    'autoFill'=>true,
                    'select' => new JsExpression("function( event, ui ) {
                    
                    $('#memberssearch-family_name_id').val(ui.item.id);
                    var id=ui.item.id;
                    //alert(ui.item.id);
                   // $('#prod-id').html(id);
                      $.get('".Yii::$app->urlManager->createUrl(['inventory/search','id'=>''])."'+id,function(data) {
                      if(data==\" \")
                        {
                            alert(\"No yet purchased\");
                        }
                        else if(data==\"outOfStock\"){
                            alert(\"Out of stock\");
                        }
                    else{
                        window.location.reload(true);
                        }

                     });
     
                 }")],
            ]);
            ?>
            <?= Html::activeHiddenInput($model, 'product_name',['id'=>'prd-id'])?>


            <div>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                   // 'filterModel' => $searchModel,
                    'columns' => [
                        ['class'=>'kartik\grid\SerialColumn'],

                        [
                                'attribute'=>'product_id',
                                'value'=>'product.product_name',
                        ],
                        [
                            'header'=>'In Stock',
                            'value'=>function ($model){

                                return Inventory::getQty($model->product_id);

                            }
                        ],
                        [
                            'class'=>'kartik\grid\EditableColumn',
                            'attribute'=>'price',
                            'refreshGrid' => true,
                            'format'=>['decimal', 2],
                            'editableOptions'=> [
                                'header'=>'Name',
                                'size'=>'md',
                                'formOptions' => ['action' => ['cart/editcart']],
                                'asPopover' => false,
                               // 'inputType'=>\kartik\editable\Editable::INPUT_SPIN,
                                'options'=>[
                                    'pluginOptions'=>['min'=>0, 'max'=>5000]
                                ]
                            ],

                        ],
                        [
                            'class'=>'kartik\grid\EditableColumn',
                            'attribute'=>'qty',
                            'refreshGrid' => true,

                            'editableOptions'=> [
                                'header'=>'Name',
                                'id'=>'qty',
                                'size'=>'md',
                                'formOptions' => ['action' => ['cart/editcart']],
                                'asPopover' => false,
                                //'inputType'=>Editable::INPUT_SPIN,
                                'options'=>[
                                    'pluginOptions'=>['min'=>0, 'max'=>5000],

                                ]
                            ],

                        ],
                        [
                                'attribute'=>'total',
                                'format'=>['decimal', 2],
                        ],


                        [
                            'class'=>'yii\grid\ActionColumn',
                            'header'=>'Actions',
                            'template'=>'{delete}',
                            'buttons'=>[
                                'delete' => function ($url, $model) {
                                    $url=['cart/delete','id' => $model->id];
                                    return Html::a('<span class="fa fa-remove"></span>', $url, [
                                        'title' => 'Remove',
                                        'class'=>'btn btn-danger',
                                        'data' => [
                                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                            'method' => 'post',
                                        ],
                                    ]);


                                }
                            ]
                        ],
                    ],
                ]); ?>
            </div>

        </div>
        <div class="col-md-4">

            <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-0',
                    'offset' => 'col-sm-offset-0',
                    'wrapper' => 'col-sm-12',
                    'error' => '',
                    'hint' => '',
                ],
            ],
            ]);
            $fmt=Yii::$app->formatter;
            ?>
            <div> <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true,'placeholder'=>'Enter Customer name'])->label(false) ?></div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">Discount</div>
                        <div class="col-md-6 text-right">
                    <?= $form->field($model, 'discount')->textInput(['maxlength' => true,'value'=>0,'onblur'=>'jsDispalyTotal(this)','onkeyup'=>'jsDispalyTotal(this)'])->label(false) ?>
                        </div>
                    </div>
                    <div style="visibility:hidden" id="total-amount"><?= Cart::getCartTotal()?></div>
                    <div class="row" style="padding: 10px">
                        <div class="col-md-6" style="border: dashed 1px #ccc;">
                            <div class="side-heading">
                                Total </div>
                            <div class="text text-center">
                                <span class="text-success" ><b><?= $fmt->asDecimal(Cart::getCartTotal(),2)?></b></span> </div>
                        </div>
                        <div class="col-md-6" style="border: dashed 1px #ccc;">
                            <div class="side-heading">
                                Amount Due </div>
                            <div class="text text-center">
                                <span class="text-warning"><b><?= $fmt->asDecimal(Cart::getCartTotal(),2)?></b></span>  </div>
                        </div>
                    </div>
                    <hr/>
                    <p>Add Payment</p>

                    <div><?= $form->field($model, 'payment_method')->dropDownList(PaymentMethod::getAll(),['prompt'=>Yii::t('app','--Select Method--')])->label(false) ?></div>
                    <div class="row">
                    <div class="col-md-9 text text-right">
                <?= $form->field($model, 'paid_amount')->textInput(['maxlength' => true,'value'=>Cart::getCartTotal()])->label(false) ?>
                    </div>
                    <div class="col-md-3">
                <?= Html::submitButton(Yii::t('app', 'Sale'), ['class' => 'btn btn-primary']) ?>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <?= $form->field($model, 'notes')->textarea(['maxlength' => true,'placeholder'=>'Enter any comment'])->label(false) ?>
                        </div>
                    </div>
            <?php ActiveForm::end(); ?>
                    </div>
                </div>

            </div>
        </div>

    </div>


        </div>
    </div>
<script>
    function jsDispalyTotal(data)
    {
        var discount=document.getElementById('sales-discount').value;
        var paidamount=document.getElementById('total-amount').innerHTML;
       // alert(paidamount);

        document.getElementById("sales-paid_amount").value = paidamount-discount;

    }
</script>
</div>

