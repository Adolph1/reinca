<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_transfered_good`.
 */
class m170505_161321_create_tbl_transfered_good_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_transfered_good', [
            'id' => $this->primaryKey(),
            'transfer_date'=>$this->date()->notNull(),
            'store_id'=>$this->integer()->notNull(),
            'product_id'=>$this->integer()->notNull(),
            'qty'=>$this->decimal()->notNull(),
            'balance'=>$this->decimal()->notNull(),
            'horse_number'=>$this->string(200)->notNull(),
            'trailer_number'=>$this->string(200),
            'driver_name'=>$this->string(200),
            'driver_phonenumber'=>$this->string(200),
            'status'=>$this->integer(),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),

        ]);
        // creates index for column `store_id`
        $this->createIndex(
            'idx-tbl_transfered_good-store_id',
            'tbl_transfered_good',
            'store_id'
        );


        $this->addForeignKey(
            'fk-tbl_transfered_good-store_id',
            'tbl_transfered_good',
            'store_id',
            'tbl_store',
            'id',
            'CASCADE'
        );

        // creates index for column `product_id`
        $this->createIndex(
            'idx-tbl_transfered_good-product_id',
            'tbl_transfered_good',
            'product_id'
        );


        $this->addForeignKey(
            'fk-tbl_transfered_good-product_id',
            'tbl_transfered_good',
            'product_id',
            'tbl_product',
            'id',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `tbl_product`
        $this->dropForeignKey(
            'fk-tbl_transfered_good-store_id',
            'tbl_store_inventory'
        );

        // drops index for column `store_id`
        $this->dropIndex(
            'idx-tbl_transfered_good-store_id',
            'tbl_store_inventory'
        );

        // drops foreign key for table `tbl_product`
        $this->dropForeignKey(
            'fk-tbl_transfered_good-product_id',
            'tbl_transfered_good'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-tbl_transfered_good-product_id',
            'tbl_transfered_good'
        );
        $this->dropTable('tbl_transfered_good');
    }
}
