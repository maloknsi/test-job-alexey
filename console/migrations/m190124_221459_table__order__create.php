<?php

use yii\db\Migration;

/**
 * Class m190124_221459_table__order__create
 */
class m190124_221459_table__order__create extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%order}}', [
			'id' => $this->primaryKey(),
			'user_id' => $this->integer()->notNull(),
			'service_id' => $this->integer(2)->notNull(),
			'numb_serial' => $this->integer(),
			'box' => $this->integer(),
			'code' => $this->integer(),
			'degree_wear' => $this->integer()->notNull(),
			'defects' => $this->text(),
			'warning' => $this->text(),
			'date_receipt' => $this->dateTime(),
			'date_issue' => $this->dateTime(),
			'status' => $this->integer(2)->notNull(),
			'pay_type' => $this->integer(2)->notNull(),
			'pay_status' => $this->integer(2)->notNull(),
			'shipment' => $this->integer(2)->notNull()->defaultValue(0),
			'price' => $this->integer()->notNull(),
		], $tableOptions);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('{{%order}}');
	}
}
