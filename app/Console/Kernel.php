<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Contoh scheduling command Anda
        $schedule->command('blog:process-csv')
                 ->everyMinute();
                //  ->when(function () {
                //      $randomInterval = rand(50, 85);
                //      return now()->minute % $randomInterval === 0;
                //  });
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
