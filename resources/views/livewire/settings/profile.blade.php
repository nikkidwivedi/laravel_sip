  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div>{{-- End Page Title --}}

    @if (session('status') != '')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('status') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="section profile">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body pt-3">
              {{-- Bordered Tabs --}}
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Profile Details</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->name }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <div class="text-success mt-2" wire:transition.fade wire:loading.remove wire:target="updateProfileInformation">
                      <x-action-message on="profile-updated">
                          {{ __('Saved.') }}{{-- @translation-ignore --}}
                      </x-action-message>
                  </div>

                  {{-- Profile Edit Form --}}
                  <form wire:submit.prevent="updateProfileInformation">

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" wire:model="name">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" wire:model="email">
                        @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                          <div class="mt-3">
                              <p class="text-warning mb-1">{{ __('Your email address is unverified.') }}{{-- @translation-ignore --}}</p>
                              <button type="button" class="btn btn-link p-0" wire:click="resendVerificationNotification">
                                  {{ __('Click here to re-send the verification email.') }}{{-- @translation-ignore --}}
                              </button>

                              @if (session('status') === 'verification-link-sent')
                                  <p class="text-success mt-2">
                                      {{ __('A new verification link has been sent to your email address.') }}{{-- @translation-ignore --}}
                                  </p>
                              @endif
                          </div>
                        @endif
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form>{{-- End Profile Edit Form --}}

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  {{-- Change Password Form --}}
                  <form wire:submit.prevent="updatePassword">
                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="currentPassword" type="password" class="form-control" id="currentPassword" wire:model.defer="current_password">
                        @error('current_password') <div class="text-danger">{{ $message }}</div> @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newPassword" type="password" class="form-control" id="newPassword" wire:model.defer="password">
                        @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirm New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewPassword" type="password" class="form-control" id="renewPassword" wire:model.defer="password_confirmation">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form>
                </div>

              </div>{{-- End Bordered Tabs --}}

            </div>
          </div>
        </div>
      </div>
    </section>
  </main>{{-- End #main --}}