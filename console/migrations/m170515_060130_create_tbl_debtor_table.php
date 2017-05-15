<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_debtor`.
 */
class m170515_060130_create_tbl_debtor_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_debtor', [
            'id' => $this->primaryKey(),
            'date'=>$this->date()->notNull(),
            'name'=>$this->string(200)->notNull(),
            'amount'=>$this->decimal()->notNull(),
            'sales_id'=>$this->integer(),
            'delete_stat'=>$this->char(1),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),

        ]);

        // creates index for column `sales_id`
        $this->createIndex(
            'idx-tbl_debtor-sales_id',
            'tbl_debtor',
            'sales_id'
        );


        $this->addForeignKey(
            'fk-tbl_debtor-sales_id',
            'tbl_debtor',
            'sales_id',
            'tbl_sales',
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
            'fk-tbl_debtor-sales_id',
            'tbl_debtor'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-tbl_debtor-sales_id',
            'tbl_debtor'
        );
        $this->dropTable('tbl_debtor');
    }
}
