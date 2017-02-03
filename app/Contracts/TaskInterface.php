<?php 

namespace App\Contracts;

interface TaskInterface
{	
   /**
	* Create task to providers
	*
	* @param array $arrData
	* @return response
	*/
	public function createTask($arrData);

	/**
	* Get all seeker tasks
	*
	* @param integer $seekerId
	* @return response
	*/
	public function getSeekerTask($seekerId);

	/**
	* Get all seeker tasks
	*
	* @param integer $seekerId
	* @return response
	*/
	public function getSeekerTaskPassive($seekerId);

	/**
	* Get seeker task by $taskId
	*
	* @param integer $taskId
	* @return response
	*/
	public function getOneTask($taskId);

	/**
	* Get all seekers tasks
	*
	* @return response
	*/
	public function getAll();

	/**	
	 * Get all tasks by category
	 *
	 * @param integer $categoryId
	 * @return response
	 */
	public function categoryTasks($categoryId,$country);

	/**	
	 * Get all tasks by category
	 *
	 * @param integer $categoryId
	 * @return response
	 */
	public function getTasksById($categoryId);

	/**	
	 * remove task
	 *
	 * @param integer $taskId
	 * @return response
	 */
	public function remove($taskId);

	/**	
	 * Get all tasks by user_id
	 *
	 * @param integer $Id
	 * @return response
	 */
	public function getAlltaskByUserId($id);

	/**
    * upadet task
    *
    * 
    * @param array $data
    * @param integer $id
    * @return response
    */
	public function getUpdate($id,$data);

	/**
	 * 
	 */
	public function getAllInUser();

	/**
	 * Get all seeker tasks
	 *
	 * @param integer $seekerId
	 * @return response
	*/
	public function getSeekerNotRate();
	
}
