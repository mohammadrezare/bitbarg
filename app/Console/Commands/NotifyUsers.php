<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Message;
use Carbon\Carbon;
use App\Jobs\SendMailJob;
use App\User;
use App\Mail\NewArrivals;

class NotifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify users';

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
     * @return int
     */
    public function handle()
    {
        $now = date("Y-m-d H:i", strtotime(Carbon::now()->minutes(30)));
        logger($now);
        $tasks = Task::where('status', 'pending')->get();
        if ($tasks !== null) {
            $tasks->where('datetime', $now)->each(function ($task) {
                dispatch(new SendMailJob(
                    $task->user->email,
                    new NewArrivals($task->user, $task)
                ));
                Task::whereId($task->id)->update(['status' => 'done']);
            });
        }
    }
}
