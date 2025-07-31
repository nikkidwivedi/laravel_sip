<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

/**
 * Livewire authentication component (do not edit).
 */
new #[Layout('components.layouts.auth')] class extends Component
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $this->validate();
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(
            ['email' => $this->email, 'password' => $this->password],
            $this->remember
        )) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        session()->flash('success', 'Welcome back, ' . Auth::user()->name . '!');

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
};
?>

{{--  ▼▼  SINGLE‑ROOT BLADE MARKUP (NiceAdmin theme)  ▼▼ --}}
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                {{-- Logo --}}
                <div class="py-4">
                    <a href="{{ url('/') }}" class="logo d-flex align-items-center w-auto">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="">
                        <span class="d-none d-lg-block">NiceAdmin</span>
                    </a>
                </div>

                {{-- Card --}}
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                            <p class="text-center small">Enter your email & password to login</p>
                        </div>

                        {{-- Session flash --}}
                        @if (session('status'))
                            <div class="alert alert-success text-center py-2">{{ session('status') }}</div>
                        @endif

                        {{-- Livewire form --}}
                        <form wire:submit.prevent="login"
                              class="row g-3 needs-validation"
                              novalidate>

                            {{-- Email --}}
                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group has-validation">
                                    <input  type="email"
                                            id="email"
                                            wire:model.defer="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            required
                                            autocomplete="email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Password --}}
                            <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                <input  type="password"
                                        id="password"
                                        wire:model.defer="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        required
                                        autocomplete="current-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Remember me --}}
                            <div class="col-12">
                                <div class="form-check">
                                    <input  class="form-check-input"
                                            type="checkbox"
                                            wire:model="remember"
                                            id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">
                                        Remember me
                                    </label>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">
                                    Login
                                </button>
                            </div>

                            {{-- Register link --}}
                            @if (Route::has('register'))
                                <div class="col-12 text-center">
                                    <p class="small mb-0">
                                        Don't have an account?
                                        <a href="{{ route('register') }}" wire:navigate>
                                            Register
                                        </a>
                                    </p>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>

                {{-- Footer credits --}}
                <div class="credits">
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </div>
        </div>
    </div>
</section>