<?php

use Phinx\Migration\AbstractMigration;

class AwsAccount extends AbstractMigration
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
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $accounts = $this->table('accounts', [
            'id' => 'account_id',
        ]);
        $accounts
            ->addColumn('account_name', 'string', ['length' => 256, 'null' => false])
            ->addColumn('account_key', 'string', ['length' => 1024, 'null' => false])
            ->addColumn('account_secret', 'string', ['length' => 64, 'null' => false])
            ->addColumn('account_regions', 'string', ['length' => 4096, 'null' => true])
            ->addTimestamps('account_created', 'account_updated')
            ->create();
    }
}
