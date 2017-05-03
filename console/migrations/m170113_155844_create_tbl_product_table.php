<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_product`.
 */
class m170113_155844_create_tbl_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_product', [
            'id' => $this->primaryKey(),
            'product_name'=>$this->string(200)->notNull(),
            'description'=>$this->text(),
            'category'=>$this->integer()->notNull(),
            'status'=>$this->integer()->notNull(),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),

        ]);

        // creates index for column `category`
        $this->createIndex(
            'idx-tbl_product-category',
            'tbl_product',
            'category'
        );

        // add foreign key for table `tbl_category`
        $this->addForeignKey(
            'fk-tbl_product-category',
            'tbl_product',
            'category',
            'tbl_category',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `tbl_category`
        $this->dropForeignKey(
            'fk-tbl_product-category',
            'tbl_product'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-tbl_product-category',
            'tbl_product'
        );
        $this->dropTable('tbl_product');
    }
}
