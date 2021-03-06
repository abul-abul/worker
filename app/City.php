<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{

	
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cities'; 

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [ 'country_code' , 'region_code' , 'city' , 'latitude', 'longitute'];
}
