<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

	
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tasks';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */	
	protected $fillable = [ 'user_id' , 'description', 'city', 'country', 'category_id', 'category_img', 'location', 'choose_date'];

	/**
     * Get questions.
     */
	public function questions()
	{
		return $this->belongsToMany('App\Question','task_questions','task_id','question_id','answer')->withPivot('answer');
	}

	/**
     * Get task category.
     */
	public function category()
	{
		return $this->belongsTo('App\Category');
	}

	/**
     * Get user tasks.
     */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	/**
     * Get provider respond.
     */
	public function taskUser()
    {
        return $this->belongsToMany('App\User','provider_responds','task_id','user_id','description','money')->withPivot('description','money');
    }

    public function providers()
    {
    	return $this->belongsToMany('App\User','task_providers','task_id','provider_id')->withPivot('description','money');
    }
}
