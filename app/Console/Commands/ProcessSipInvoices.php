<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;
use App\Services\FakeDebitApiService;

class ProcessSipInvoices extends Command
{
    protected $signature = 'sip:process-invoices';
    protected $description = 'Process pending SIP invoices 25 hours before their scheduled date and simulate debit using a fake API.';

    public function handle()
    {
        $now = now();
        $processed = 0;

        $invoices = Invoice::where('status', 'pending')->get();

        foreach ($invoices as $invoice) {
            $targetTime = $invoice->scheduled_date->copy()->subHours(25);
            $cutoffTime = $invoice->scheduled_date->copy()->subHours(24);

            if ($now->between($targetTime, $cutoffTime)) {
                $this->info("Processing invoice #{$invoice->id}");

                $response = FakeDebitApiService::process($invoice);
                $this->info("→ Result: " . json_encode($response));

                \Log::info("SIP Invoice Processed", [
                    'invoice_id' => $invoice->id,
                    'status' => $response['status'],
                    'response' => $response,
                ]);

                $processed++;
            }
        }

        $this->info("Invoice processing completed. Total invoices processed: $processed");
    }
}