<?php 

namespace App\Http\Requests\Seekers;

use App\Http\Requests\Request;

class SeekersCreateRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'username' => 'required',
			'email' => 'email|unique:seekers',
			'password' => 'required|confirmed',
			'password-confirm' => 'required',
			'phone' => 'required',
			'zip_code' => 'required',
			'country' => 'required',
			'city' => 'required',
		];
	}
}
