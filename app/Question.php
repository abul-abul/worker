<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

	
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'questions';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [ 'category_id' , 'question','type'];
	
	/**
	* get answers
	*/	
	public function answers()
	{
		 return $this->hasMany('App\Answer');
	}

}
