<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));
        Auth::login($user);

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
};
?>

{{--  ▼▼  NiceAdmin-styled registration form using Livewire Volt  ▼▼ --}}
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

        <div class="py-4">
          <a href="{{ url('/') }}" class="logo d-flex align-items-center w-auto">
            <img src="{{ asset('assets/img/logo.png') }}" alt="">
            <span class="d-none d-lg-block">NiceAdmin</span>
          </a>
        </div>

        <div class="card mb-3">
          <div class="card-body">
            <div class="pt-4 pb-2">
              <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
              <p class="text-center small">Enter your personal details to create account</p>
            </div>

            <form wire:submit.prevent="register" class="row g-3 needs-validation" novalidate>
              {{-- Name --}}
              <div class="col-12">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" id="name" wire:model.defer="name" class="form-control @error('name') is-invalid @enderror" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              {{-- Email --}}
              <div class="col-12">
                <label for="email" class="form-label">Your Email</label>
                <input type="email" id="email" wire:model.defer="email" class="form-control @error('email') is-invalid @enderror" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              {{-- Password --}}
              <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" wire:model.defer="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              {{-- Confirm Password --}}
              <div class="col-12">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" id="password_confirmation" wire:model.defer="password_confirmation" class="form-control" required>
              </div>

              {{-- Submit --}}
              <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Create Account</button>
              </div>

              {{-- Login link --}}
              <div class="col-12 text-center">
                <p class="small mb-0">
                  Already have an account?
                  <a href="{{ route('login') }}" wire:navigate>Login</a>
                </p>
              </div>
            </form>
          </div>
        </div>

        <div class="credits">
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
    </div>
  </div>
</section>