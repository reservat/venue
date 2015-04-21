<?php

namespace Reservat\Manager;

use Reservat\Core\Interfaces\ManagerInterface;
use Reservat\Repository\VenueRepository;
use Reservat\Datamapper\VenueDatamapper;
use Reservat\Venue;

class VenueManager implements ManagerInterface
{
    public function __construct($di)
    {
        $this->repository = new VenueRepository($di->get('db'));
        $this->datamapper = new VenueDatamapper($di->get('db'));
    }

    public function getRepository()
    {
        return $this->repository;
    }

    public function getDatamapper()
    {
        return $this->datamapper;
    }

    public function getEntity(...$args)
    {
        return new Venue(...$args);
    }
}
