<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_debtor_repayment".
 *
 * @property integer $id
 * @property string $trn_dt
 * @property integer $debtor_id
 * @property string $amount
 * @property string $balance
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblDebtor $debtor
 */
class DebtorRepayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $due_amount;
    public $debtor_name;
    public $remaining;


    public static function tableName()
    {
        return 'tbl_debtor_repayment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trn_dt', 'maker_time'], 'safe'],
            [['debtor_id', 'amount', 'balance','trn_dt'], 'required'],
            [['debtor_id'], 'integer'],
            [['amount', 'balance'], 'number'],
            [['maker_id'], 'string', 'max' => 200],
            [['debtor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Debtor::className(), 'targetAttribute' => ['debtor_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trn_dt' => Yii::t('app', 'Trn Dt'),
            'debtor_id' => Yii::t('app', 'Debtor Name'),
            'amount' => Yii::t('app', 'Amount'),
            'balance' => Yii::t('app', 'Balance'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDebtor()
    {
        return $this->hasOne(Debtor::className(), ['id' => 'debtor_id']);
    }
}
