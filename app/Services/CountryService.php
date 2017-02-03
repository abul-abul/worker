<?php 

namespace App\Services;

use App\Contracts\CountryInterface;
use App\Country;

class CountryService implements CountryInterface
{

	/**
	* Create a new instance of CountryService class
	*
	* @return void
	*/
	public function __construct()
	{
		$this->country = new Country();
	}

	/**
	 * Get List of all Countries.
	 *
	 * @return Collection
	 */
	public function getAll()
	{
		return $this->country->all();
	}

	/**
	 * Get Country name by country code.
	 *
	 * @param string $countryCode
	 * @return response
	 */
	public function getCountryFullName($countryCode)
	{
		return $this->country->where('code', '=', $countryCode)->first();
	}

	public function getCountryCode($countryName)
	{
		return $this->country->where('name', '=', $countryName)->first();
	}
}