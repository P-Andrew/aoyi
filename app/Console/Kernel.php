<?php

namespace App\Console;

use DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->call(function(){
            $nowTime = time();
            $creatOrderTime = DB::table('orders')->where('status',0)->get();
            $dealTime = DB::table('system')->first();
            foreach($creatOrderTime as $item){
                if(floor(($nowTime-strtotime($item->created_at))/60)>intval($dealTime->pay_left_time)){
                    DB::table('ground')->where('id', $item->ground_id)->update(['status'=>0]);
                    DB::table('orders')->where('id',$item->id)->update(['status'=>2]);
                }
            }
        })->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
