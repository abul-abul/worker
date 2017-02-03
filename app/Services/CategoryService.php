<?php 

namespace App\Services;

use App\Contracts\CategoryInterface;
use App\Category;

class CategoryService implements CategoryInterface
{

	/**
	* Create a new instance of CityService class
	*
	* @return void
	*/
	public function __construct()
	{
		$this->category = new Category();
	}

	/**
	 * Get List of all categories.
	 *
	 * @return Collection
	 */
	public function getAll()
	{
		return $this->category->all();
	}

	/**
	 * Get category name by $categopryId
	 *
	 * @param integer $categoryId
	 * @return Collection
	 */
	public function getCategoryName($categoryId)
	{
		return $this->category->where('id', '=', $categoryId)->first();
	}

	/**
	 * Get category id by $categopryName
	 *
	 * @param string $categoryName
	 * @return Collection
	 */
	public function getCategoryId($categoryName)
	{
		return $this->category->where('name', '=', $categoryName)->first();
	}

	/**
	 * Get one category.
	 *
	 * @param integer $id
	 * @return Collection
	 */
	public function getOne($id)
	{
		return $this->category->find($id);
	}

}