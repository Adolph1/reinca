<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_creditor`.
 */
class m170515_060144_create_tbl_creditor_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_creditor', [
            'id' => $this->primaryKey(),
            'date'=>$this->date()->notNull(),
            'name'=>$this->string(200)->notNull(),
            'amount'=>$this->decimal()->notNull(),
            'description'=>$this->text(),
            'delete_stat'=>$this->char(1),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);


    }

    /**
     * @inheritdoc
     */
    public function down()
    {

        $this->dropTable('tbl_creditor');
    }
}
