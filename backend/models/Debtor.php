<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_debtor".
 *
 * @property integer $id
 * @property string $date
 * @property string $name
 * @property string $amount
 * @property integer $sales_id
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblSales $sales
 */
class Debtor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_debtor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'name', 'amount'], 'required'],
            [['date', 'maker_time'], 'safe'],
            [['amount'], 'number'],
            [['sales_id'], 'integer'],
            [['delete_stat'], 'string', 'max' => 1],
            [['name', 'maker_id'], 'string', 'max' => 200],
            [['sales_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sales::className(), 'targetAttribute' => ['sales_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'name' => Yii::t('app', 'Name'),
            'amount' => Yii::t('app', 'Amount'),
            'sales_id' => Yii::t('app', 'Sales No'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasOne(Sales::className(), ['id' => 'sales_id']);
    }

    /**
     * gets all today debtors
     */

    public static function getTodayDebtors()
    {
        $debtors = Debtor::find()->where(['date'=>date('Y-m-d'),'delete_stat'=>" "])->all();

        if($debtors!=null){
            return $debtors;
        }
        else{
            return 0;
        }

    }

    public static function getTodayTotalDebtors()
    {
        $debtors = Debtor::find()->where(['date'=>date('Y-m-d'),'delete_stat'=>" "])->sum('amount');

        if($debtors!=null){
            return $debtors;
        }
        else{
            return 0;
        }

    }

    public static function getBalance($id)
    {
        $balance=Debtor::findOne($id);
        if($balance!=null){
            return $balance->amount;
        }
        else{
            return 0;
        }
    }
}
