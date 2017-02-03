<?php 

namespace App\Contracts;

interface CountryInterface
{	
	/**
	 * Get List of all Countries.
	 *
	 * @return Collection
	 */
	public function getAll();

	/**
	 * Get Country name by country code.
	 *
	 * @param string $countryCode
	 * @return response
	 */
	public function getCountryFullName($countryCode);

}
