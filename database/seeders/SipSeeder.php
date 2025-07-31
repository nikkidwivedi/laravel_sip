<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sip;
use App\Models\User;
use Carbon\Carbon;

class SipSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first(); // Use the first test user

        Sip::create([
            'user_id' => $user->id,
            'amount' => 1000.00,
            'frequency' => 'monthly',
            'sip_day' => 15,
            'start_date' => Carbon::now()->subDays(2)->toDateString(),
            'end_date' => Carbon::now()->addMonths(6)->toDateString(),
            'status' => 'active',
        ]);
    }
}