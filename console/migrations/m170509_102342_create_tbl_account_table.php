<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_account`.
 */
class m170509_102342_create_tbl_account_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_account', [
            'id' => $this->primaryKey(),
            'account_name'=>$this->string(200)->notNull(),
            'opening_balance'=>$this->decimal()->notNull(),
            'date_created'=>$this->date()->notNull(),
            'head_account'=>$this->integer(),
            'account_balance'=>$this->decimal()->notNull(),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_account');
    }
}
