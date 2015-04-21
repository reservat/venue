<?php

namespace Reservat\Test;

use \Reservat\Manager\VenueManager;
use \Reservat\Foo;

use Aura\Di\Container;
use Aura\Di\Factory;

class VenueRepositoryTest extends \PHPUnit_Framework_TestCase
{

    protected $di = null;

    protected $manager = null;

    protected function setUp()
    {
        // Schema
        $schema =<<<SQL
        CREATE TABLE "venue" (
        "id" INTEGER PRIMARY KEY,
        "name" VARCHAR NOT NULL,
        "description" TEXT NOT NULL,
        "telephone" VARCHAR NOT NULL,
        "postcode" VARCHAR NOT NULL,
        "latitude" VARCHAR NOT NULL,
        "longitude" VARCHAR NOT NULL,
        "slot_interval" INT NOT NULL,
        "occupied_time" INT NOT NULL
        );
SQL;
        
        $this->di = new Container(new Factory);

        $this->di->set('db', function () {
            return new \PDO('sqlite::memory:');
        });

        $this->di->get('db')->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->di->get('db')->exec($schema);

        // Dependencies
        $this->manager = new \Reservat\Manager\VenueManager($this->di);
    }

    public function testGetRowCount()
    {
        $this->assertCount(0, $this->manager->getRepository());
    }

    public function testAdd()
    {
        $venue = new \Reservat\Venue('Horse & Hounds', 'A local pub', '01234567890', 'AA1 1AA', '50.736455', '-0.878906', 20 * 60, 60 * 60);
        $this->manager->getDatamapper()->insert($venue);
        $this->assertCount(1, $this->manager->getRepository()->getAll());
    }

    public function testUpdate()
    {
        $venue = new \Reservat\Venue('Horse & Hounds', 'A local pub', '01234567890', 'AA1 1AA', '50.736455', '-0.878906', 20 * 60, 60 * 60);
        $this->manager->getDatamapper()->insert($venue);

        $venue->setName('The Old Bell End');
        $this->manager->getDatamapper()->update($venue, 1);
        $venueUpdated = $this->manager->getRepository()->getById(1)->current();

        $this->assertEquals('The Old Bell End', $venueUpdated['name']);
    }

    public function testBadInsert()
    {
        try {
            $venue = new \Reservat\Venue(null, null, null, null, null, null, null, null);
            $this->manager->getDatamapper()->save($venue);
        } catch (\Exception $e) {
            $this->assertCount(0, $this->manager->getRepository()->getAll());
        }
    }

    public function testSaveInsert()
    {
        $venue = new \Reservat\Venue('Horse & Hounds', 'A local pub', '01234567890', 'AA1 1AA', '50.736455', '-0.878906', 20 * 60, 60 * 60);
        $this->manager->getDatamapper()->save($venue);

        $savedVenue = $this->manager->getRepository()->getById(1)->current();

        $this->assertEquals('Horse & Hounds', $savedVenue['name']);
    }

    public function testSaveUpdate()
    {
        $venue = new \Reservat\Venue('Horse & Hounds', 'A local pub', '01234567890', 'AA1 1AA', '50.736455', '-0.878906', 20 * 60, 60 * 60);
        $this->manager->getDatamapper()->save($venue);

        $venue->setName('The Old Bell End');
        $this->manager->getDatamapper()->save($venue, 1);
        $savedVenue = $this->manager->getRepository()->getById(1)->current();

        $this->assertEquals('The Old Bell End', $savedVenue['name']);
    }

    public function testRemove()
    {
        $venue = new \Reservat\Venue('Horse & Hounds', 'A local pub', '01234567890', 'AA1 1AA', '50.736455', '-0.878906', 20 * 60, 60 * 60);

        $this->manager->getDatamapper()->insert($venue);
        $this->manager->getDatamapper()->delete($venue, 1);

        $this->assertCount(0, $this->manager->getRepository()->getAll());
    }
}
