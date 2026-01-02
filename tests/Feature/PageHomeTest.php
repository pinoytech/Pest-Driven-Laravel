<?php

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('shows courses overview page', function () {
    // Arrange
    Course::factory()->create([
        'title' => 'My first course',
        'description' => 'This is my first course description',
        'released_at' => Carbon::now(),
    ]);
    Course::factory()->create([
        'title' => 'My second course',
        'description' => 'This is my second course description',
    ]);

    // Act and Assert
    get(route('home'))->assertSeeText([
        'My first course',
        'This is my first course description',
    ]);

    // Assert
    // $response->assertStatus(200);
    // $response->assertViewIs('home');
});

it('shows only released courses', function () {
    // Arrange
    Course::factory()->create([
        'title' => 'My first course',
        'released_at' => Carbon::yesterday(),
    ]);
    Course::factory()->create([
        'title' => 'My second course',
    ]);

    // Act
    get(route('home'))->assertSeeText([
        'My first course',
    ])->assertDontSeeText([
        'My second course',
    ]);

    // Assert
    // $response->assertSee('Welcome to Our Application');
});

it('shows courses by release data', function () {
    // Arrange
    Course::factory()->create([
        'title' => 'My first course',
        'released_at' => Carbon::yesterday(),
    ]);
    Course::factory()->create([
        'title' => 'My second course',
        'released_at' => Carbon::now(),
    ]);

    // Act
    get(route('home'))->assertSeeTextInOrder([
        'My first course',
        'My second course',
    ]);

    // Assert
    // $response->assertSee('Welcome to Our Application');
});
