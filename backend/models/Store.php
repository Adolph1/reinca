<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tbl_store".
 *
 * @property integer $id
 * @property string $store_name
 * @property integer $branch_id
 * @property string $store_keeper
 *
 * @property TblBranch $branch
 */
class Store extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_store';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_name', 'branch_id', 'store_keeper'], 'required'],
            [['branch_id'], 'integer'],
            [['store_name', 'store_keeper'], 'string', 'max' => 200],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'store_name' => Yii::t('app', 'Store Name'),
            'branch_id' => Yii::t('app', 'Branch'),
            'store_keeper' => Yii::t('app', 'Store Keeper'),
        ];
    }
    //gets all branches

    public static function getAll()
    {
        return ArrayHelper::map(Store::find()->all(),'id','store_name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }
}
