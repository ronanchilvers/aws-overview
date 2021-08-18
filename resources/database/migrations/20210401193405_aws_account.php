<?php

use Phinx\Migration\AbstractMigration;

class AwsAccount extends AbstractMigration
{
    /**
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function change()
    {
        $accounts = $this->table('accounts', [
            'id' => 'account_id',
        ]);
        $accounts
            ->addColumn('account_name', 'string', ['length' => 256, 'null' => false])
            ->addColumn('account_number', 'string', ['length' => 64, 'null' => false])
            ->addColumn('account_key', 'string', ['length' => 1024, 'null' => false])
            ->addColumn('account_secret', 'string', ['length' => 64, 'null' => false])
            ->addColumn('account_regions', 'string', ['length' => 4096, 'null' => true])
            ->addTimestamps('account_created', 'account_updated')
            ->create();
    }
}
