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
        <div class="panel-heading"><h4><i class="fa fa-bars bg-success"></i> Today Consolidated report</h4></div>
        <div class="panel-body">

    <div class="row">
        <div class="col-md-8">

            <p><b>Products sold by cash</b></p>

            <table class="table table-bordered table-condensed table-hover small kv-table">
                <tbody>
                <tr class="active">
                    <th class="text-left">Product Name</th>
                    <th class="text-left">Price</th>
                    <th class="text-left">Quantity</th>
                    <th class="text-left">Total</th>
                </tr>

                    <?php
                  $sales=Sales::getCashSales();
                    $totalcashqty = 0;
                    $totalcashamount = 0;
                  if($sales!=null) {

                      foreach ($sales as $sale) {
                          $cash_sales = SalesItem::find()->select(['product_id', 'sales_id', 'selling_price', 'sum(qty) AS qty', 'total'])->where(['trn_dt' => date('Y-m-d'), 'sales_id' => $sale->id])->groupBy('product_id')->all();
                          foreach ($cash_sales as $cash_sale) {
                              ?>
                              <tr>
                                  <td><?= \backend\models\Product::getProductName($cash_sale->product_id); ?></td>
                                  <td><?= $cash_sale->selling_price; ?></td>
                                  <td><?= $cash_sale->qty; ?></td>
                                  <td><?= $cash_sale->qty * $cash_sale->selling_price; ?></td>
                              </tr>
                              <?php
                              $totalcashqty = $totalcashqty + $cash_sale->qty;
                              $totalcashamount = $totalcashamount + ($cash_sale->qty * $cash_sale->selling_price);
                          }
                      }
                  }?>

                <tr><th class="text-right"></th><th class="text-right">Total</th><th class="text-left"><?=$totalcashqty;?></th><th class="text-left"><?=$totalcashamount;?></th></tr>
                </tbody>
            </table>



            <p><b>Products sold by credit</b></p>

            <table class="table table-bordered table-condensed table-hover small kv-table">
                <tbody>
                <tr class="active">
                    <th class="text-left">Product Name</th>
                    <th class="text-left">Price</th>
                    <th class="text-left">Quantity</th>
                    <th class="text-left">Total</th>
                </tr>

                <?php
                $credit_sales=Sales::getCreditSales();
                $totalcrqty = 0;
                $totalcramount = 0;
                if($credit_sales!=null) {

                    foreach ($credit_sales as $credit_sale) {

                        $cr_sales = SalesItem::find()->select(['product_id', 'sales_id', 'selling_price', 'sum(qty) AS qty', 'total'])->where(['trn_dt' => date('Y-m-d'), 'sales_id' => $credit_sale->id])->groupBy('product_id')->all();
                        foreach ($cr_sales as $cr_sale) {

                            ?>
                            <tr>
                                <td><?= \backend\models\Product::getProductName($cr_sale->product_id); ?></td>
                                <td><?= $cr_sale->selling_price; ?></td>
                                <td><?= $cr_sale->qty; ?></td>
                                <td><?= $cr_sale->qty * $cr_sale->selling_price; ?></td>
                            </tr>
                            <?php
                            $totalcrqty = $totalcrqty + $cr_sale->qty;
                            $totalcramount = $totalcramount + ($cr_sale->qty * $cr_sale->selling_price);
                        }
                    }
                }?>
                <tr><th class="text-right"></th><th class="text-right">Total</th><th class="text-left"><?=$totalcrqty;?></th><th class="text-left"><?=$totalcramount;?></th></tr>

                </tbody>
            </table>


            <p><b>Advance sales</b></p>

            <table class="table table-bordered table-condensed table-hover small kv-table">
                <tbody>
                <tr class="active">
                    <th class="text-left">Product Name</th>
                    <th class="text-left">Price</th>
                    <th class="text-left">Quantity</th>
                    <th class="text-left">Total</th>
                </tr>

                <?php
                $advance_sales=Sales::getAdvanceSales();

                $totaladvqty = 0;
                $totaladvamount = 0;
                if($advance_sales!=null) {

                    foreach ($advance_sales as $advance_sale) {

                        $ad_sales = SalesItem::find()->select(['product_id', 'sales_id', 'selling_price', 'sum(qty) AS qty', 'total'])->where(['trn_dt' => date('Y-m-d'), 'sales_id' => $advance_sale->id])->groupBy('product_id')->all();
                        foreach ($ad_sales as $ad_sale) {

                            ?>
                            <tr>
                                <td><?= \backend\models\Product::getProductName($ad_sale->product_id); ?></td>
                                <td><?= $ad_sale->selling_price; ?></td>
                                <td><?= $ad_sale->qty; ?></td>
                                <td><?= $ad_sale->qty * $ad_sale->selling_price; ?></td>
                            </tr>
                            <?php
                            $totaladvqty = $totaladvqty + $ad_sale->qty;
                            $totaladvamount = $totaladvamount + ($ad_sale->qty * $ad_sale->selling_price);
                        }
                    }
                }?>
                <tr><th class="text-right"></th><th class="text-right">Sub Total</th><th class="text-left"><?=$totaladvqty;?></th><th class="text-left"><?=$totaladvamount;?></th></tr>
                <tr><th class="text-right"></th><th class="text-right"></th><th class="text-right">Total advance payments</th><th class="text-left"><?=Sales::getTotalAdvanceSales();?></th></tr>
                <tr><th class="text-right"></th><th class="text-right"></th><th class="text-right">Net advance credit</th><th class="text-left"><?= $totaladvamount-Sales::getTotalAdvanceSales();?></th></tr>

                </tbody>
            </table>



            <p><b>Current Stocks</b></p>

            <table class="table table-bordered table-condensed table-hover small kv-table">
                <tbody>
                <tr class="active">
                    <th class="text-left">Product Name</th>
                    <th class="text-left">Quantity</th>

                </tr>

                <?php
                $inventories=\backend\models\Inventory::getAll();
                $totalivqty = 0;
                if($inventories!=null) {


                    foreach ($inventories as $inventory) {
                        ?>
                        <tr>
                            <td><?= \backend\models\Product::getProductName($inventory->product_id); ?></td>
                            <td><?= $inventory->qty; ?></td>
                        </tr>
                        <?php
                        $totalivqty = $totalivqty + $inventory->qty;

                    }
                }?>
                <tr><th class="text-right">Total</th><th class="text-left"><?=$totalivqty;?></th></tr>

                </tbody>
            </table>

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
                    <td><?= Sales::getTodayCashSales()+Sales::getTotalAdvanceSales();?></td>
                    <td><?= Sales::getTodayCreditSales()+Sales::getTotalDueSales();?></td>
                    <td><?= Cashbook::getTodayTotalExpenses()?></td>
                </tr>

                </tbody>
            </table>

        </div>
        <div class="col-md-4">


                    <div class="row">
                        <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Payments</div>
                            <div class="panel-body">

                            <table class="table table-bordered table-condensed table-hover small kv-table">
                            <tbody>
                            <tr class="active">
                                <th class="text-left">Amount</th>
                                <th class="text-left">Description</th>
                            </tr>

                            <?php
                            $payments=Cashbook::getTodayPayments();
                            if($payments!=null) {
                                foreach ($payments as $payment) {
                                    ?>
                                    <tr>
                                        <td><?= $payment->amount; ?></td>
                                        <td><?= $payment->description; ?></td>

                                    </tr>
                                    <?php


                                }
                            }?>


                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Expenses</div>
                    <div class="panel-body">

                            <table class="table table-bordered table-condensed table-hover small kv-table">
                                <tbody>
                                <tr class="active">
                                    <th class="text-left">Amount</th>
                                    <th class="text-left">Description</th>
                                </tr>

                                <?php
                                $expenses=Cashbook::getTodayExpenses();
                                if($expenses!=null) {
                                foreach ($expenses as $expense) {
                                    ?>
                                    <tr>
                                        <td><?= $expense->amount; ?></td>
                                        <td><?= $expense->description; ?></td>

                                    </tr>
                                    <?php

                                }
                                }?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>



            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Debtors</div>
                        <div class="panel-body">

                            <table class="table table-bordered table-condensed table-hover small kv-table">
                                <tbody>
                                <tr class="active">
                                    <th class="text-left">Amount</th>
                                    <th class="text-left">Debtor Name</th>
                                </tr>

                                <?php
                                $debtors=\backend\models\Debtor::getTodayDebtors();
                                if($debtors!=null) {
                                foreach ($debtors as $debtor){
                                    ?>
                                    <tr>
                                        <td><?= $debtor->amount; ?></td>
                                        <td><?= $debtor->name; ?></td>

                                    </tr>
                                    <?php
                                    }

                                }?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div><h1>Today Net Sales: <?= Sales::getNetSales();?></h1></div>
        </div>

    </div>


        </div>
    </div>
</div>

