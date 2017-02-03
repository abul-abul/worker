<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\CityInterface;
use App\Contracts\CountryInterface;
use App\Contracts\UserInterface;
use App\Contracts\MailInterface;
use App\Contracts\TaskInterface;
use App\Contracts\CategoryInterface;
use App\Http\Requests\Task\TaskAttachRequest;
use Validator;
use Auth;

class ProvidersController extends BaseController
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
     * Object of TaskInterface class
     *
     * @var taskRepo
     */
    private $taskRepo;

    /**
     * Object of CategoryInterface class
     *
     * @var taskRepo
     */
    private $categoryRepo;

    /** 
     * Create a new instance of BaseController class.
     *
     * @param CityInterface $cityRepo
     * @param CountryInterface $countryRepo
     * @param UserInterface $userRepo
     * @param MailInterface $mailRepo
     * @param TaskInterface $taskRepo
     * @return void
     */
    public function __construct(
                            CityInterface $cityRepo, 
                            CountryInterface $countryRepo, 
                            UserInterface $userRepo,
                            MailInterface $mailRepo,
                            TaskInterface $taskRepo,
                            CategoryInterface $categoryRepo)
    {
        $this->cityRepo = $cityRepo;    
        $this->countryRepo = $countryRepo;
        $this->userRepo  = $userRepo;
        $this->mailRepo  = $mailRepo;
        $this->taskRepo  = $taskRepo;
        $this->categoryRepo = $categoryRepo;
        $this->middleware( 'auth', ['except' => [
                                        'getLogin', 
                                        'postLogin',
                                        'getDashboard',
                                        'getRegistration',
                                        'postRegistration',
                                        'activeProfile',
                                        'getCity',
                                        'getNewTaskCategory',
                                        'postTaskDetalValidation',
                                        'getTaskDetail'
                                        ]]);
    }

    /**
     * Get user profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProfile()
    {   
        $authUser = Auth::user();
        $id = Auth::user()->id;
        $categories = $authUser->categories()->select('category_id')->get()->toArray();
        $countCategory = count($categories);
        $selectedCategory = [];
        foreach ($categories as $categorys) {
            $categoryName =  $this->categoryRepo->getCategoryName($categorys['category_id']);
            $selectedCategory[$categoryName->id] = $categoryName->name;
        }
        $categoryArr = $this->categoryRepo->getAll();
        $arrCategoryName = [];
        $arrCategoryName[''] = 'Select Category';
        foreach ($categoryArr as $category) {
           $arrCategoryName[$category->id] = $category->name;
        }
        $freecategory = array_diff($arrCategoryName, $selectedCategory );
        $data = [
            'authUser' => $authUser,
            'selectedCategory' => $selectedCategory,
            'categories'   => $freecategory,
            'reg' => true,
            'countCategory' => $countCategory

        ];
        return view('user-providers.my-profile', $data);
    }

    /**
     * Get my request page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMyRequests(Request $request)
    {

        $authUser = Auth::user();
        $id = Auth::user()->id;
        $country = Auth::user()->country;
        
        $countryCode = $this->countryRepo->getCountryCode($country)->code;
        $code = strtoupper($countryCode);
        $cities = $this->cityRepo->getCountryCities($code);

        $providerCats = $authUser->categories()->where('user_id', '=', $id)->get();

        if ($providerCats->all()) {
            $categoryId = [];
            foreach ($providerCats as $providerCat) {
                array_push($categoryId , $providerCat->id);
            };
            //dd($categoryId);
            $tasks = [];
            foreach ($categoryId as $key => $value) { 
                
                $task1 = $this->taskRepo->categoryTasks($value, $country)->all();
                array_push($tasks,$task1);
            }
            // dd($tasks);
            $categoryName =[];
            $taskUsers = [];
            foreach ($tasks as $task) {
                // dd($task);
                foreach ($task as $ta) {
                    
                       $name = $this->categoryRepo->getCategoryName($ta->category_id);
                       $userName = $this->userRepo->getOne($ta->user_id);
                       array_push($categoryName, $name);
                       array_push($taskUsers, $userName);
                }
               
            }

            $count = count($tasks);
            $pageCount = (int)round($count/2);
            if($request->get('page')==null){
                $page=1;
            }else{
                $page = $request->get('page');
            }
            $curent_page = (int)$page;
            if($curent_page ==0){
                $tasks = array_slice($tasks,0,2);
            }else{
                $tasks = array_slice($tasks,$curent_page*2-2,2);
            }
            $nextPage=$curent_page+1;
            $prevPage = $curent_page-1;
            if($prevPage<1){
                $prevPage = null;
            }
            if($nextPage > $pageCount){
                $nextPage = null;
            }
            
            $data = [
                'tasks' => $tasks,
                'categoryNames' => $categoryName,
                'taskUsers' => $taskUsers,
                'count'  => 0,
                'categories' => $providerCats->all(),
                'cities' => $cities->all(),
                'nextPage' => $nextPage,
                'prevPage' => $prevPage,
                'pageCount' => $pageCount,
                'curent_page' => $curent_page,
                
            ];
            return view('user-providers.my-requests', $data);
        }else{
            return redirect()->back()->with('error','None Requests');
        }
    }

    /**
     * Get my pending tasks page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPendingTask(Request $request)
    {
        $authUser = Auth::user();
        $id = Auth::user()->id;
        $country = Auth::user()->country;
        $taskPending = Auth::user()->userTask()->get();
        
       
        $countryCode = $this->countryRepo->getCountryCode($country)->code;
        $code = strtoupper($countryCode);
        $cities = $this->cityRepo->getCountryCities($code);

        $providerCats = $authUser->categories()->where('user_id', '=', $id)->get();

        // if ($providerCats->all()) {
        //     $categoryId = [];
        //     foreach ($providerCats as $providerCat) {
        //         array_push($categoryId , $providerCat->id);
        //     };
            //dd($categoryId);
            // $tasks = [];
            // foreach ($categoryId as $key => $value) { 
                
            //     $task1 = $this->taskRepo->categoryTasks($value, $country)->all();
            //     array_push($tasks,$task1);
            // }
            // dd($tasks);
        $tasks = [];
        foreach ($taskPending->all() as $value) {
            $taskID = $value->pivot->task_id;
            $tasks[] =  $this->taskRepo->getOneTask($taskID);
        }
        // dd($tasks);
            $categoryName =[];
            $taskUsers = [];
            foreach ($tasks as $task) {
               
               $name = $this->categoryRepo->getCategoryName($task->category_id);
               $userName = $this->userRepo->getOne($task->user_id);
               array_push($categoryName, $name);
               array_push($taskUsers, $userName);
            }

            $count = count($tasks);
            $pageCount = (int)ceil($count/10);
            if($request->get('page')==null){
                $page=1;
            }else{
                $page = $request->get('page');
            }
            $curent_page = (int)$page;
            if($curent_page ==0){
                $tasks = array_slice($tasks,0,10);
            }else{
                $tasks = array_slice($tasks,$curent_page*10-10,10);
            }
            $nextPage=$curent_page+1;
            $prevPage = $curent_page-1;
            if($prevPage<1){
                $prevPage = null;
            }
            if($nextPage > $pageCount){
                $nextPage = null;
            }
            
            $data = [
                'tasks' => $tasks,
                'categoryNames' => $categoryName,
                'taskUsers' => $taskUsers,
                'count'  => 0,
                'categories' => $providerCats->all(),
                'cities' => $cities->all(),
                'nextPage' => $nextPage,
                'prevPage' => $prevPage,
                'pageCount' => $pageCount,
                'curent_page' => $curent_page,
                
            ];
            // dd($data);
            return view('user-providers.my-pending', $data);
    }

    public function getCompletedTask(Request $request)
    {
        $authUser = Auth::user();
        $id = Auth::user()->id;
        $country = Auth::user()->country;
        $taskPending = Auth::user()->providerTask()->get();
        
        $countryCode = $this->countryRepo->getCountryCode($country)->code;
        $code = strtoupper($countryCode);
        $cities = $this->cityRepo->getCountryCities($code);

        $providerCats = $authUser->categories()->where('user_id', '=', $id)->get();
        $tasks = [];
        foreach ($taskPending->all() as $value) {
            $taskID = $value->pivot->task_id;
            $tasks[] =  $this->taskRepo->getOneTask($taskID);
        }
            $categoryName =[];
            $taskUsers = [];
            foreach ($tasks as $task) {
               
               $name = $this->categoryRepo->getCategoryName($task->category_id);
               $userName = $this->userRepo->getOne($task->user_id);
               array_push($categoryName, $name);
               array_push($taskUsers, $userName);
            }

            $count = count($tasks);
            $pageCount = (int)ceil($count/10);
            if($request->get('page')==null){
                $page=1;
            }else{
                $page = $request->get('page');
            }
            $curent_page = (int)$page;
            if($curent_page ==0){
                $tasks = array_slice($tasks,0,2);
            }else{
                $tasks = array_slice($tasks,$curent_page*10-10,10);
            }
            $nextPage=$curent_page+1;
            $prevPage = $curent_page-1;
            if($prevPage<1){
                $prevPage = null;
            }
            if($nextPage > $pageCount){
                $nextPage = null;
            }
            
            $data = [
                'tasks' => $tasks,
                'categoryNames' => $categoryName,
                'taskUsers' => $taskUsers,
                'count'  => 0,
                'categories' => $providerCats->all(),
                'cities' => $cities->all(),
                'nextPage' => $nextPage,
                'prevPage' => $prevPage,
                'pageCount' => $pageCount,
                'curent_page' => $curent_page,
                
            ];
            // dd($data);
            return view('user-providers.completed', $data);
    }

    
    public function getFilterTasks(Request $request)
    {
        $authUser = Auth::user();
        $id = Auth::user()->id;
        $country = Auth::user()->country;        
        $countryCode = $this->countryRepo->getCountryCode($country)->code;
        $code = strtoupper($countryCode);
        $cities = $this->cityRepo->getCountryCities($code);
        

        // Search data
        $keyword  = $request->get('search');
        $category = $request->get('category');
        $city = $request->get('city');
        $sortBy = $request->get('sort_by');
        $dataSearch = [
            'description' => $keyword,
            'category_id' => $category,
            'location' => $city,
            'sort_by' => $sortBy
        ];
        $tasks = $this->taskRepo->search($dataSearch)->all();
        // dd($tasks);
        $providerCats = $authUser->categories()->where('user_id', '=', $id)->get();
        if ($providerCats->all()) {
            $categoryId = [];
            foreach ($providerCats as $providerCat) {
                array_push($categoryId , $providerCat->id);
            };
        }   

        // $tasks = [];
        // foreach ($categoryId as $key => $value) {             
        //     $task1 = $this->taskRepo->categoryTasks($value, $country)->all();
        //     array_push($tasks,$task1);
        // }

        $categoryName =[];
        $taskUsers = [];
        foreach ($tasks as $task){
               $name = $this->categoryRepo->getCategoryName($task->category_id);
               $userName = $this->userRepo->getOne($task->user_id);
               array_push($categoryName, $name);
               array_push($taskUsers, $userName);
        }
        $count = count($tasks);
        $pageCount = (int)ceil($count/10);
        $curent_page = (int)$request->get('page');
        //$tasks = array_slice($tasks,$curent_page-2,2);
        if($curent_page ==0){
            $tasks = array_slice($tasks,0,10);
        }else{
            $tasks = array_slice($tasks,$curent_page*10-10,10);
        }
        $nextPage=$curent_page+1;
        $prevPage = $curent_page-1;
        if($prevPage<1){
            $prevPage = null;
        }
        if($nextPage > $pageCount){
            $nextPage = null;
        }
        $data = [
            'tasks' => $tasks,
            'categoryNames' => $categoryName,
            'taskUsers' => $taskUsers,
            'search' => 'search',
            'count'  => 0,
            'categories' => $providerCats->all(),
            'cities' => $cities->all(),
            'reg' => true,
            'nextPage' => $nextPage,
            'prevPage' => $prevPage,
            'pageCount' => $pageCount,
            'curent_page' => $curent_page,
            
        ];
        //dd($data);
        return view('user-providers.my-requests', $data);
    }
    
    /**
     * Get Recomended Requests page. 
     *
     * @return \Illuminate\Http\Response
     */
    public function getRecomendedRequests()
    {
        $authUser = Auth::user();
        $id = Auth::user()->id;
        $providerCats = $authUser->categories()->where('user_id', '=', $id)->get();

        if ($providerCats->all()) {
            foreach ($providerCats as $providerCat) {
                $categoryId[] = $providerCat->id;
            };
       
            $TaskByCategory = $this->taskRepo->categoryTasks($categoryId);
            $countTasks = $TaskByCategory->count();
            $categoriesCounts = $TaskByCategory->groupBy('category_id')->all();

            if ($categoriesCounts){
                foreach ($categoriesCounts as $CategoryId => $categoriesCount) {
                    $name = $this->categoryRepo->getCategoryName($CategoryId);
                    $nameCategories[$name->name] = $categoriesCount;
                }
                
                $data = [
                    'tasksCount' => $countTasks,
                    'categories' => $nameCategories,
                    'categoryId' => $categoriesCounts,
                    'count'  => 0,
                ];

                return view('user-providers.my-requests', $data);

            }else {
                //dd('No task in your category');
            }
        } else {
            return view('user-providers.recomended-requests');
        }
        
    }

    /**
     * Get jobs by category name
     *
     * @param string $categoryName
     * @return array $data
     */
    public function getJobsByCategory($categoryName)
    {
        $categoryId = $this->categoryRepo->getCategoryId($categoryName)->id;
        $tasksById = $this->taskRepo->getTasksById($categoryId);
        $data = [
            'tasks' => $tasksById,
            'count'  => 0,
        ];   
        return view('user-providers.all-category-jobs', $data);  
    }

    /**
     * Post change profile
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function postChangeProfile(Request $request)
    {
        $dataProfile = $request->all();
        //dd($dataProfile);
        unset($dataProfile['_token']);
        unset($dataProfile['category']);
        if (isset($dataProfile['email'])) {
            unset($dataProfile['email']);
        };

        if ($dataProfile['photo1'] == ''){
            // $profileFile = $request->file('profile_img')->getClientOriginalExtension();
            // $name = str_random();
            // $path = public_path() . '/assets/picture/';
            // $result = $request->file('profile_img')->move($path, $name.'.'.$profileFile);
            //$dataProfile['profile_img'] = $name.'.'.$profileFile;
            unset($dataProfile['photo1']);
            unset($dataProfile['profile_img']);
        }else{
            $dataProfile['profile_img'] = $dataProfile['photo1'];
        }
        
        $id = Auth::user()->id;
        $changeProfile = $this->userRepo->changeProfile($id, $dataProfile);
        if ($changeProfile) {
            return redirect()->back();
        };
    }

    /**
     * Post add category
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function postAddCategory(Request $request)
    {
        $categories = $request->all();
        $category = $categories['category'];
        $user = Auth::user();
        $categories = $user->categories()->select('category_id')->get()->toArray();
        $countCategory = count($categories);
        if($countCategory <=5){
            $user->categories()->attach($category);
        }
    }

    /**
     * Get remove category
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function postRemoveCategory(Request $request)
    {
        $categories = $request->all();
        $category = $categories['category'];
        $user = Auth::user();
        $user->categories()->detach($category);
    }

    /**
     * Get all seekers page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTasks()
    {
        $allTasks = $this->taskRepo->getAll();
        $arrData = [
            'tasks' => $allTasks
        ];
        return view('user-providers.tasks', $arrData);
    }

    /**
     * Get task detail page
     *
     * @return \Illuminate\Http\Response
     */
    public function getTaskDetail($taskId)
    {
        if(!Auth::check()){
            return redirect()->action('UsersController@getLogin');
        }else{
            $taskData = $this->taskRepo->getOneTask($taskId);
            $categoryName = $this->categoryRepo->getCategoryName($taskData->category_id);
            $userName = $this->userRepo->getOne($taskData->user_id);
                
            $arrData = [
                'taskData' => $taskData,
                'categoryName' => $categoryName->name,
                'userName'   => $userName,
                'reg' => true,
                'pageName' => 'pending'
            ];
            return view('user-providers.task-detail', $arrData);
        }
       

    }

    /**
     * Get task detail copleted page
     *
     * @return \Illuminate\Http\Response
     */
    public function getTaskDetailCompleted($taskId)
    {
        $taskData = $this->taskRepo->getOneTask($taskId);
        if ($taskData == null) {
            return redirect()->back();
        }
        $categoryName = $this->categoryRepo->getCategoryName($taskData->category_id);

        $userName = $this->userRepo->getOne($taskData->user_id);
                
        $arrData = [
            'taskData' => $taskData,
            'categoryName' => $categoryName->name,
            'userName'   => $userName,
            'reg' => true,
            'pageName' => 'completed'
        ];
        return view('user-providers.task-detail', $arrData);
    }

    /**
     * Get save provider request
     *
     * @param integer $taskId
     * @return \Illuminate\Http\Response
     */
    public function getSaveRequest($taskId)
    {
        $user = Auth::user();
        $cretaFavorite = $user->favorites()->attach($taskId);
        return redirect()->action('ProvidersController@getMyRequests');
    }

    
    /**
     * Validation attach task detal
     *
     * @param Request $request
     * @return JSON
     */
    public function postTaskDetalValidation(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'description' => 'required',
            'money' => 'required|integer',
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages();
            return response()->json(['errors'=>$errors]);
        }else{
            return response()->json(['error_reg'=>'true']);
        }
    }

    /**
     * Post attach a task in the user.
     *
     * @param integer $taskId
     * @return \Illuminate\Http\Response
     */
    public function postAttachTask($taskId, TaskAttachRequest $request)
    {
        $description = $request->get('description');
        $money = $request->get('money');
        $user = Auth::user();

        $task =  $this->taskRepo->getOneTask($taskId);
        $seeker = $this->userRepo->getOne($task->user_id);


        $result = $user->userTask()->attach($taskId,['description'=>$description,'money' => $money]);

        $param = [
            'category_name' => $task['category']->name,
            'task_id' => $taskId
        ];
        $this->mailRepo->sendRequestProividerjob($param,$seeker->email);
        return redirect()->back();
    }

}
