<?php 

namespace App\Services;

use App\Contracts\TaskInterface;
use App\Task;

class TaskService implements TaskInterface
{

	/**
	* Create a new instance of CountryService class
	*
	* @return void
	*/
	public function __construct()
	{
		$this->task = new Task();
	}

	/**
	* Create task to providers
	*
	* @param array $arrData
	* @return response
	*/
	public function createTask($arrData)
	{
		return $this->task->create($arrData);
	}

	/**
	* get all tasks
	*
	* 
	* @return response
	*/
	public function getTasksWithUser()
	{
		return $this->task->with('user', 'category')->get();
	}

	// /**
	// * Get all seeker tasks
	// *
	// * @param integer $seekerId
	// * @return response
	// */
	// public function getSeekerTask($seekerId)
	// {
	// 	return $this->task->where('user_id', '=', $seekerId)->where('status','active')->with('category')->get();
	// }

	/**
	 * Get all seeker tasks
	 *
	 * @param integer $seekerId
	 * @return response
	*/
	public function getSeekerTask($seekerId)
	{
		return $this->task->where('user_id', '=', $seekerId)->where('status','active')->orwhere('active_rate','active')->with('category')->get();
	}

	/**
	 * Get all seeker tasks
	 *
	 * @param integer $seekerId
	 * @return response
	*/
	public function getSeekerNotRate()
	{
		return $this->task->where('active_rate','passive')->where('status','active')->with('category')->get();
	}

	/**
	* Get all seeker tasks
	*
	* @param integer $seekerId
	* @return response
	*/
	public function getSeekerTaskPassive($seekerId)
	{
		return $this->task->where('user_id', '=', $seekerId)->where('status','passive')->with('category')->get();
	}

	/**
	* Get seeker task by $taskId
	*
	* @param integer $taskId
	* @return response
	*/
	public function getOneTask($taskId)
	{
		return $this->task->where('id', '=', $taskId)->with(['category', 'questions'])->first();
	}

	/**
	* Get all seekers tasks
	*
	* @return response
	*/
	public function getAll()
	{
		return $this->task->get();
	}

	/**
	 * 
	 */
	public function getAllInUser()
	{
		return $this->task->with('user')->get();
	}

	/**	
	 * Get all tasks by category
	 *
	 * @param integer $categoryId
	 * @return response
	 */
	public function categoryTasks($categoryId, $country)
	{
		// dd($country);
		return $this->task->where('category_id', $categoryId)->where('country', $country)->get();
	}

	public function search($data)
	{
		// dd($data);
		$search = $this->task;
		if ($data['description'] != ""){
			$search = $search->where('description', 'LIKE', '%'.$data['description'].'%');
		}
		if ($data['category_id']){
			$search = $search->where('category_id', '=', $data['category_id']);
		}
		if ($data['location']){
			$search = $search->where('location', 'LIKE', '%'.$data['location'].'%');
		}
		if ($data['sort_by'] == 'oldest') {
			$search = $search->oldest();
		} else {
			$search = $search->latest();
		}
		// dd($search);
		return $search->get();
	}

	/**	
	 * Get all tasks by category
	 *
	 * @param integer $categoryId
	 * @return response
	 */
	public function getTasksById($categoryId)
	{
		return $this->task->where('category_id', '=', $categoryId)->get();
	}

	/**	
	 * remove task
	 *
	 * @param integer $taskId
	 * @return response
	 */
	public function remove($taskId)
	{
		$task = $this->getOneTask($taskId)->delete();
		return $task;
	}

	/**	
	 * Get all tasks by user_id
	 *
	 * @param integer $Id
	 * @return response
	 */
	public function getAlltaskByUserId($id)
	{
		return $this->task->where('user_id', $id)->get();
	}

	/**
    * upadet task
    *
    * 
    * @param array $data
    * @param integer $id
    * @return response
    */
	public function getUpdate($id,$data)
	{
		return $this->task->where('id', '=', $id)->update($data);
	}

}