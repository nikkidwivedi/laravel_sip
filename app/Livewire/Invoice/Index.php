<?php
namespace App\Livewire\Invoice;

use Livewire\Component;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin', ['title' => 'My Invoices'])]
class Index extends Component
{
    public function render()
    {
        $invoices = Invoice::with('sip')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('livewire.invoice.index', compact('invoices'));
    }
}