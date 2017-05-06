<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_transfered_good".
 *
 * @property integer $id
 * @property string $transfer_date
 * @property integer $store_id
 * @property string $qty
 * @property string $balance
 * @property string $horse_number
 * @property string $trailer_number
 * @property string $driver_name
 * @property string $driver_phonenumber
 *
 * @property TblStore $store
 */
class TransferedGood extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $product_name;
    public $store_name;
    public $remaining;

    const PENDING=0;
    const RECEIVED=1;
    const CANCELED=-1;

    public static function tableName()
    {
        return 'tbl_transfered_good';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transfer_date', 'store_id', 'qty', 'balance', 'horse_number','product_id'], 'required'],
            [['transfer_date','maker_time'], 'safe'],
            [['store_id','product_id','status'], 'integer'],
            [['qty', 'balance','remaining'], 'number'],
            [['horse_number', 'trailer_number', 'driver_name','maker_id', 'driver_phonenumber'], 'string', 'max' => 200],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['store_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'transfer_date' => Yii::t('app', 'Transfer Date'),
            'store_id' => Yii::t('app', 'From'),
            'product_id'=>Yii::t('app', 'Product Name'),
            'qty' => Yii::t('app', 'Quantity'),
            'balance' => Yii::t('app', 'Remained balance'),
            'remaining'=>Yii::t('app', 'Remaining'),
            'horse_number' => Yii::t('app', 'Horse Number'),
            'trailer_number' => Yii::t('app', 'Trailer Number'),
            'driver_name' => Yii::t('app', 'Driver Name'),
            'driver_phonenumber' => Yii::t('app', 'Driver Phonenumber'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
            'status'=>Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'store_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
