<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'rate';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [ 'user_id' , 'provider_id' , 'vole','vole1','vole2'];
}
