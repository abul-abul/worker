<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Contracts\TaskInterface;
use App\Contracts\TaskProviderInterface;
use App\Contracts\MailInterface;

class NotSelectedProvider extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seeker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(TaskInterface $taskRepo,TaskProviderInterface $taskProviderRepo,MailInterface $mailRepo)
    {
        $all_task = $taskRepo->getAllInUser();
        $task_providers = $taskProviderRepo->getAll();
        $task_provider_arr = [];        
        foreach ($task_providers as $key => $task_provider) {
            array_push($task_provider_arr, $task_provider->task_id);
        }
        $email_array = [];
        $param = [
            'descs' => [],

        ];
        foreach ($all_task as $key => $task) {
            if(in_array($task->id,$task_provider_arr)){
                if(!in_array($task->user->email,$email_array)){
                    array_push($param['descs'],$task);
                    array_push($email_array, $task->user->email);
                }
            }
        }
        foreach ($email_array as $key => $email) {
            $mailRepo->sendMessageNotSelectedInJob($param,$email);
        }

    }

}
