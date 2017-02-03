<?php 

namespace App\Services;

use App\Contracts\TaskProviderInterface;
use App\TaskProvider;

class TaskProviderService implements TaskProviderInterface
{

	/**
	* Create a new instance of CountryService class
	*
	* @return void
	*/
	public function __construct()
	{
		$this->taskProvider = new TaskProvider();
	}

	/**
	 * 
	 */
	public function getAll()
	{
		return $this->taskProvider->get();
	}

}