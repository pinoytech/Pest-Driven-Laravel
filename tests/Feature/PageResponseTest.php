<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('gives back a successful response', function () {
    // Act
    $response = get(route('home'));

    // Assert
    $response->assertOk();
});
