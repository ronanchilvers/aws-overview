<?php

use Phinx\Migration\AbstractMigration;

class Resources extends AbstractMigration
{
    /**
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function change()
    {
        $accounts = $this->table('resources', [
            'id' => 'resource_id',
        ]);
        $accounts
            ->addColumn('resource_account', 'integer')
            ->addColumn('resource_arn', 'string', ['length' => 2048, 'null' => false])
            ->addColumn('resource_region', 'string', ['length' => 256, 'null' => false])
            ->addColumn('resource_name', 'string', ['length' => 256, 'null' => false])
            ->addColumn('resource_state', 'string', ['length' => 256, 'null' => false])
            ->addTimestamps('resource_created', 'resource_updated')
            ->addIndex(['resource_arn'])
            ->create();
    }
}
