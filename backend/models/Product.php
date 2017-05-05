<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%tbl_product}}".
 *
 * @property integer $id
 * @property string $product_code
 * @property string $barcode
 * @property string $product_name
 * @property string $description
 * @property integer $category
 * @property string $image
 * @property integer $status
 * @property string $maker_id
 * @property string $maker_time
 * @property string $auth_status
 * @property string $checker_id
 * @property string $checker_time
 *
 * @property TblInventory[] $tblInventories
 * @property TblPriceMaintanance[] $tblPriceMaintanances
 * @property TblCategory $category0
 * @property TblProductAttribute[] $tblProductAttributes
 * @property TblPurchase[] $tblPurchases
 * @property TblSales[] $tblSales
 * @property TblStockAdjustment[] $tblStockAdjustments
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_name', 'category', 'status'], 'required'],
            [['description'], 'string'],
            [['category', 'status','type_id'], 'integer'],
            [['maker_time',], 'safe'],
            [['product_name','maker_id',], 'string', 'max' => 200],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */

    //gets all products

    public static function getAll()
    {
        return ArrayHelper::map(Product::find()->all(),'id','product_name');
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_name' => Yii::t('app', 'Product Name'),
            'description' => Yii::t('app', 'Description'),
            'category' => Yii::t('app', 'Category'),
            'type_id' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventories()
    {
        return $this->hasMany(Inventory::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriceMaintanances()
    {
        return $this->hasMany(PriceMaintanance::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(Category::className(), ['id' => 'category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(ProductType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttributes()
    {
        return $this->hasMany(ProductAttribute::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchase::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sales::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockAdjustments()
    {
        return $this->hasMany(StockAdjustment::className(), ['product_id' => 'id']);
    }

    /**
     * gets product name
     */
    public static function getProductName($id){

        $product=Product::findOne($id);
       return $product->product_name;
    }

    /**
     * gets Category name
     */
    public static function getCategoryID($id){

        $product=Product::findOne($id);
        return $product->category;
    }
}
