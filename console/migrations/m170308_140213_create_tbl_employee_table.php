<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_employee`.
 */
class m170308_140213_create_tbl_employee_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_employee', [
            'id' => $this->primaryKey(),
            'first_name'=>$this->string(200)->notNull(),
            'middle_name'=>$this->string(200),
            'last_name'=>$this->string(200)->notNull(),
            'date_of_birth'=>$this->date()->notNull(),
            'job_title'=>$this->string(200)->notNull(),
            'salary'=>$this->decimal()->notNull(),
            'joining_date'=>$this->date()->notNull(),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_employee');
    }
}
