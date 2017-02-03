<?php 

namespace App\Services;

use App\Contracts\AnswerInterface;
use App\Answer;

class AnswerService implements AnswerInterface
{

	/**
	* Create a new instance of AnswerService class
	*
	* @return void
	*/
	public function __construct()
	{
		$this->answer = new Answer();
	}

	/**
	* Get All questions by $questionId
	*
	* @param string $questionId
	* @return void
	*/
	public function getAll($questionId)
	{	
		return $this->answer->where('question_id', '=', $questionId)->get();
	}

}