<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_store_inventory`.
 */
class m170504_181403_create_tbl_store_inventory_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_store_inventory', [
            'id' => $this->primaryKey(),
            'product_id'=>$this->integer()->notNull(),
            'buying_price'=>$this->decimal()->notNull(),
            'selling_price'=>$this->decimal()->notNull(),
            'qty'=>$this->decimal()->notNull(),
            'store_id'=>$this->integer()->notNull(),
            'last_updated'=>$this->dateTime(),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-tbl_store_inventory-product_id',
            'tbl_store_inventory',
            'product_id'
        );


        $this->addForeignKey(
            'fk-tbl_store_inventory-product_id',
            'tbl_store_inventory',
            'product_id',
            'tbl_product',
            'id',
            'CASCADE'
        );

        // creates index for column `store_id`
        $this->createIndex(
            'idx-tbl_store_inventory-store_id',
            'tbl_store_inventory',
            'store_id'
        );


        $this->addForeignKey(
            'fk-tbl_store_inventory-store_id',
            'tbl_store_inventory',
            'store_id',
            'tbl_store',
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
            'fk-tbl_store_inventory-product_id',
            'tbl_store_inventory'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-tbl_store_inventory-product_id',
            'tbl_store_inventory'
        );

        // drops foreign key for table `tbl_product`
        $this->dropForeignKey(
            'fk-tbl_store_inventory-store_id',
            'tbl_store_inventory'
        );

        // drops index for column `store_id`
        $this->dropIndex(
            'idx-tbl_store_inventory-store_id',
            'tbl_store_inventory'
        );
        $this->dropTable('tbl_store_inventory');
    }
}
