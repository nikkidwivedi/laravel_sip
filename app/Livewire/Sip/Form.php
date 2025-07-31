<?php

namespace App\Livewire\Sip;

use Livewire\Component;
use App\Models\Sip;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.admin', ['title' => 'Create SIP'])]
class Form extends Component
{
    public $amount, $frequency = 'daily', $sip_day, $start_date, $end_date;

    protected $rules = [
        'amount' => 'required|numeric|min:1',
        'frequency' => 'required|in:daily,monthly',
        'sip_day' => 'nullable|integer|min:1|max:30',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ];

    public function save()
    {
        $this->validate();

        Sip::create([
            'user_id' => Auth::id(),
            'amount' => $this->amount,
            'frequency' => $this->frequency,
            'sip_day' => $this->frequency === 'monthly' ? $this->sip_day : null,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => 'active',
        ]);

        return redirect()->route('livewire.sip.index')->with('success', 'SIP created successfully!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.sip.form');
    }
}