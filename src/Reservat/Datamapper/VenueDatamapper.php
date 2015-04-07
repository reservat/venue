<?php

namespace Reservat\Datamapper;

use Reservat\Core\Interfaces\SQLDatamapperInterface;
use Reservat\Core\Datamapper\PDODatamapper;

class VenueDatamapper extends PDODatamapper implements SQLDatamapperInterface
{
    /**
     * Return the table name we're interacting with.
     *
     * @return string
     */
    public function table()
    {
        return 'venue';
    }
}
