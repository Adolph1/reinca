<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_debtor_repayment`.
 */
class m170517_155159_create_tbl_debtor_repayment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_debtor_repayment', [
            'id' => $this->primaryKey(),
            'trn_dt'=>$this->date(),
            'debtor_id'=>$this->integer()->notNull(),
            'amount'=>$this->decimal()->notNull(),
            'balance'=>$this->decimal()->notNull(),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);

        // creates index for column `debtor_id`
        $this->createIndex(
            'idx-tbl_debtor_repayment-debtor_id',
            'tbl_debtor_repayment',
            'debtor_id'
        );


        $this->addForeignKey(
            'fk-tbl_debtor_repayment-debtor_id',
            'tbl_debtor_repayment',
            'debtor_id',
            'tbl_debtor',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `tbl_debtor_repayment`
        $this->dropForeignKey(
            'fk-tbl_debtor_repayment-debtor_id',
            'tbl_debtor_repayment'
        );

        // drops index for column `debtor_id`
        $this->dropIndex(
            'idx-tbl_debtor_repayment-debtor_id',
            'tbl_debtor_repayment'
        );
        $this->dropTable('tbl_debtor_repayment');
    }
}
