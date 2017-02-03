<?php

namespace App\Contracts;

interface QuestionInterface
{
	/**	
	 * Get all questions by category
	 *
	 * @param integer $categoryId
	 * @return response
	 */
	public function getAll($categoryId);

	/**
	 * Get one question.
	 *
	 * @param integer $id
	 * @return Collection
	 */
	public function getOne($id);
}