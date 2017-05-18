<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_adjustment`.
 */
class m170518_113604_create_tbl_adjustment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_adjustment', [
            'id' => $this->primaryKey(),
            'transfered_good_id'=>$this->integer()->notNull(),
            'total_qty'=>$this->decimal()->notNull(),
            'adjusted_stock'=>$this->decimal()->notNull(),
            'transfered_qty'=>$this->decimal()->notNull(),
            'comment'=>$this->string(200)->notNull(),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);

        // creates index for column `sales_id`
        $this->createIndex(
            'idx-tbl_adjustment-transfered_good_id',
            'tbl_adjustment',
            'transfered_good_id'
        );


        $this->addForeignKey(
            'fk-tbl_adjustment-transfered_good_id',
            'tbl_adjustment',
            'transfered_good_id',
            'tbl_transfered_good',
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
            'fk-tbl_adjustment-transfered_good_id',
            'tbl_adjustment'
        );

        // drops index for column `transfered_good_id`
        $this->dropIndex(
            'idx-tbl_adjustment-transfered_good_id',
            'tbl_adjustment'
        );
        $this->dropTable('tbl_adjustment');
    }
}
