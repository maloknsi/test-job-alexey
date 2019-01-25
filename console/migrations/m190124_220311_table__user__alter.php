<?php

use yii\db\Migration;

/**
 * Class m190124_220311_table__user__alter
 */
class m190124_220311_table__user__alter extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->addColumn('{{%user}}','user_auth_token',$this->string());
		$this->addColumn('{{%user}}','sms_code',$this->string(6));
		$this->addColumn('{{%user}}','fullName',$this->string()->notNull());
		$this->addColumn('{{%user}}','firstName',$this->string(50)->notNull());
		$this->addColumn('{{%user}}','lastName',$this->string(50)->notNull());
		$this->addColumn('{{%user}}','middleName',$this->string(50)->notNull());
		$this->addColumn('{{%user}}','birthDate',$this->date());
		$this->addColumn('{{%user}}','logo',$this->string());
		$this->addColumn('{{%user}}','address',$this->string()->notNull());
		$this->addColumn('{{%user}}','city',$this->string()->notNull());
		$this->addColumn('{{%user}}','role',$this->integer()->defaultValue(0));
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropColumn('{{%user}}','user_auth_token');
		$this->dropColumn('{{%user}}','sms_code');
		$this->dropColumn('{{%user}}','fullName');
		$this->dropColumn('{{%user}}','firstName');
		$this->dropColumn('{{%user}}','lastName');
		$this->dropColumn('{{%user}}','middleName');
		$this->dropColumn('{{%user}}','birthDate');
		$this->dropColumn('{{%user}}','logo');
		$this->dropColumn('{{%user}}','address');
		$this->dropColumn('{{%user}}','city');
		$this->dropColumn('{{%user}}','role');
	}

}
