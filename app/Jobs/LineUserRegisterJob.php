<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\School;
use App\District;
use App\Line;

class LineUserRegisterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $line;
    protected $UserData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    //建構子
    public function __construct($UserData)
    {
        $this->line = new Line;
        $this->UserData = $UserData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    //執行工作
    public function handle()
    {
        $UserData = $this->UserData;
        
        $this->user_id      = $UserData['userID'];
        $this->person_name  = $UserData['person_name'];
        $this->created_at = $UserData['created_at'];
        $this->school       = $UserData['school'];
        $this->phone        = $UserData['phone'];
    }
}
