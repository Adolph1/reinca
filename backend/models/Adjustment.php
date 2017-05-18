<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_adjustment".
 *
 * @property integer $id
 * @property integer $transfered_good_id
 * @property string $total_qty
 * @property string $adjusted_stock
 * @property string $transfered_qty
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblTransferedGood $transferedGood
 */
class Adjustment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_adjustment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transfered_good_id', 'total_qty', 'adjusted_stock', 'transfered_qty','comment'], 'required'],
            [['transfered_good_id'], 'integer'],
            [['total_qty', 'adjusted_stock', 'transfered_qty'], 'number'],
            [['maker_time'], 'safe'],
            [['maker_id','comment'], 'string', 'max' => 200],
            [['transfered_good_id'], 'exist', 'skipOnError' => true, 'targetClass' => TransferedGood::className(), 'targetAttribute' => ['transfered_good_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'transfered_good_id' => Yii::t('app', 'Transfered Good ID'),
            'total_qty' => Yii::t('app', 'Origin Qty'),
            'adjusted_stock' => Yii::t('app', 'Adjusted Stock'),
            'transfered_qty' => Yii::t('app', 'Received Qty'),
            'comment' => Yii::t('app', 'Add comment'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransferedGood()
    {
        return $this->hasOne(TransferedGood::className(), ['id' => 'transfered_good_id']);
    }
}
