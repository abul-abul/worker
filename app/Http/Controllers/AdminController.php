<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\MailInterface;
use App\Contracts\UserInterface;
use App\Contracts\TaskInterface;
use Auth;


class AdminController extends BaseController
{
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
     * Object of TaskInetrace class
     *
     * @var taskRepo
     */
    private $taskRepo;

    /** 
     * Create a new instance of BaseController class.
     *
     * @return void
     */
    public function __construct(UserInterface $userRepo, MailInterface $mailRepo, TaskInterface $taskRepo)
    {
        $this->userRepo  = $userRepo;
        $this->mailRepo  = $mailRepo;
        $this->taskRepo  = $taskRepo;
        $this->middleware("admin", ['except' => [
                                        'getLogin', 
                                        'postLogin'
                                    ]]);
    }

    /**
     * get admin login page
     *
     * @param Request $request
     * @return responses
     */
    public function getLogin()
    {
        return view('admin.admin_login');
    }

    /**
     * Check admin status.
     * POST admin/login
     *
     * @param Request $request
     * @return responses
     */
    public function postLogin(Request $request)
    {
        $email = $request->get('email');
        $pass = $request->get('password');
        if (Auth::attempt(['email' => $email, 'password' => $pass, 'role' => 'admin'])) {
            return redirect()->action("AdminController@getDashboard");
        } else {
            return redirect()->back();
        }
    }

    /**
     * get admin dashborad page
     *
     * @return responses
     */
    public function getDashboard()
    {
        $usersCount = $this->userRepo->getAllUsers()->count();
        $tasksCount = $this->taskRepo->getAll()->count();
        $data = [
            'userCount' => $usersCount,
            'taskCount' => $tasksCount
        ];
        return view('admin.home', $data);
    }

    /**
     * get users
     *
     * @return responses
     */
    public function getUsers()
    {
        $users = $this->userRepo->getAllUsers()->all();
        
        $data = [
            'users' => $users
        ];        
        return view('admin.users.users', $data);
    }

    /**
     * get edit user page
     *
     * @param int $id
     * @return responses
     */
    public function getEditUser($id)
    {
        $user = $this->userRepo->getOne($id);
        $data = [
            'user' => $user
        ];
        return view('admin.users.edit_user', $data);
    }

    /**
     *  edit user 
     *
     * @param Request $request
     * @return responses
     */
    public function postEditUser(Request $request)
    {
        
        $data = $request->all();
        $userId = $data['id'];
        unset($data['id']);
        unset($data['_token']);
        $this->userRepo->getUpdateUser($data, $userId);
        return redirect()->back()->with('success', "Update!");

    }

    /**
     *  eget Tasks
     *
     * 
     * @return responses
     */
    public function getTasks()
    {
        $tasks = $this->taskRepo->getTasksWithUser();
        $data = [
            'tasks' => $tasks
        ];
        return view('admin.tasks.tasks', $data);
    }

    /**
     * Task details
     *
     * 
     * @return responses
     */
    public function getTaskDetail($id)
    {
        $task = $this->taskRepo->getOneTask($id);
        $questions = $task->questions;
        $category = $task->category;
        $data = [
            'task' => $task,
            'category' => $category,
            'questions' => $questions,
        ];
        return view('admin.tasks.task_detail', $data);
    }   
    public function postEditTask()
    {

    }

    /**
     * Logout .
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect()->action('AdminController@getLogin');
    }

}