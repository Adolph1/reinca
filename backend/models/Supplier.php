<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_supplier".
 *
 * @property integer $id
 * @property string $supplier_name
 * @property string $email
 * @property string $phone_number
 * @property string $location
 *
 * @property TblPurchase[] $tblPurchases
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_supplier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_name', 'phone_number', 'location'], 'required'],
            [['supplier_name', 'email'], 'string', 'max' => 200],
            [['location'], 'integer'],
            [['phone_number'], 'string', 'max' => 200],
        ];
    }

    //gets all Suppliers

    public static function getAll()
    {
        return ArrayHelper::map(Supplier::find()->all(),'id','supplier_name');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'supplier_name' => Yii::t('app', 'Supplier Name'),
            'email' => Yii::t('app', 'Email'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'location' => Yii::t('app', 'Location'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblPurchases()
    {
        return $this->hasMany(Purchase::className(), ['supplier_id' => 'id']);
    }

    /*
     * Gets supplier name
     */

    public static function getSupplierName($id)
    {
        if (($model = Supplier::findOne($id)) !== null) {
            return $model->supplier_name;
        } else {
            return "";
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'location']);
    }
}
