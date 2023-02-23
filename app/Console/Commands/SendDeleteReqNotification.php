<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\{Requirement,Notification,User};
use Auth;

class SendDeleteReqNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:delete_requirement {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notification while delete requirement';

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
        $id = $this->argument('id');
        if(!$id){
            echo "Id is required";
            return 0;
        }
        $requirement = Requirement::find($id);

        $user = User::getSkilledUser($requirement->skill);

        // dd($user);

        if($user){
            foreach($user as $u){

                $notification = new Notification;
                $notification->notification = ucfirst(Auth::user()->name)." deleted own requirement."; 
                $notification->link = "requirement-details/".$requirement->slug; 
                $notification->entity_id = $u->id; 
                // $notification->entity_type = $u->type;
                $notification->entity_type = 'advisor';
                $notification->activity_id = $requirement->id; 
                $notification->activity_type  = Notification::activity_requirement;  
                $notification->save();
            }
        }
    }
}
