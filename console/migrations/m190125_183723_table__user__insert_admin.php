<?php

use yii\db\Migration;

/**
 * Class m190125_183723_table__user__insert_admin
 */
class m190125_183723_table__user__insert_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->insert('{{%user}}',[
	    	'username'=>'admin', 'email'=>'admin@gmail.com',
		    'password_hash'=>'$2y$13$jIShknBfGsRrEn5z6DFmqe5gd/oAxhkumGyMEFV/velLePlo1C1Hy',
		    'status'=>10, 'role'=>4
	    ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    	$this->delete('{{%user}}',['username'=>'admin']);
    }
}
