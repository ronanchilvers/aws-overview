<?php

use Phinx\Migration\AbstractMigration;

class States extends AbstractMigration
{
    public function change()
    {
        $states = $this->table('states', [
            'id' => 'state_id',
        ]);
        $states
            ->addColumn('state_key', 'string', ['length' => 32, 'null' => false])
            ->addColumn('state_value', 'string', ['length' => 128, 'null' => false])
            ->addTimestamps('state_created', 'state_updated')
            ->addIndex(['state_key'])
            ->create();
    }
}
