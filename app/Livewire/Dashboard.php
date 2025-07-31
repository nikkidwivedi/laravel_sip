<?php
namespace App\Livewire;

use App\Models\Sip;
use App\Models\Invoice;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin', ['title' => 'Dashboard'])]
class Dashboard extends Component
{
    public function render()
    {
        $userId = Auth::id();

        return view('livewire.dashboard', [
            'totalSips'     => Sip::where('user_id', $userId)->count(),
            'activeSips'    => Sip::where('user_id', $userId)->where('status', 'active')->count(),
            'totalInvoices' => Invoice::where('user_id', $userId)->count(),
            'successCount'  => Invoice::where('user_id', $userId)->where('status', 'success')->count(),
            'pendingCount'  => Invoice::where('user_id', $userId)->where('status', 'pending')->count(),
            'failedCount'   => Invoice::where('user_id', $userId)->where('status', 'failed')->count(),
        ]);
    }
}