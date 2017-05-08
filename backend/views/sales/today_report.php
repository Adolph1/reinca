<?php

use yii\helpers\Html;
use backend\models\Sales;
use backend\models\Cashbook;
use backend\models\SalesItem;



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
                    <th class="text-left">Total sold products</th>
                    <th class="text-left">Total cash sales</th>
                    <th class="text-left">Total credit sales</th>
                    <th class="text-left">Total expenses</th>
                </tr>
                <tr>
                    <td><?= Sales::getTotalQtySold();?></td>
                    <td><?= Sales::getTodayCashSales();?></td>
                    <td><?= Sales::getTodayCreditSales();?></td>
                    <td><?= Cashbook::getTodayExpenses()?></td>
                </tr>

                </tbody>
            </table>

            Products sold by cash

            <table class="table table-bordered table-condensed table-hover small kv-table">
                <tbody>
                <tr class="active">
                    <th class="text-left">Product Name</th>
                    <th class="text-left">Quantity</th>
                    <th class="text-left">Price</th>
                    <th class="text-left">Total</th>
                </tr>

                    <?php

                    $cash_sales = SalesItem::find()->select(['product_id','sales_id','selling_price','sum(qty) AS qty','total'])->where(['trn_dt'=>date('Y-m-d')])->groupBy('product_id')->all();
                   foreach ($cash_sales as $cash_sale) {
                       ?>
                       <tr>
                           <td><?= \backend\models\Product::getProductName($cash_sale->product_id); ?></td>
                           <td><?= $cash_sale->qty; ?></td>
                           <td><?= $cash_sale->selling_price; ?></td>
                           <td><?= $cash_sale->qty * $cash_sale->selling_price; ?></td>
                       </tr>
                       <?php

                    }?>


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
</div>

