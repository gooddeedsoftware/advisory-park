<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\{AdvisoryRequest,Notification,User};
use Auth;

class advisoryRequestNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:advisory_request {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notification to advisor while user send request to talk';

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
        $advisory_request = AdvisoryRequest::find($id);
        
        $user = User::find($advisory_request->user_id);

        if($advisory_request){
           
                $notification = new Notification;
                $notification->notification = ucfirst($user->name)." added a new advisory request."; 
                $notification->link = route('profile'); 
                $notification->entity_id = $advisory_request->advisor_id; 
                $notification->entity_type = 'advisor';
                $notification->activity_id = $advisory_request->id; 
                $notification->activity_type  = Notification::activity_advisory_request;  
                $notification->save();
        }
    }
}
