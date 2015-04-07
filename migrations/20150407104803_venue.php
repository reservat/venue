<?php

namespace Reservat\Migrations;

use Phinx\Migration\AbstractMigration;

class Venue extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table('venue');
        $table
            ->addColumn('name', 'string', array('limit' => 30))
            ->addColumn('description', 'text')
            ->addColumn('telephone', 'string', array('limit' => 20))
            ->addColumn('postcode', 'string', array('limit' => 10))
            ->addColumn('latitude', 'string', array('limit' => 20))
            ->addColumn('longitude', 'string', array('limit' => 20))
            ->addColumn('slot_interval', 'integer')
            ->addColumn('occupied_time', 'integer')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->create()
        ;
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->table('venue')->drop();
    }
}
