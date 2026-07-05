<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates a project via the web form', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/projects', [
        'name' => 'My Web Project',
        'description' => 'Created from a test',
        'status' => 'active',
    ]);

    $response->assertRedirect();

    $this->assertDatabaseHas('projects', [
        'name' => 'My Web Project',
        'user_id' => $user->id,
    ]);
});
