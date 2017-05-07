<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_stock`.
 */
class m170504_170608_create_tbl_store_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_store', [
            'id' => $this->primaryKey(),
            'store_name'=>$this->string(200)->notNull(),
            'branch_id'=>$this->integer()->notNull(),
            'store_keeper'=>$this->string(200)->notNull(),

        ]);


        // creates index for column `branch_id`
        $this->createIndex(
            'idx-tbl_store-branch_id',
            'tbl_store',
            'branch_id'
        );


        // add foreign key for table `tbl_branch`
        $this->addForeignKey(
            'fk-tbl_store-branch_id',
            'tbl_store',
            'branch_id',
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
            'fk-tbl_store-branch_id',
            'tbl_store'
        );

        // drops index for column `supplier_id`
        $this->dropIndex(
            'idx-tbl_store-branch_id',
            'tbl_store'
        );
        $this->dropTable('tbl_store');
    }
}
