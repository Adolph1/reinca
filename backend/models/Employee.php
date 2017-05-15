<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tbl_employee".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $date_of_birth
 * @property string $job_title
 * @property string $salary
 * @property string $joining_date
 * @property string $maker_id
 * @property string $maker_time
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_employee';
    }



    //gets all employees

    public static function getAll()
    {
        return ArrayHelper::map(Employee::find()->all(),'id',function($model, $defaultValue) {
            return $model['first_name'] ." ". $model['last_name'];
        });
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'date_of_birth', 'job_title', 'salary', 'joining_date'], 'required'],
            [['date_of_birth', 'joining_date', 'maker_time'], 'safe'],
            [['salary'], 'number'],
            [['first_name', 'middle_name', 'last_name', 'job_title', 'maker_id'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'middle_name' => Yii::t('app', 'Middle Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'date_of_birth' => Yii::t('app', 'Date Of Birth'),
            'job_title' => Yii::t('app', 'Job Title'),
            'salary' => Yii::t('app', 'Salary'),
            'joining_date' => Yii::t('app', 'Joining Date'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }
}
