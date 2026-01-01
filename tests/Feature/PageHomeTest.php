<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('shows courses overview page', function () {
    // Arrange
    Course::factory()->create([
        'title' => 'My first course',
        'description' => 'This is my first course description',
    ]);
    Course::factory()->create([
        'title' => 'My second course',
        'description' => 'This is my second course description',
    ]);
    Course::factory()->create([
        'title' => 'My third course',
        'description' => 'This is my third course description',
    ]);

    // Act and Assert
    get(route('home'))->assertSeeText([
        'My first course',
        'My second course',
        'My third course',
        'This is my first course description',
        'This is my second course description',
        'This is my third course description',
    ]);

    // Assert
    // $response->assertStatus(200);
    // $response->assertViewIs('home');
});

it('shows only released courses', function () {
    // Arrange
    // (set up any necessary data or state here)

    // Act
    $response = $this->get(route('home'));

    // Assert
    // $response->assertSee('Welcome to Our Application');
});

it('shows courses by release data', function () {
    // Arrange
    // (set up any necessary data or state here)

    // Act
    $response = $this->get(route('home'));

    // Assert
    // $response->assertSee('Welcome to Our Application');
});
