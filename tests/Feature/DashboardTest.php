<?php

use App\Models\User;

test('guests are redirected when visiting dashboard', function () {
    $response = $this->get('/dashboard');

    // Adjust based on your actual redirect
    $response->assertRedirect('/'); // or ->assertStatus(302);
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/dashboard');
    $response->assertStatus(200);
});