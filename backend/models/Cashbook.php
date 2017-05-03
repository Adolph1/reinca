<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_cashbook".
 *
 * @property integer $id
 * @property string $trn_dt
 * @property string $amount
 * @property string $drcr_ind
 * @property string $description
 * @property string $maker_id
 * @property string $maker_time
 * @property string $auth_status
 * @property string $checker_id
 * @property string $checker_time
 */
class Cashbook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    const PAYMENT='D';
    const RECEIPT='C';

    public static function tableName()
    {
        return 'tbl_cashbook';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trn_dt', 'amount', 'drcr_ind', 'description'], 'required'],
            [['trn_dt', 'maker_time', 'checker_time'], 'safe'],
            [['amount'], 'number'],
            [['drcr_ind', 'auth_status'], 'string', 'max' => 1],
            [['description', 'maker_id', 'checker_id'], 'string', 'max' => 200],
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
            'amount' => Yii::t('app', 'Amount'),
            'drcr_ind' => Yii::t('app', 'Transaction Type'),
            'description' => Yii::t('app', 'Description'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
            'auth_status' => Yii::t('app', 'Auth Status'),
            'checker_id' => Yii::t('app', 'Checker ID'),
            'checker_time' => Yii::t('app', 'Checker Time'),
        ];
    }
}
