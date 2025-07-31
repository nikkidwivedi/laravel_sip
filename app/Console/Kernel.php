<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // Your scheduled tasks
        $schedule->command('sip:generate-invoices')->hourly();
        $schedule->command('sip:process-invoices')->hourly();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    protected $commands = [
        \App\Console\Commands\GenerateSipInvoices::class,
        \App\Console\Commands\ProcessSipInvoices::class,
    ];
}