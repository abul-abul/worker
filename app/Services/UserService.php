<?php 

namespace App\Services;
use App\Contracts\UserInterface;
use App\User;
use App\Rate;

class UserService implements UserInterface
{

	/**
	* Create a new instance of UserService class
	*
	* @return void
	*/
	public function __construct()
	{
		$this->user = new User();
        $this->rate = new Rate();
	}

    /**
    * get all users
    *
    * 
    * @return response
    */
    public function getAllUsers()
    {
        return $this->user->where('role', '!=', 'admin')->get();
    }

    /**
    * upadet user
    *
    * 
    * @param array $data
    * @param integer $id
    * @return response
    */
    public function getUpdateUser($data, $id)
    {
        return $this->user->where('id', '=', $id)->update($data);
    }

    /**
    * Create user 
    *
    * @param array $dataArray
    * @return response
    */
	public function createOne($dataArray)
	{
		return $this->user->create($dataArray);
	}

	/**
    * Get token by users active
    *
    * @param string $token
    * @return response
    */
    public function getActive($token)
    {
        return $this->user->where('active' , '=' , $token)->first();
    }

    /**
    * Update token if user active
    *
    * @param string $token
    * @return response
    */
    public function updateActive($token)
    {
        return $this->user->where('active' , '=' , $token)->update(['active' => true]);
    }

    /**
    * Change user profile
    *
    * @param array $dataArray
    * @return response
    */
    public function changeProfile($id, $dataArray)
    {
        return $this->user->find($id)->update($dataArray);
    }

    /**
    * Get hash password reset
    *
    * @param string $hash
    * @return response
    */
    public function getHash($hash)
    {
        return $this->user->where('hash' , '=' , $hash)->first();
    }

    /**
    * Update hash forgot password
    *
    * @param string $hash
    * @return response
    */
    public function updateHash($hash, $password)
    {
        return $this->user->where('hash' , '=' , $hash)->update(['hash' => null, 'password' => $password]);
    }

    /**
    * create user hash forgot password
    *
    * @param string $email
    * @param string $hash
    * @return response
    */
    public function createHash($email, $hash)
    {
        return $this->user->where('email' , '=' , $email)->update(['hash' => $hash]);
    }

    /**
    * change password
    *
    * @param string $hash
    * @param string $password
    * @return response
    */
    public function changePass($hash, $password)
    {
        return $this->user->where('hash' , '=' , $hash)->update(['password' => $password]);
    }

    /**
    * Get one user by userid
    *
    * @param integer $id
    * @return response
    */
    public function getOne($id)
    {
        return $this->user->find($id);
    }

    /**
    * Get one user by userid
    *
    * @param integer $id
    * @return response
    */
    public function addFavoriteTask()
    {
        return $this->user->favorites()->attach();
    }

    /**
    * Providers rating system
    *
    * @param array $id
    * @return response
    */
    public function rateSystem($data)
    {
        $x = $this->rate->where('user_id', '=', $data['user_id'])->where('provider_id', '=', $data['provider_id'])->first();
        if ($x) {
            $x->update($data);
            $allRating = $this->rate->where('provider_id', '=', $data['provider_id'])->get();
            $count = $allRating->count();
            $i = 0;

            foreach ($allRating as $vole) {
                $y = $vole->vole;
                $x = $vole->vole1;
                $z = $vole->vole2;
                $i += $y;
                $i += $x;
                $i += $z;
            }
            $j = round($i/3);
            $globalVote = $j/$count;
        
            $h = $this->user->where('id', '=', $data['provider_id'])->update(['rate' => $globalVote]);
        }else{
            $this->rate->create($data);
        }
    }

}