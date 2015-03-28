<?

namespace Reservat;

use Reservat\Core\Interfaces\EntityInterface;
use Reservat\Interfaces\VenueInterface;

class Venue implements VenueInterface, EntityInterface
{

	protected $_name = null;
	protected $_description = null;
	protected $_telephone = null;
	protected $_email = null;
	protected $_password = null;
	protected $_lastLogin = null;
	protected $_postcode = null;
	protected $_latitude = null;
	protected $_longitude = null;
	protected $_slotInterval = null;
	protected $_occupiedTime = null;
	protected $_openingTimes = null;

	public function __construct($name, $description, $telephone, $email, $password, $lastLogin, $postcode, $latitude, $longitude, $capacity, $slotInterval, $occupiedTime)
	{
		$this->_name = $name;
		$this->_description = $description;
		$this->_telephone = $telephone;
		$this->_email = $email;
		$this->_password = $password;
		$this->_lastLogin = $lastLogin;
		$this->_postcode = $postcode;
		$this->_latitude = $latitude;
		$this->_longitude = $longitude;
		$this->_slotInterval = $slotInterval;
		$this->_occupiedTime = $occupiedTime;
	}

	public function getName()
	{
		return $this->_name;
	}

	public function getDescription()
	{
		return $this->_description;
	}

	public function getTelephoneNumber()
	{
		return $this->_telephoneNumber;
	}

	public function getEmailAddress()
	{
		return $this->_email;
	}

	public function getPassword()
	{
		return $this->_password;
	}

	public function getLastLogin()
	{
		return $this->_lastLogin;
	}

	public function getPostcode()
	{
		return $this->_postcode;
	}

	public function getLatLng()
	{
		return ['lat' => $this->_latitude, 'lng' => $this->_longitude];
	}

	public function getSlotInterval()
	{
		return $this->_slotInterval;
	}

	public function getOccupiedTime()
	{
		return $this->_occupiedTime;
	}

	public function getOpeningTimes()
	{
		if(!$this->_openingTimes){
			
		}

		return $this->_openingTimes;
	}

	public function toArray()
	{
		return [
			'name' => $this->_name,
			'description' => $this->_description,
			'email' => $this->_email,
			'password' => $this->_email,
			'lastLogin' => $this->_lastLogin,
			'postcode' => $this->_postcode,
			'latitude' => $this->_latitude,
			'longitude' => $this->_longitude,
			'slotInterval' => $this->_slotInterval,
			'occupiedTime' => $this->_occupiedTime,
			'openingTimes' => $this->_openingTimes
		];
	}

}