<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_store_inventory".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $buying_price
 * @property string $qty
 * @property integer $store_id
 * @property string $last_updated
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblProduct $product
 * @property TblStore $store
 */
class StoreInventory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_store_inventory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'buying_price', 'qty', 'store_id', 'maker_id', 'maker_time'], 'required'],
            [['product_id', 'store_id'], 'integer'],
            [['buying_price','selling_price', 'qty'], 'number'],
            [['last_updated', 'maker_time'], 'safe'],
            [['maker_id'], 'string', 'max' => 200],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
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
            'product_id' => Yii::t('app', 'Product Name'),
            'buying_price' => Yii::t('app', 'Buying Price'),
            'selling_price' => Yii::t('app', 'Selling Price'),
            'qty' => Yii::t('app', 'Qty'),
            'store_id' => Yii::t('app', 'Store'),
            'last_updated' => Yii::t('app', 'Last Updated'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'store_id']);
    }
}
