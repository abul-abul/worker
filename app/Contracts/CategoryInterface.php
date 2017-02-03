<?php 

namespace App\Contracts;

interface CategoryInterface
{	
	/**
	 * Get List of all categories.
	 *
	 * @return Collection
	 */
	public function getAll();

	/**
	 * Get category name by $categopryId
	 *
	 * @param integer $categoryId
	 * @return Collection
	 */
	public function getCategoryName($categoryId);

	/**
	 * Get category id by $categopryName
	 *
	 * @param string $categoryName
	 * @return Collection
	 */
	public function getCategoryId($categoryName);


	/**
	 * Get one category.
	 *
	 * @param integer $id
	 * @return Collection
	 */
	public function getOne($id);

}
