<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\CityInterface;
use App\Contracts\CountryInterface;
use App\Contracts\UserInterface;
use App\Contracts\MailInterface;
use App\Contracts\CategoryInterface;
use Validator;
use Auth;
use Input;
use Cookie;
use Twilio;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Session;

class UsersController extends BaseController
{

    /**
     * Object of CityInterface class
     *
     * @var cityRepo
     */
    private $cityRepo;

    /**
     * Object of CountryInterface class
     *
     * @var cityRepo
     */
    private $countryRepo;

    /**
     * Object of UserInterface class
     *
     * @var userRepo
     */
    private $userRepo;

    /**
     * Object of MailInterface class
     *
     * @var mailRepo
     */
    private $mailRepo;

    /**
     * Object of CategoryInterface class
     *
     * @var categoryRepo
     */
    private $categoryRepo;

    /** 
     * Create a new instance of BaseController class.
     *
     * @param CityInterface $cityRepo
     * @param CountryInterface $countryRepo
     * @param UserInterface $userRepo
     * @param MailInterface $mailRepo
     * @return void
     */
    public function __construct(CityInterface $cityRepo, CountryInterface $countryRepo, UserInterface $userRepo, MailInterface $mailRepo, CategoryInterface $categoryRepo)
    {
        $this->cityRepo = $cityRepo;    
        $this->countryRepo = $countryRepo;
        $this->userRepo  = $userRepo;
        $this->mailRepo  = $mailRepo;
        $this->categoryRepo = $categoryRepo;
        $this->middleware( 'auth', ['except' => [
                                                'getLogin', 
                                                'postLogin', 
                                                'getDashboard',
                                                'getRegistration', 
                                                'postRegistration', 
                                                'activeProfile',
                                                'getCity',
                                                'getForgotPassword',
                                                'postForgotPassword',
                                                'getSetNewPassword',
                                                'postSetNewPassword',
                                                'getNewTaskCategory',
                                                'postAjaxAddPhoto',
                                                'getCity',
                                                'postRegistrationValidation',
                                                'getJobSuccess',
                                                'postImageCrop',
                                                'getSignUpSuccess',
                                                'getAboutUs',
                                                'getHowRedirect'
                                    ]]);
    }

    /**
     * Website dashboard page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDashboard()
    {
        $categories = $this->categoryRepo->getAll()->all();
        if (Auth::check())
        {
            if(Auth::user()->role == 'provider') {
                return redirect()->action('ProvidersController@getProfile');
            }else if (Auth::user()->role == 'seeker') {
                return redirect()->action('SeekersController@getProfile');
            }
        }  
        $data = [
            'categories' => $categories,
            'reg' => true,
            'howTo' => true
        ];
        return view('dashboard', $data);
    }

    /**
     * redirect Website dashboard page(how to work tab).
     *
     * @return \Illuminate\Http\Response
     */
    public function getHowRedirect(){
        return redirect()->action('UsersController@getDashboard')->with('howTo', 'true');
    }

    /**
     * Users login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        if (Auth::check())
        {
            if(Auth::user()->role == 'provider') {
                return redirect()->action('ProvidersController@getProfile');
            }else if (Auth::user()->role == 'seeker') {
                return redirect()->action('SeekersController@getProfile');
            } else if (Auth::user()->role == 'admin') {
                return redirect()->action('AdminController@usersPageShow');
            }
        }
        $data = [
            'reg' =>true
        ];
        return view('login.login',$data);
    }

    /**
     * Users login function.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $remember = $request->input('remember_me');
    	$email = $request->get('email');
        $password = $request->get('password');
        if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => true],$remember)) {
            if (Auth::user()->role == 'provider'){
                return redirect()->action('ProvidersController@getProfile');
            } else if (Auth::user()->role == 'seeker') {
                return redirect()->action('SeekersController@getProfile');
            } else if (Auth::user()->role == 'admin') {
                return redirect()->action('AdminController@usersPageShow');
            }
        } else {
            return redirect()->back()->with('error','Error username and password');
        }
    }

    /**
     * Logout .
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
    	Auth::logout();
		return redirect()->action('UsersController@getDashboard');
    }

    /**
     * Users registration page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegistration($tab=null)
    {   

        $countries = $this->countryRepo->getAll();
        $categoryArr = $this->categoryRepo->getAll();
        $arrCategoryName = [];
        $arrCategoryName[''] = 'Selected category';
        foreach ($categoryArr as $category) {
           $arrCategoryName[$category->id] = $category->name;
        }
        //$freecategory = array_diff($arrCategoryName, $selectedCategory );
        $arrCountryName = [];
        $arrCountryName[''] = 'Select your country*';
        foreach ($countries as $country) {
           $arrCountryName[$country->code] = $country->name;
        }
        $arrRole = [
            'seeker' => 'Seeker',
            'provider' => 'Provider',
        ];
        $arrData = [
            'coutries' => $arrCountryName,
            'role'     => $arrRole,
            'reg' => true,
            'categories' => $arrCategoryName,
            'tab' => $tab
        ];
     
        return view('registration.registration', $arrData);
    }

    /**
     * Users create function validation.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function postRegistrationValidation(Request $request)
    {
        $data = $request->all();
        if($data['role'] == 'seeker'){
            $validator = Validator::make($data, [
                'username' => 'required',
                'email' => 'email|unique:users',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
                'phone' => 'required',
                'zip_code' => 'required',
                'country' => 'required',
                'city' => 'required',
                'role' => 'required',
            ]);
        }else{
            $validator = Validator::make($data, [
                'username' => 'required',
                'email' => 'email|unique:users',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
                'phone' => 'required',
                'zip_code' => 'required',
                'country' => 'required',
                'city' => 'required',
                'role' => 'required',
                'company' => 'required',
            ]);
        }
        if ($validator->fails()) {
            $errors = $validator->messages();
            return response()->json(['errors'=>$errors]);
        }else{
            $data['phone'] = $request->get('phone_prefix').$request->get('phone');
            try {
                Twilio::message($data['phone'], "Welcome to Mr Shasha Thank you for registration. Please check your email and activate your account.");
            } catch (\Services_Twilio_RestException $e ) {
                return response()->json(['error_danger'=>'Mobile Number is not vaild']);
            }
            return response()->json(['error_reg'=>'true']);
        }
    }

    /**
     * Users create function.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function postRegistration(Request $request)
    {
        $data = $request->all();
        if($data['role'] == 'seeker'){
            $validator = Validator::make($data, [
                'username' => 'required',
                'email' => 'email|unique:users',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
                'phone' => 'required',
                'zip_code' => 'required',
                'country' => 'required',
                'city' => 'required',
                'role' => 'required',
            ]);
        }else{
            $validator = Validator::make($data, [
                'username' => 'required',
                'email' => 'email|unique:users',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
                'phone' => 'required',
                'zip_code' => 'required',
                'country' => 'required',
                'city' => 'required',
                'role' => 'required',
                'company' => 'required',
            ]);
        }
        if ($validator->fails()) {
            $errors = $validator->messages();
            return redirect()->back()->withErrors($errors);
        }else{
            unset($data['password_confirmation']);
            $token = str_random(15);
            // $data['active'] = $token;
            $data['active'] = 1;
            $data['password'] = bcrypt($request->get('password'));
            $countryName = $this->countryRepo->getCountryFullName($request->get('country'))->name;
            $data['country'] = $countryName;
            $data['phone'] = $request->get('phone_prefix').$request->get('phone');
            $dataEmail = [
                'email' => $request->get('email'),
                'token' => $token,
                'password' => $request->get('password')
            ];
            try {
                Twilio::message($data['phone'], "Welcome to Mr Shasha Thank you for registration. Please check your email and activate your account.");
            } catch (\Services_Twilio_RestException $e ) {
                return redirect()->back()->with('error_danger', 'Mobile Number is not vaild');
            }
            $sendEmail = $this->mailRepo->send($dataEmail, $request->get('email'), $data['phone']);
            $createOne = $this->userRepo->createOne($data);
            if(isset($request['categoryData']) && count($request['categoryData']) != ''){
                $dataCategory = explode(',', $request['categoryData']);
                foreach ($dataCategory as $category){
                    $createOne->categories()->attach($category);
                }
            }
            if(isset($data['job_success'])){
                return redirect()->action('UsersController@getJobSuccess');
            }
            return redirect()->action('UsersController@getSignUpSuccess');
        }
    }

    /**
     * Sign Up success.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getSignUpSuccess()
    {
        return view('registra tion.signup_success');
    }

    /**
     * Abount Us page.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAboutUs()
    {
        return view('aboutUs.about_us');
    }

    /**
     * Forgot Password page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getForgotPassword()
    {
        return view('password.forgot-password');
    }

    /**
     * Send to mail response.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function postForgotPassword(Request $request)
    {
        $email = $request->get('email');
        $hash = str_random(15);
        $data = [
            'hash' => $hash,
        ];
        $emailSend = $this->mailRepo->forgotPassHash($data, $email);
        $createHash = $this->userRepo->createHash($email,$hash);
        if ($createHash) {
            // Send the reset password email
            $message = 'E-mail was sent';

            return redirect()->action('UsersController@getForgotPassword')->with('message', $message);
        } else {
            $message = 'You are not registered !';
            return redirect()->action('UsersController@getForgotPassword')->with('message_err', $message);
        }
    }

    /**
     * set new password page.
     *
     * @param string $hash
     * @return \Illuminate\Http\Response
     */
    public function getSetNewPassword($hash)
    {
        $data = [
            'hash' => $hash,
        ];
        return view('password.set-new-password', $data);
    }

    /**
     * set new password.
     *
     * @param string $hash
     * @return \Illuminate\Http\Response
     */
    public function postSetNewPassword(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages();
            return redirect()->back()->withErrors($errors);
        } else {
            $password = bcrypt($request->get('password'));
            $getHash = $this->userRepo->getHash($request->get('hash'));
            if ($getHash) {
                $updateHash = $this->userRepo->updateHash($request->get('hash'), $password);
                return redirect()->action('UsersController@getLogin');
            }
        }
    }

    /**
     * Active user profile.
     *
     * @param string $token
     * @return \Illuminate\Http\Response
     */
    public function activeProfile($token)
    {
        $active = $this->userRepo->getActive($token);
        if ($active) {
            $updateActive = $this->userRepo->updateActive($token);
            return redirect()->action('UsersController@getLogin');
        } else {
            return redirect()->action('UsersController@getLogin');
        };
    }

    /**
     * Get cities by Country code.
     *
     * @param string $city
     * @return \Illuminate\Http\Response
     */
    public function getCity($city)
    {
        $shorCode  = $this->countryRepo->getCountryFullName($city)->phonenumber_prefix;
        $CountryCities = $this->cityRepo->getCountryCities($city);
        $arrCityName = [];
        foreach ($CountryCities as $city) {
            $arrCityName[] =  $city->city;
        }
        $data = [
            'shortcode' => $shorCode,
            'arrCity' => $arrCityName,           
        ];
        return response()->json($data);
    }

   /**
    * Upload photo
    * POST user/ajax-upload
    *
    * @param Request $request
    * @return response()
     */
    public function postAjaxAddPhoto(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'file' => 'max:8192',
        ]);
        if ($validator->fails()){
            $errors = $validator->messages();
            return response()->json(['errors'=>$errors]);
        }else{
            $logoFile = $request->file('file')->getClientOriginalExtension();
            $name = str_random(12);
            $path = public_path() . '/assets/uploads/';
            $result = $request->file('file')->move($path, $name.'.'.$logoFile);
            $data = [
                'name' => $name.'.'.$logoFile,
            ];
            return response()->json($data);
        }
    }

    public function postImageCrop(Request $request)
    {
        $data = $request->all();
        $imag_data = json_decode($data['crop'],true);
        $path = public_path().'/assets/uploads/'.$data['name'];
        $name = str_random();
        $format = explode('.', $data['name']);
        $format = end($format);
        $newPath = public_path().'/assets/uploads/'.$name.'.'.$format;
        $img = Image::make($path);

        $width = round($imag_data['width']);
        $height = round($imag_data['height']);
        $x = round($imag_data['x']);
        $y = round($imag_data['y']);
        $img->crop($width, $height, $x, $y);
        $img->save($newPath);
        File::delete($path);
        $data = [
            'name' => $name.'.'.$format,
        ];
        return response()->json($data);
    }

    /** 
     * new job page
     *
     * @return view
     */
    public function getJobSuccess()
    {
        $data = [
            'reg' => true,
        ];
        return view('user-seekers.job-success',$data);
    }

}
