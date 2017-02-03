<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\UserInterface;
use App\Contracts\CountryInterface;
use App\Contracts\CityInterface;
use App\Contracts\TaskInterface;
use App\Contracts\MailInterface;
use App\Contracts\CategoryInterface;
use App\Contracts\QuestionInterface;
use App\Contracts\AnswerInterface; 
use App\Contracts\TaskProviderInterface; 
use Validator;
use Auth;
use File;
use Twilio;
use Carbon\Carbon;

class SeekersController extends BaseController
{

    /**
     * Object of UserInterface class
     *
     * @var userRepo
     */
    private $userRepo;

    /**
     * Object of TaskInterface class
     *
     * @var userRepo
     */
    private $taskRepo;

    /**
     * Object of CityInterface class
     *
     * @var cityRepo
     */
    private $cityRepo;

    /**
     * Object of CountryInterface class
     *
     * @var countryRepo
     */
    private $countryRepo;

    /**
     * Object of CategoryInterface class
     *
     * @var countryRepo
     */
    private $categoryRepo;

    /**
     * Object of QuestionInterface class
     *
     * @var countryRepo
     */
    private $questionRepo;

    /**
     * Object of AnswerInterface class
     *
     * @var countryRepo
     */
    private $answerRepo;

    /** 
     * Create a new instance of BaseController class.
     *
     * @param CityInterface $cityRepo
     * @param CountryInterface $countryRepo
     * @param UserInterface $userRepo
     * @return void
     */
    public function __construct(CityInterface $cityRepo, 
                                CountryInterface $countryRepo,
                                UserInterface $userRepo,
                                TaskInterface $taskRepo,
                                CategoryInterface $categoryRepo,
                                QuestionInterface $questionRepo,
                                AnswerInterface  $answerRepo,
                                MailInterface $mailRepo)
    {
        $this->userRepo  = $userRepo;
        $this->taskRepo  = $taskRepo;
        $this->cityRepo  = $cityRepo;
        $this->countryRepo = $countryRepo;
        $this->categoryRepo = $categoryRepo;
        $this->questionRepo = $questionRepo;
        $this->answerRepo = $answerRepo;
        $this->mailRepo = $mailRepo;
        $this->middleware( 'auth', ['except' => [
                                                'getLogin',
                                                'postLogin',
                                                'getDashboard',
                                                'getRegistration',
                                                'postRegistration',
                                                'activeProfile',
                                                'getCity',
                                                'getNewTask',
                                                'postNewTask',
                                                'getNewTaskCategory',
                                                'postLoginToTask',
                                                'getTaskCity',
                                                'postAjaxAddPhoto',
                                                'postTaskValidation'
                                            ]]);
    }




    /**
     * Get Seeker profile page.
     *
     * @return array $data
     */
    public function getProfile()
    {   
        $authUser = Auth::user();

        $data = [
            'authUser' => $authUser,
            'reg' =>true
        ];
        return view('user-seekers.my-profile', $data);
    }

    /**
     * Add new task page
     *
     * @return \Illuminate\Http\Response
     */    
    public function getNewTask($id=null)
    {
        
        // get  all countries
        $countries = $this->countryRepo->getAll();
        $arrCountryName = [];
        $arrCountryName[''] = 'Select Country*';
        foreach ($countries as $country) {
           $arrCountryName[$country->code] = $country->name;
        }

        // get  all categories
        $categories = $this->categoryRepo->getAll();
        $arrCategoryName = [];
        foreach ($categories as $category) {
           $arrCategoryName[$category->id] = $category->name;
        }
       
        if (!$id) {
            $city = $this->cityRepo->getCityLatLong(Auth::user()->city);
            $latitude = $city->latitude;
            $longitude = $city->longitude;

            $arrData['latitude'] = $latitude;
            $arrData = [
                'countries' => $arrCountryName,
                'categories' => $arrCategoryName,
                'longitude' => $longitude,
                'latitude' => $latitude
            ];
        } else {
            
            $name = $arrCategoryName[$id];
            unset($arrCategoryName[$id]);
            $x =  [$id => $name] + $arrCategoryName;
            $longitude = '55.3075';
            $latitude = '25.2711';

            $arrRole = [
                'seeker' => 'Seeker',
                'provider' => 'Provider',
            ];

            $arrData = [
                'countries' => $arrCountryName,
                'categories' => $x,
                'longitude' => $longitude,
                'latitude' => $latitude,
                'category_id' => $id,
                'role'     => $arrRole
            ];
        }
        return view('user-seekers.new-task', $arrData);
    }

    /**
     * validation new task
     *
     * @param Request $requests
     * @return \Illuminate\Http\Response
     */
    public function postTaskValidation(Request $request)
    {
        $arrData = $request->all();
        
        if(Auth::check()){
            $error_user='false';
        }else{
            $error_user='true';
        }
        $validator = Validator::make($arrData, [
                'category' => 'required',
                'questions_content' => 'required',
                'choose_date' => 'required',
                'description' => 'required',
                'location'  => 'required',
        ]);

        
        if ($validator->fails()){
            $errors = $validator->messages();
            return response()->json(['errors'=>$errors]);
        }else{
            $x = strtotime($arrData['choose_date']);
            $newformat = date('Y-m-d',$x);
            if($newformat == Carbon::now()->toDateString()){
                return response()->json(['modal' => true]);
            }
            return response()->json(['error_user' => $error_user]);
        }
    }

    /**
     * Create new task
     *
     * @param Request $requests
     * @return \Illuminate\Http\Response
     */
    public function postNewTask(Request $request, TaskInterface $taskRepo, CategoryInterface $categoryRepo)
    {
        $arrData = $request->all();
        $validator = Validator::make($arrData, [
                'category' => 'required',
                'questions_content' => 'required',
                'choose_date' => 'required',
                'description' => 'required',
                'location'  => 'required',
        ]);

        if ($validator->fails()) {

            $errors = $validator->messages();
            return redirect()->back()->with($errors);

        }else{
            // $name = str_random();
            // $path = public_path() . '/assets/picture/';
            // if ($request->file('photo')) {
            //      $logoFile = $request->file('photo')->getClientOriginalExtension();
            //      $result = $request->file('photo')->move($path, $name.'.'.$logoFile);
            //  } else {
            //     $logoFile = null;
            //  }

            // $tasks = $this->taskRepo->getAlltaskByUserId(Auth::user()->id);
            // dd($tasks);
            // foreach ($tasks as $task){
                // dd($task->created_at->toDateString());
                // dd(Carbon::now()->toDateString());
            $x = strtotime($arrData['choose_date']);
            $newformat = date('Y-m-d',$x);
            
                if($newformat == Carbon::now()->toDateString()){
                    return redirect()->back()->with('modal','show');
                }
            // }            
            $country = substr(strrchr($arrData['location'], "-"), 2);
            
            $data = [
                'user_id' => Auth::user()->id,
                'description' => $arrData['description'],
                'category_id' => $arrData['category'],
                'location' => $arrData['location'],
                'choose_date' => $arrData['choose_date'],
                //'category_img' => $name.'.'.$logoFile,
                'category_img' => $arrData['photo1'],
                'country' => $country
            ];
            

            $task = $taskRepo->createTask($data);
 

            $dataQuestions = json_decode($arrData['questions_content']);

            foreach ($dataQuestions as $question){
                foreach ($question->answer as $answer){
                    $result = $task->questions()->attach($question->question,['answer'=>$answer]);
                }
            }

            $category = $categoryRepo->getOne($arrData['category']);
       
            $users = $category->users()->get();
            $emails = [];

            foreach ($users as $user){
                array_push($emails,$user->email);
                Twilio::message($user->phone, "Please go to Mr Shasha. A new job has been posted that might be interested in.");
            }

            $data = [
                'task_id' => $task->id,
                'category_name' => $category->name,
            ];
            $this->mailRepo->sendTaskToProviders($data, $emails);

            // send email to poster
            $data = [];
            $user = Auth::user();
            $data['username'] = $user->username;
            $data['category'] = $category->name;
            $this->mailRepo->sendToPosterAfterPosting($data, $user->email);
        }

        //  $arrData = [
        //     'taskData' => $taskData,
        //     'categoryName' => $categoryName->name,
        //     'userName'   => $userName,
        //     'reg' => true,
        //     'pageName' => 'pending'
        // ];

        $param = [
            'addNewTask'=>'addNewTask',
        ];
        return view('user-seekers.success-task',$param);
    }

    /** 
     * Get add new task page
     *
     * @param integer $categoryId
     * @return response
     */
    public function getNewTaskCategory($categoryId)
    {
        $categoryQuestions = $this->questionRepo->getAll($categoryId);
        return response()->json($categoryQuestions);
    }

    /**
     * Get seekers created tasks page
     *
     * @return \Illuminate\Http\Response
     */ 
    // public function getMyTasks(Request $request)
    // {
    //     $seekerId = Auth::user()->id;
    //     $getSeekerTasks = $this->taskRepo->getSeekerTask($seekerId);
    //     $getSeekerTasks = json_decode(json_encode($getSeekerTasks), true);
    //     $count = count($getSeekerTasks);
    //     $pageCount = (int)round($count/2);
    //     if($request->get('page')==null){
    //         $page=1;
    //     }else{
    //         $page = $request->get('page');
    //     }
    //     $curent_page = (int)$page;
    //     if($curent_page ==0){
    //         $getSeekerTasks = array_slice($getSeekerTasks,0,2);
    //     }else{
    //         $getSeekerTasks = array_slice($getSeekerTasks,$curent_page*2-2,2);
    //     }
    //     $nextPage=$curent_page+1;
    //     $prevPage = $curent_page-1;
    //     if($prevPage<1){
    //         $prevPage = null;
    //     }
    //     if($nextPage > $pageCount){
    //         $nextPage = null;
    //     }

    //     $arrData = [
    //         'tasks' => $getSeekerTasks,
    //         'nextPage' => $nextPage,
    //         'prevPage' => $prevPage,
    //         'pageCount' => $pageCount,
    //         'curent_page' => $curent_page,
    //         'pageName' => 'my-tasks',
    //     ];
        
    //     return view('user-providers.my-requests', $arrData);
    // }
    public function getMyTasks(Request $request)
    {
        $seekerId = Auth::user()->id;
        $getSeekerTasks = $this->taskRepo->getSeekerTask($seekerId);

        $getSeekerTasks = json_decode(json_encode($getSeekerTasks), true);

        $count = count($getSeekerTasks);

        $pageCount = (int)ceil($count/10);


        if($request->get('page')==null){
            $page=1;
        }else{
            $page = $request->get('page');
        }
        $curent_page = (int)$page;

        if($curent_page == 0){
            $getSeekerTasks = array_slice($getSeekerTasks,0,10);
        }else{
            $getSeekerTasks = array_slice($getSeekerTasks,$curent_page*10-10,10);

        }
        $nextPage = $curent_page+1;
        $prevPage = $curent_page-1;
        if($prevPage<1){
            $prevPage = null;
        }
        if($nextPage > $pageCount){
            $nextPage = null;
        }

        $arrData = [
            'tasks' => $getSeekerTasks,
            'nextPage' => $nextPage,
            'prevPage' => $prevPage,
            'pageCount' => $pageCount,
            'curent_page' => $curent_page,
            'pageName' => 'my-tasks',
        ];
        
        return view('user-providers.my-requests', $arrData);
    }

    /**
     * 
     */
    public function getCompletedTask(Request $request)
    {
        $seekerId = Auth::user()->id;
        $getSeekerTasks = $this->taskRepo->getSeekerTaskPassive($seekerId);
        $getSeekerTasks = json_decode(json_encode($getSeekerTasks), true);
        $count = count($getSeekerTasks);
        $pageCount = (int)ceil($count/10);
        if($request->get('page')==null){
            $page=1;
        }else{
            $page = $request->get('page');
        }
        $curent_page = (int)$page;
        if($curent_page ==0){
            $getSeekerTasks = array_slice($getSeekerTasks,0,10);
        }else{
            $getSeekerTasks = array_slice($getSeekerTasks,$curent_page*10-10,10);
        }
        $nextPage=$curent_page+1;
        $prevPage = $curent_page-1;
        if($prevPage<1){
            $prevPage = null;
        }
        if($nextPage > $pageCount){
            $nextPage = null;
        }

        $arrData = [
            'tasks' => $getSeekerTasks,
            'nextPage' => $nextPage,
            'prevPage' => $prevPage,
            'pageCount' => $pageCount,
            'curent_page' => $curent_page,
            'pageName' => 'completed-tasks',
        ];
        
        return view('user-providers.my-requests', $arrData);
    }

    /**
     * Get cities by Country code.
     *
     * @param string $city
     * @return json $arrCityName
     */
    public function getTaskCity($city)
    {
        $CountryCities = $this->cityRepo->getCountryCities($city);
        $arrCityName = [];
        foreach ($CountryCities as $city) {
            $arrCityName[] =  $city->city;
        }
        return response()->json($arrCityName);
    }

    /**
     * Get seeker created task by taskId.
     *
     * @param integer $taskId
     * @return array $arrData
     */
    public function getSeekerJob($taskId)
    {
        $taskData = $this->taskRepo->getOneTask($taskId);
        if($taskData->status == 'passive'){
            return redirect()->action('SeekersController@getMyTasks');
        }
        $questions = $taskData->questions;
        $category = $taskData->category;
        $providerResponds = $taskData->taskUser()->get();
        $taskProviders = $taskData->providers()->get();
        foreach ($providerResponds as $key => $providerRespond){
            $status = false;
            foreach ($taskProviders as $taskProvider){
                if($providerRespond->id == $taskProvider->id){
                    $status = true;
                }
            }
            if($status == true){
                unset($providerResponds[$key]);
            }
        }
        $arrData = [
            'taskData' => $taskData,
            'taskProviders' => $taskProviders,
            'category' => $category,
            'questions' => $questions,
            'providers' => $providerResponds,
            'reg' => true,
            'count' => count($taskProviders),
            'pageName' => 'recommended',
        ];
        //dd($arrData);
        return view('user-providers.task-detail', $arrData);
    }

    /**
     * Get seeker created task by taskId.
     *
     * @param integer $taskId
     * @return array $arrData
     */
    public function getSeekerJobCompleted($taskId)
    {
        $taskData = $this->taskRepo->getOneTask($taskId);
        $questions = $taskData->questions;
        $category = $taskData->category;
        $providerResponds = $taskData->taskUser()->get();

        $taskProviders = $taskData->providers()->get();
        foreach ($providerResponds as $key => $providerRespond){
            $status = false;
            foreach ($taskProviders as $taskProvider){
                if($providerRespond->id == $taskProvider->id){
                    $status = true;
                }
            }
            if($status == true){
                unset($providerResponds[$key]);
            }
        }
        $arrData = [
            'taskData' => $taskData,
            'taskProviders' => $taskProviders,
            'category' => $category,
            'questions' => $questions,
            'providers' => $providerResponds,
            'reg' => true,
            'count' => count($taskProviders),
            'pageName' => 'completed', 
        ];
        //dd($arrData);
        return view('user-providers.task-detail', $arrData);
    }


    /**
     * Get remove task.
     *
     * @param integer $id
     * @return response
     */
    public function getRemoveTask($id)
    {
        $task = $this->taskRepo->getOneTask($id);
        foreach ($task->questions as $question){
            $task->questions()->detach($question->id);
        }
        $taskProviders = $task->providers()->get();
        foreach ($taskProviders as $taskProvider){
            $task->providers()->detach($taskProvider->id);
        }
        $taskUsers = $task->taskUser()->get();
        foreach ($taskUsers as $taskUser){
            $task->taskUser()->detach($taskUser->id);
        }
        $result = $this->taskRepo->remove($id);
        $data = [
            'remove' => 'remove',
        ];
        return view('user-seekers.success-task',$data);
    }

    /** 
     * Post provider respond
     *
     * @param Request $request
     * @return response
     */
    public function postProviderRespondDetail(Request $request)
    {
        $taskId = $request->get('task_id');
        $providerId = $request->get('user_id');
        $providerData = $this->userRepo->getOne($providerId);
        return response()->json($providerData);
    }

    /** 
     * Post rate provider
     *
     * @param Request $request
     * @return response
     */
    public function postRateProvider(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vole' => 'required',
            'vole1' => 'required',
            'vole2' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back();   
        }
        $task_id = $request->get('task_id');

        $vole = $request->get('vole');
        $vole1 = $request->get('vole1');
        $vole2 = $request->get('vole2');
        $providerId = $request->get('provider_id');

        $provider = $this->userRepo->getOne($providerId);

        $data = [
            'user_id' => Auth::user()->id,
            'provider_id' => $providerId,
            'vole' => $vole,
            'vole1' => $vole1,
            'vole2' => $vole2
        ];

        $param =[
            'result_rate' => $provider->rate,
            'service_rate' => $vole,
            'value_for_money' => $vole1,
            'timeliness_of_service' => $vole2,
        ];

        $user = $this->userRepo->getOne($providerId);

        $rate = $this->userRepo->rateSystem($data);

        $task = $this->taskRepo->getOneTask($task_id);

        $user->userTask()->detach($task_id);
        $user->userTask()->detach($task_id);
        $task->providers()->detach($provider->id);
        $task->providers()->attach($request->get('provider_id'),['description'=>$task->description,'money' => $request->get('provider_mony')]);
        $this->taskRepo->getUpdate($request->get('task_id'),['status' => 'passive']);

        $this->mailRepo->sendRateToProvider($param,$user->email);
        return redirect()->back();
    }

    /** 
     * login to add task
     *
     * @param Request $request
     * @return response
     */
    public function postLoginToTask(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $data = [
            'email' => $email,
            'password' => $password
        ];
        $validator = Validator::make($data, [
                'email'  => 'required|email', 
                'password' => 'required'
        ]);
        if($validator->fails()){
            $error = $validator->messages()->all();
            return response()->json($error[0]);
        } else {

            if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => true])) {
                if (Auth::user()->role == 'seeker') {
                    return response()->json(true);
                } else {
                    return response()->json('You not a seeker');
                }
            } else {
                return response()->json('Please Sign up');
             }
        }
    }

    /** 
     * choose provider for job
     *
     * @param integer $id
     * @return jsone
     */
    public function getChooseProvider($id)
    {
        $provider = $this->userRepo->getOne($id);
        $data = [
            'provider' => $provider,
        ];
        return response()->json($data);
    }

    /**
     * 
     */
    public function getAddProviderTask(Request $request)
    {
        $description = $request->get('description');
        $money = $request->get('money');
        $task = $this->taskRepo->getOneTask($request->get('task_id'));
        $provider_id = $request->get('provider_id');

        $taskProvider = $task->taskUser()->get();

        $user = $this->userRepo->getOne($provider_id);

        //$user->userTask()->detach($request->get('task_id'));
        // foreach ($taskProvider as $provider){
        //     //$task->providers()->detach($provider->id);
        // }
        $param = [

        ];
        
        //$task->providers()->attach($request->get('provider_id'),['description'=>$description,'money' => $money]);
        //$this->taskRepo->getUpdate($request->get('task_id'),['status' => 'passive']);

        $this->taskRepo->getUpdate($request->get('task_id'),['active_rate' => 'passive']);
        return response()->json(['sucess' => true]);
    }



}
