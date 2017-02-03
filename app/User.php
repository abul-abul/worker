<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 
                            'username' , 
                            'email' , 
                            'password' ,
                            'phone',
                            'zip_code',
                            'country', 
                            'city', 
                            'active',
                            'first_name', 
                            'surname',
                            'location', 
                            'pin',
                            'company',
                            'website',
                            'description',
                            'role',
                            'profile_img',
                            ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the providers category.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category','provider_category');
    }

    /**
     * Get the providers save request.
     */
    public function favorites()
    {
        return $this->belongsToMany('App\Task','favorite_task')->with(['category','user']);
    }

    /**
     * Get the user Tasks.
     */
    public function userTask()
    {
        return $this->belongsToMany('App\Task','provider_responds','user_id','task_id','description','money')->withPivot('description','money');
    }

    /**
     * Get the user Tasks.
     */
    public function providerTask()
    {
        return $this->belongsToMany('App\Task','task_providers','provider_id','task_id','description','money')->withPivot('description','money');
    }
    
   
}
