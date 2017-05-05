<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_product_type`.
 */
class m170113_155021_create_tbl_product_type_table extends Migration
{
    /*
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_product_type', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(200)->notNull(),
            'description'=>$this->string(200)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_product_type');
    }
}
