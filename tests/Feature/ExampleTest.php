<?php

use function Pest\Laravel\get;

// test('returns a successful response', function () {
//     $response = $this->get('/');

//     $response->assertStatus(200);
// });

it('returns a successful response', function () {
    // Act & assert
    get(route('home'))->assertOk();
    // Alternatively:
    // $response = $this->get(route('home'));
    //

    // $response->assertStatus(200);
});
