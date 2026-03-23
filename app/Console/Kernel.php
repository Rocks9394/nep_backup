<?php

namespace App\Console;

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

       /* $schedule->call(function () {
            \Log::info('Scheduler is working');
        })->everyMinute();*/
            
        // $schedule->command('inspire')->hourly();

        $schedule->command('reports:cleanup')
         ->dailyAt('01:00')
        ->withoutOverlapping(3600) 
        ->onOneServer()
        ->runInBackground()
        ->appendOutputTo(storage_path('logs/scheduler.log'));

        $schedule->command('delete:upload-history')
         ->dailyAt('14:32')
        ->withoutOverlapping(3600) 
        ->onOneServer()
        ->runInBackground()
        ->appendOutputTo(storage_path('logs/scheduler.log'));

        // $schedule->command('schools:update-assessment')
        //  ->dailyAt('10:10')
        // ->withoutOverlapping(3600) 
        // ->onOneServer()
        // ->runInBackground()
        // ->appendOutputTo(storage_path('logs/scheduler.log'));

        // $schedule->command('fitness:update-levels')
        //  ->dailyAt('16:59')
        // ->withoutOverlapping(3600) 
        // ->onOneServer()
        // ->runInBackground()
        // ->appendOutputTo(storage_path('logs/scheduler.log'));

        // $schedule->command('sync:senior-test-summary')
        //  ->dailyAt('18:05')
        // ->withoutOverlapping(3600) 
        // ->onOneServer()
        // ->runInBackground()
        // ->appendOutputTo(storage_path('logs/scheduler.log'));
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
