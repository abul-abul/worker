<?php

namespace App\Contracts;

interface AnswerInterface
{
	/**
	* Get All questions by $questionId
	*
	* @param string $questionId
	* @return void
	*/
	public function getAll($questionId);
}