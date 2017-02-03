<?php 

namespace App\Contracts;

interface CityInterface
{	
	/**
	* Get City by Country code
	*
	* @param string $cityCode
	* @return array $countryCities
	*/
	public function getCountryCities($cityCode);

	/**
	* Get City latitude and longitude
	*
	* @param string $cityName
	* @return resposne
	*/
	public function getCityLatLong($cityName);
}
