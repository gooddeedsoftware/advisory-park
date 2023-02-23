<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\{Post,Notification,User};
use Auth;
class SendPostNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:create_post {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notification while create post';

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
        $post = Post::find($id);   
        // dd($post);

        $user = User::getSkilledUser($post->skill);

        if($user){
            foreach($user as $u){

                $notification = new Notification;
                $notification->notification = ucfirst(Auth::user()->name)." added a new post."; 
                $notification->link = "post-details/".$post->slug; 
                $notification->entity_id = $u->id; 
                // $notification->entity_type = $u->type;
                $notification->entity_type = 'user';
                $notification->activity_id = $post->id; 
                $notification->activity_type  = Notification::activity_post;  
                $notification->save();
            }
        }

    }
}
