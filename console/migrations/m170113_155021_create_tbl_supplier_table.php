<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_supplier`.
 */
class m170113_155021_create_tbl_supplier_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_supplier', [
            'id' => $this->primaryKey(),
            'supplier_name'=>$this->string(200)->notNull(),
            'email'=>$this->string(200),
            'phone_number'=>$this->string(200)->notNull(),
            'location'=>$this->integer()->notNull(),

        ]);
        // creates index for column `branch_id`
        $this->createIndex(
            'idx-tbl_supplier-location',
            'tbl_supplier',
            'location'
        );


        // add foreign key for table `tbl_purchase_master`
        $this->addForeignKey(
            'fk-tbl_supplier-location',
            'tbl_supplier',
            'location',
            'tbl_branch',
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
            'fk-tbl_supplier-location',
            'tbl_supplier'
        );

        // drops index for column `location`
        $this->dropIndex(
            'idx-tbl_supplier-location',
            'tbl_supplier'
        );
        $this->dropTable('tbl_supplier');
    }
}
