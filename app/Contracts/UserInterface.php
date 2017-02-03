<?php 

namespace App\Contracts;

interface UserInterface
{
	/**
    * Create user 
    *
    * @param array  $dataArray
    * @return response
    */
	public function createOne($dataArray);

	/**
    * Get token by users active
    *
    * @param string $token
    * @return response
    */
	public function getActive($token);

	/**
    * Update token if user active
    *
    * @param string $token
    * @return response
    */
	public function updateActive($token);

	/**
    * Change user profile
    *
    * @param array $dataArray
    * @return response
    */
    public function changeProfile($id, $dataArray);

    /**
    * Get hash password reset
    *
    * @param string $hash
    * @return response
    */
    public function getHash($hash);

    /**
    * Update hash forgot password
    *
    * @param string $hash
    * @return response
    */
    public function updateHash($hash, $password);

    /**
    * Get user by Email
    *
    * @param string $email
    * @return response
    */
    public function createHash($email, $hash);

    /**
    * change password
    *
    * @param string $hash
    * @param string $password
    * @return response
    */
    public function changePass($hash, $password);

    /**
    * Get one user by userid
    *
    * @param integer $id
    * @return response
    */
    public function getOne($id);

    /**
    * Get one user by userid
    *
    * @param integer $id
    * @return response
    */
    public function addFavoriteTask();

    /**
    * Providers rating system
    *
    * @param array $data
    * @return response
    */
    public function rateSystem($data);
}
