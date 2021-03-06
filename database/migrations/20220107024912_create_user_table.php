<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateUserTable extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('users', ['id' => false, 'primary_key' => 'id', 'comment' => '用户表']);
        $table->addColumn('id', 'integer', array('signed' => true, 'identity' => true, 'comment' => 'ID'))
            ->addColumn(Column::string('username')->setNull(true))
            ->addColumn(Column::integer('mobile')->setNull(true))
            ->addColumn(Column::string('password')->setNull(true)->setComment('密码哈希'))
            ->addTimestamps()
            ->addSoftDelete()
            ->create();
    }
}
