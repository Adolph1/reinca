<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_branch".
 *
 * @property integer $id
 * @property string $branch_name
 * @property string $location
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_branch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_name', 'location'], 'required'],
            [['branch_name', 'location'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'branch_name' => Yii::t('app', 'Branch Name'),
            'location' => Yii::t('app', 'Location'),
        ];
    }

    //gets all branches

    public static function getAll()
    {
        return ArrayHelper::map(Branch::find()->all(),'id','branch_name');
    }
}
