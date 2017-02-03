<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	protected $fillable = [ 'name' , 'description'];

	/**
     * Get provider category
     */
	public function users()
    {
        return $this->belongsToMany('App\User','provider_category');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task','category_id');
    }
}
