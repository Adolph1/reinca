<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_account".
 *
 * @property integer $id
 * @property string $account_name
 * @property string $opening_balance
 * @property string $date_created
 * @property integer $head_account
 * @property string $account_balance
 * @property string $maker_id
 * @property string $maker_time
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_name', 'opening_balance', 'date_created', 'account_balance'], 'required'],
            [['opening_balance', 'account_balance'], 'number'],
            [['date_created', 'maker_time'], 'safe'],
            [['head_account'], 'integer'],
            [['account_name', 'maker_id'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'account_name' => Yii::t('app', 'Account Name'),
            'opening_balance' => Yii::t('app', 'Opening Balance'),
            'date_created' => Yii::t('app', 'Date Created'),
            'head_account' => Yii::t('app', 'Head Account'),
            'account_balance' => Yii::t('app', 'Account Balance'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }
}
