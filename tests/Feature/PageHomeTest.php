<?php

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('shows courses overview page', function () {
    // Arrange
    $firstCourse = Course::factory()->released(Carbon::now())->create();
    $secondCourse = Course::factory()->released(Carbon::tomorrow())->create();

    // Act and Assert
    get(route('home'))->assertSeeText([
        $firstCourse->title,
        $firstCourse->description,
    ]);

    // Assert
    // $response->assertStatus(200);
    // $response->assertViewIs('home');
});

it('shows only released courses', function () {
    // Arrange
    $releasedCourse = Course::factory()->released(Carbon::yesterday())->create([
        'title' => 'My first course',
        'released_at' => Carbon::yesterday(),
    ]);
    $unreleasedCourse = Course::factory()->create([
        'title' => 'My second course',
    ]);

    // Act
    get(route('home'))->assertSeeText([
        $releasedCourse->title,
    ])->assertDontSeeText([
        $unreleasedCourse->title,
    ]);

    // Assert
    // $response->assertSee('Welcome to Our Application');
});

it('shows courses by release data', function () {
    // Arrange
    $releasedCourse = Course::factory()->released(Carbon::yesterday())->create();
    $newestCourse = Course::factory()->released(Carbon::now())->create();

    // Act
    get(route('home'))->assertSeeTextInOrder([
        $newestCourse->title,
        $releasedCourse->title,
    ]);

    // Assert
    // $response->assertSee('Welcome to Our Application');
});
