<?php

namespace Reservat;

class VenueRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PDO
     */
    protected $pdo = null;

    /**
     * @var Reservat\Datamapper\VenueDatamapper
     */
    protected $mapper = null;

    /**
     * @var \Reservat\Repository\VenueRepository
     */
    protected $repo = null;

    /**
     * Create PDO instance and schema to test against
     */
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

        // DB
        $this->pdo = new \PDO('sqlite::memory:');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec($schema);

        // Dependencies
        $this->mapper = new Reservat\Datamapper\VenueDatamapper($this->pdo);
        $this->repo = new \Reservat\Repository\VenueRepository($this->pdo);
    }

    public function testGetRowCount()
    {
        $this->assertCount(0, $this->repo);
    }

    public function testAdd()
    {
        $venue = new \Reservat\Venue('Horse & Hounds', 'A local pub', '01234567890', 'AA1 1AA', '50.736455', '-0.878906', 20 * 60, 60 * 60);
        $this->mapper->insert($venue);
        $this->assertCount(1, $this->repo->getAll());
    }

    public function testUpdate()
    {
        $venue = new \Reservat\Venue('Horse & Hounds', 'A local pub', '01234567890', 'AA1 1AA', '50.736455', '-0.878906', 20 * 60, 60 * 60);
        $this->mapper->insert($venue);

        $venue->setName('The Old Bell End');
        $this->mapper->update($venue, 1);
        $venueUpdated = $this->repo->getById(1)->current();

        $this->assertEquals('The Old Bell End', $venueUpdated['name']);
    }

    public function testBadInsert()
    {
        try {
            $venue = new \Reservat\Venue(null, null, null, null, null, null, null, null);
            $this->mapper->save($venue);
        } catch (\Exception $e) {
            $this->assertCount(0, $this->repo->getAll());
        }
    }

    public function testSaveInsert()
    {
        $venue = new \Reservat\Venue('Horse & Hounds', 'A local pub', '01234567890', 'AA1 1AA', '50.736455', '-0.878906', 20 * 60, 60 * 60);
        $this->mapper->save($venue);

        $savedVenue = $this->repo->getById(1)->current();

        $this->assertEquals('Horse & Hounds', $savedVenue['name']);
    }

    public function testSaveUpdate()
    {
        $venue = new \Reservat\Venue('Horse & Hounds', 'A local pub', '01234567890', 'AA1 1AA', '50.736455', '-0.878906', 20 * 60, 60 * 60);
        $this->mapper->save($venue);

        $venue->setName('The Old Bell End');
        $this->mapper->save($venue, 1);
        $savedVenue = $this->repo->getById(1)->current();

        $this->assertEquals('The Old Bell End', $savedVenue['name']);
    }

    public function testRemove()
    {
        $venue = new \Reservat\Venue('Horse & Hounds', 'A local pub', '01234567890', 'AA1 1AA', '50.736455', '-0.878906', 20 * 60, 60 * 60);

        $this->mapper->insert($venue);
        $this->mapper->delete($venue, 1);

        $this->assertCount(0, $this->repo->getAll());
    }
}
