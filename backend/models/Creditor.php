<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_creditor".
 *
 * @property integer $id
 * @property string $date
 * @property string $name
 * @property string $amount
 * @property string $delete_stat
 * @property string $maker_id
 * @property string $maker_time
 */
class Creditor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_creditor';
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
            [['name', 'maker_id','description'], 'string', 'max' => 200],
            [['delete_stat'], 'string', 'max' => 1],
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
            'description'=>'Description',
            'amount' => Yii::t('app', 'Amount'),
            'delete_stat' => Yii::t('app', 'Delete Stat'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }
}
