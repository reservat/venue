<?php

namespace Reservat;

use Reservat\Core\Interfaces\EntityInterface;
use Reservat\Interfaces\VenueInterface;

class Venue implements VenueInterface, EntityInterface
{
    protected $name = null;
    protected $description = null;
    protected $telephone = null;
    protected $postcode = null;
    protected $latitude = null;
    protected $longitude = null;
    protected $slotInterval = null;
    protected $occupiedTime = null;
    protected $openingTimes = null;
    
    public function __construct($name, $description, $telephone, $postcode, $latitude, $longitude, $slotInterval, $occupiedTime)
    {
        $this->name = $name;
        $this->description = $description;
        $this->telephone = $telephone;
        $this->postcode = $postcode;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->slotInterval = $slotInterval;
        $this->occupiedTime = $occupiedTime;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getTelephoneNumber()
    {
        return $this->telephone;
    }

    public function setTelephoneNumber($telephoneNumber)
    {
        $this->telephone = $telephoneNumber;
    }

    public function getEmailAddress()
    {
        return $this->email;
    }

    public function setEmailAddress($email)
    {
        $this->email = $email;
    }

    public function getPostcode()
    {
        return $this->postcode;
    }

    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    public function getLatLng()
    {
        return ['lat' => $this->latitude, 'lng' => $this->longitude];
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    public function getSlotInterval()
    {
        return $this->slotInterval;
    }

    public function setSlotInterval($slotInterval)
    {
        $this->slotInterval = $slotInterval;
    }

    public function getOccupiedTime()
    {
        return $this->occupiedTime;
    }

    public function setOccupiedTime($occupiedTime)
    {
        $this->occupiedTime = $occupiedTime;
    }

    public function getOpeningTimes()
    {
        if (!$this->openingTimes) {
        }

        return $this->openingTimes;
    }

    public function toArray()
    {
        return [
	        'name' => $this->name,
	        'description' => $this->description,
	        'telephone' => $this->telephone,
	        'postcode' => $this->postcode,
	        'latitude' => $this->latitude,
	        'longitude' => $this->longitude,
	        'slot_interval' => $this->slotInterval,
	        'occupied_time' => $this->occupiedTime
        ];
    }

    public static function createFromArray(array $data)
    {
    	return new static (
    		$data['name'], 
    		$data['description'], 
    		$data['telephone'], 
    		$data['postcode'], 
    		$data['latitude'], 
    		$data['longitude'], 
    		$data['slotInterval'], 
    		$data['occupiedTime']
    	);
    }
}
