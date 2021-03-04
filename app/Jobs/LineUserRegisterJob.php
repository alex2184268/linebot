<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


use App\Line;

class LineUserRegisterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $UserData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    //建構子
    public function __construct($UserData)
    {
        
        $this->UserData = $UserData;//User資料
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    //執行工作
    public function handle()
    {
        /**JOB 新增 redis queue */
        $UserData = $this->UserData;

        $line = new Line;
        
        $line->user_id      = $UserData['userID'];
        $line->person_name  = $UserData['person_name'];
        $line->created_at = $UserData['created_at'];
        $line->school       = $UserData['school'];
        $line->phone        = $UserData['phone'];

        $line->save();
    }
}
