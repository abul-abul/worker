<?php 

namespace App\Services;

use App\Contracts\CityInterface;
use App\City;

class CityService implements CityInterface
{

	/**
	* Create a new instance of CityService class
	*
	* @return void
	*/
	public function __construct()
	{
		$this->city = new City();
	}

	/**
	* Get City by Country code
	*
	* @param string $cityCode
	* @return array $countryCities
	*/
	public function getCountryCities($cityCode)
	{
		return $this->city->where('country_code', '=', $cityCode)->get();
	}

	/**
	* Get City latitude and longitude
	*
	* @param string $cityName
	* @return resposne
	*/
	public function getCityLatLong($cityName)
	{

		return $this->city->where('city', 'like', '%' . $cityName . '%')->first();
	}
}