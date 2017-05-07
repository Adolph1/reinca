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
        <div class="panel-heading"><h4><i class="fa fa-bars bg-success"></i> Today sales report</h4></div>
        <div class="panel-body">

    <div class="row">
        <div class="col-md-8">

            <table class="table table-bordered table-condensed table-hover small kv-table">
                <tbody>
                <tr class="active">
                    <th class="text-left">Total solid products</th>
                    <th class="text-left">Total cash sales</th>
                    <th class="text-center">Total credit sales</th>
                    <th class="text-center">Total expenses</th>
                </tr>
                <?php
                /*foreach ($products as $product) {
                    if($product->min_level>$product->qty){
                        echo '<tr><td class="text-left">'.Product::getProductName($product->product_id).'</td><td>'.\backend\models\Category::getName(Product::getCategoryID($product->product_id)).'</td><td  class="text-center">'.$product->qty.'</td><td  class="text-center">'.$product->min_level.'</td></tr>';
                    }
                }*/
                ?>
                </tbody>
            </table>

        </div>
        <div class="col-md-4">


            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">

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

