<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_employee_salary".
 *
 * @property integer $id
 * @property string $trn_dt
 * @property integer $emp_id
 * @property string $amount
 * @property string $comment
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblEmployee $emp
 */
class EmployeeSalary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_employee_salary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trn_dt', 'emp_id', 'amount'], 'required'],
            [['trn_dt', 'maker_time'], 'safe'],
            [['emp_id'], 'integer'],
            [['amount'], 'number'],
            [['comment', 'maker_id'], 'string', 'max' => 200],
            [['emp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['emp_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trn_dt' => Yii::t('app', 'Payment date'),
            'emp_id' => Yii::t('app', 'Employee Name'),
            'amount' => Yii::t('app', 'Amount'),
            'comment' => Yii::t('app', 'Comment'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmp()
    {
        return $this->hasOne(Employee::className(), ['id' => 'emp_id']);
    }
}
