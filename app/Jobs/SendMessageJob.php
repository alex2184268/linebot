<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Collection;

class SendMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    protected $bot;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($chunk_users,$bot,$msg)
    {
        
        $this->message = $msg;//要傳送的訊息
        $this->bot = $bot;
        $this->user = $chunk_users;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->user;
        $collection = $user->each( function($item, $key){
            $this->bot->multicast($user, $this->msg);
        });
    }
}
