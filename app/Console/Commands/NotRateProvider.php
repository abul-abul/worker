<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Contracts\TaskInterface;
use App\Contracts\TaskProviderInterface;
use App\Contracts\MailInterface;

class NotRateProvider extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rateprovider';

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
        $all_task = $taskRepo->getSeekerNotRate();
        $param = [
            'decks' => [],
        ];
        $email_array = [];
        if(count($all_task) != 0){
            foreach ($all_task as $key => $seeker_email) {
               array_push($param['decks'],$seeker_email);
               if(!in_array($seeker_email->user->email,$email_array)){
                    array_push($email_array, $seeker_email->user->email);
               }
            }
            
        }
        foreach ($email_array as $key => $email) {
            $mailRepo->sendMessageNotRateProvider($param,$email);
        }
    }

}
