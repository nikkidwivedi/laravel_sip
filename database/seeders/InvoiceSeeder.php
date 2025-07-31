<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Invoice;
use App\Models\Sip;
use App\Models\User;
use Carbon\Carbon;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        $sip = Sip::first();
        $user = User::first();

        Invoice::create([
            'sip_id' => $sip->id,
            'user_id' => $user->id,
            'amount' => $sip->amount,
            'status' => 'pending',
            'scheduled_date' => Carbon::now()->addHour(),
        ]);
    }
}