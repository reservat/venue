<?php

namespace Reservat;

class VenueTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Reservat\Venue
     */
    protected $venue = null;

    public function setUp()
    {
        if (!$this->venue instanceof Venue) {
            $this->venue = new \Reservat\Venue('Horse & Hounds', 'A local pub', '01234567890', 'AA1 1AA', '50.736455', '-0.878906', 20 * 60, 60 * 60);
        }

        return $this->venue;
    }

    public function testGetVenue()
    {
        // Getters
        $this->assertEquals('Horse & Hounds', $this->venue->getName());
        $this->assertEquals('A local pub', $this->venue->getDescription());
        $this->assertEquals('AA1 1AA', $this->venue->getPostcode());

        $this->assertEquals('50.736455', $this->venue->getLatLng()['lat']);
        $this->assertEquals('-0.878906', $this->venue->getLatLng()['lng']);

        $this->assertEquals(20 * 60, $this->venue->getSlotInterval());
        $this->assertEquals(60 * 60, $this->venue->getOccupiedTime());

        // Interface
        $this->assertEquals('01234567890', $this->venue->getTelephoneNumber());

    }

    public function testSetVenue()
    {

        // Change venue details
        $this->venue->setName('The Old Bell End');
        $this->venue->setDescription('A friendly local pub');
        $this->venue->setTelephoneNumber('9876543210');
        $this->venue->setPostcode('AA1 2AA');
        $this->venue->setLatitude('51.736455');
        $this->venue->setLongitude('-0.978906');
        $this->venue->setSlotInterval(25 * 60);
        $this->venue->setOccupiedTime(90 * 60);

        $this->assertEquals('The Old Bell End', $this->venue->getName());
        $this->assertEquals('A friendly local pub', $this->venue->getDescription());
        $this->assertEquals('AA1 2AA', $this->venue->getPostcode());

        $this->assertEquals('51.736455', $this->venue->getLatLng()['lat']);
        $this->assertEquals('-0.978906', $this->venue->getLatLng()['lng']);

        $this->assertEquals(25 * 60, $this->venue->getSlotInterval());
        $this->assertEquals(90 * 60, $this->venue->getOccupiedTime());

        $this->assertEquals('9876543210', $this->venue->getTelephoneNumber());
    }

    public function testInstanceToArray()
    {
        $array = $this->venue->toArray();

        $this->assertInternalType('array', $array);
        $this->assertCount(8, $array);
    }
}
