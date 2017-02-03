<?php 

namespace App\Services;

use App\Contracts\QuestionInterface;
use App\Question;

class QuestionService implements QuestionInterface
{
	/**
	* Create a new instance of QuestionService class
	*
	* @return void
	*/
	public function __construct()
	{
		$this->question = new Question();
	}

	/**	
	 * Get all questions by category
	 *
	 * @param integer $categoryId
	 * @return response
	 */
	public function getAll($categoryId)
	{
		return $this->question->where('category_id', '=', $categoryId)->with('answers')->get();
	}

	/**
	 * Get one question.
	 *
	 * @param integer $id
	 * @return Collection
	 */
	public function getOne($id)
	{
		$question = $this->question->find($id);
		return $question;
	}
}