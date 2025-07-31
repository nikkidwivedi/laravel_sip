<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Sip;
use App\Models\Invoice;
use Carbon\Carbon;

class GenerateSipInvoices extends Command
{
    protected $signature = 'sip:generate-invoices';
    protected $description = 'Generate invoices 25 hours before SIP date';

    public function handle()
    {
        $now = now();
        $count = 0;

        $sips = Sip::where('status', 'active')->get();

        foreach ($sips as $sip) {
            // Check if today's the right time (25 hours before)
            $nextDate = $sip->next_due_date ?? $sip->start_date;

            // Invoice must not already exist
            $alreadyExists = Invoice::where('sip_id', $sip->id)
                ->whereDate('scheduled_date', $nextDate)
                ->exists();

            if (!$alreadyExists && $nextDate->isToday()) {
                // ✅ Generate random status *inside* the loop
                $status = Arr::random(['pending', 'success', 'failed']);

                Invoice::create([
                    'sip_id' => $sip->id,
                    'user_id' => $sip->user_id, 
                    'amount' => $sip->amount,
                    'scheduled_date' => $nextDate,
                    'status' => $status,
                ]);

                $count++;
            }
        }

        $this->info("Invoice generation completed. Total invoices created: $count");
    }
}