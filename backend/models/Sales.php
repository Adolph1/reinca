<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_sales".
 *
 * @property integer $id
 * @property string $trn_dt
 * @property string $total_qty
 * @property string $total_amount
 * @property string $paid_amount
 * @property integer $payment_method
 * @property string $source_ref_number
 * @property string $notes
 * @property string $customer_name
 * @property string $maker_id
 * @property string $maker_time
 * @property string $status
 *
 * @property TblSalesItem[] $tblSalesItems
 */
class Sales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const PAID='P';
    const CREDIT='C';
    const DELETED='D';

    const CASH=1;
    const ONCREDIT=2;
    const TPESA=3;
    const MPESA=4;



    public $product_name;
    public static function tableName()
    {
        return 'tbl_sales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_method','paid_amount','customer_name','trn_dt'], 'required'],
            [['trn_dt', 'maker_time'], 'safe'],
            [['total_qty', 'total_amount', 'paid_amount','due_amount','discount'], 'number'],
            [['payment_method'], 'integer'],
            [['source_ref_number', 'notes', 'customer_name', 'maker_id'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Sales No'),
            'trn_dt' => Yii::t('app', 'Date'),
            'total_qty' => Yii::t('app', 'Total Qty'),
            'discount'=> Yii::t('app', 'Discount'),
            'total_amount' => Yii::t('app', 'Total Amount'),
            'paid_amount' => Yii::t('app', 'Paid Amount'),
            'due_amount' => Yii::t('app', 'Due Amount'),
            'payment_method' => Yii::t('app', 'Payment Method'),
            'source_ref_number' => Yii::t('app', 'Source Ref Number'),
            'notes' => Yii::t('app', 'Notes'),
            'customer_name' => Yii::t('app', 'Customer Name'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesItems()
    {
        return $this->hasMany(SalesItem::className(), ['sales_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayMethod()
    {
        return $this->hasOne(PaymentMethod::className(), ['id' => 'payment_method']);
    }

    //gets one record of sales with respect to sales items
    public static function getSale($id)
    {
        return Sales::findOne($id);
    }

    /**
     * gets total today sold products
     */
    public static function getTotalQtySold()
    {
        $sales = Sales::find()->where(['trn_dt'=>date('Y-m-d')])->sum('total_qty');

        if($sales!=null){
            return $sales;
        }
        else{
            return 0;
        }

    }

    /**
     * gets total today cash sales
     */
    public static function getTodayCashSales()
    {
        $cash_sales = Sales::find()->where(['trn_dt'=>date('Y-m-d'),'payment_method'=>Sales::CASH])
            ->andWhere(['status'=>'P',])->sum('total_amount');

        if($cash_sales!=null){
            return $cash_sales;
        }
        else{
            return 0;
        }

    }


    /**
     * gets total today credit sales
     */
    public static function getTodayCreditSales()
    {
        $credit_sales = Sales::find()->where(['trn_dt'=>date('Y-m-d'),'payment_method'=>Sales::ONCREDIT])
            ->andWhere(['status'=>'C',])->sum('due_amount');

        if($credit_sales!=null){
            return $credit_sales;
        }
        else{
            return 0;
        }

    }



    /**
     * gets total today cash sales
     */
    public static function getCashSales()
    {
        $cash_sales = Sales::find()->where(['trn_dt'=>date('Y-m-d'),'payment_method'=>Sales::CASH])
            ->andWhere(['status'=>'P',])->all();

        if($cash_sales!=null){
            return $cash_sales;
        }
        else{
            return 0;
        }

    }



    /**
     * gets total today cash sales
     */
    public static function getAdvanceSales()
    {
        $cash_sales = Sales::find()->where(['trn_dt'=>date('Y-m-d'),'payment_method'=>Sales::CASH])
            ->andWhere(['status'=>'C',])->all();

        if($cash_sales!=null){
            return $cash_sales;
        }
        else{
            return 0;
        }

    }

    /**
     * gets total today cash sales
     */
    public static function getTotalAdvanceSales()
    {
        $cash_sales = Sales::find()->where(['trn_dt'=>date('Y-m-d'),'payment_method'=>Sales::CASH])
            ->andWhere(['status'=>'C',])->sum('paid_amount');

        if($cash_sales!=null){
            return $cash_sales;
        }
        else{
            return 0;
        }

    }

    /**
     * gets total today cash sales
     */
    public static function getTotalDueSales()
    {
        $cash_sales = Sales::find()->where(['trn_dt'=>date('Y-m-d'),'payment_method'=>Sales::CASH])
            ->andWhere(['status'=>'C',])->sum('due_amount');

        if($cash_sales!=null){
            return $cash_sales;
        }
        else{
            return 0;
        }

    }


    /**
     * gets total today credit sales
     */
    public static function getCreditSales()
    {
        $cash_sales = Sales::find()
            ->where(['trn_dt'=>date('Y-m-d'),'payment_method'=>Sales::ONCREDIT])
            ->andWhere(['status'=>'C',])->all();

        if($cash_sales!=null){
            return $cash_sales;
        }
        else{
            return 0;
        }

    }

    public static function getNetSales()
    {
        $netsales=(Sales::getTodayCashSales()+Sales::getTodayCreditSales()+Sales::getTotalAdvanceSales()+Sales::getTotalDueSales())-(Cashbook::getTodayTotalExpenses()+Cashbook::getTodayTotalPayments());
        if($netsales!=null){
            return $netsales;
        }
        else{
            return 0;
        }
    }




}
