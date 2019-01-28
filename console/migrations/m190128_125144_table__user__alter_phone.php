<?php

use yii\db\Migration;

/**
 * Class m190128_125144_table__user__alter_phone
 */
class m190128_125144_table__user__alter_phone extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->addColumn('{{%user}}', 'phone', $this->bigInteger());
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropColumn('{{%user}}', 'phone');
	}
}
