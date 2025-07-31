<?php

use App\Models\User;
use Livewire\Volt\Volt;

test('login screen loads correctly via Livewire Volt', function () {
    $response = $this->get('/'); // or wherever your login component is shown
    $response->assertSeeLivewire('auth.login'); // checks that Livewire Volt login component is rendered
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password'),
    ]);

    $response = Volt::test('auth.login')
        ->set('email', $user->email)
        ->set('password', 'password')
        ->call('login');

    $response
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password'),
    ]);

    $response = Volt::test('auth.login')
        ->set('email', $user->email)
        ->set('password', 'wrong-password')
        ->call('login');

    $response->assertHasErrors('email');

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $response->assertRedirect('/');

    $this->assertGuest();
});