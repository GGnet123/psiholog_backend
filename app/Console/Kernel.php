<?php

namespace App\Console;

use App\Services\Cron\AutoRenewalSubscriptionService;
use App\Services\Cron\CalcWillPayedSubscriptionService;
use App\Services\Cron\CalcWillRecordService;
use App\Services\Cron\DeclineExpriredRecordService;
use App\Services\Cron\NeedDoAffirmationService;
use App\Services\Cron\NeedDoMeditationService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            AutoRenewalSubscriptionService::do();
            CalcWillPayedSubscriptionService::calc();
            NeedDoMeditationService::do();
        })->daily();

        $schedule->call(function () {
            DeclineExpriredRecordService::do();
        })->hourly();

        $schedule->call(function () {
            CalcWillRecordService::calc();
        })->everyThreeHours();

        $schedule->call(function () {
            NeedDoAffirmationService::do();
        })->dailyAt('09:00');
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
