<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_employee_salary`.
 */
class m170515_125607_create_tbl_employee_salary_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_employee_salary', [
            'id' => $this->primaryKey(),
            'trn_dt'=>$this->date()->notNull(),
            'emp_id'=>$this->integer()->notNull(),
            'amount'=>$this->decimal()->notNull(),
            'comment'=>$this->string(200),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);

        // creates index for column `sales_id`
        $this->createIndex(
            'idx-tbl_employee_salary-emp_id',
            'tbl_employee_salary',
            'emp_id'
        );


        $this->addForeignKey(
            'fk-tbl_employee_salary-emp_id',
            'tbl_employee_salary',
            'emp_id',
            'tbl_employee',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-tbl_employee_salary-emp_id',
            'tbl_employee_salary'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-tbl_employee_salary-emp_id',
            'tbl_employee_salary'
        );
        $this->dropTable('tbl_employee_salary');
    }
}
