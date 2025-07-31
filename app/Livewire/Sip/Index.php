<?php

namespace App\Livewire\Sip;

use App\Models\Sip;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin', ['title' => 'My SIPs'])]
class Index extends Component
{
    public function render()
    {
        $sips = Sip::where('user_id', Auth::id())->latest()->get();

        return view('livewire.sip.index', compact('sips'));
    }
}