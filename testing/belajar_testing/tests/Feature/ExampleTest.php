<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/'); // Make an HTTP GET request to the root route

        $response->assertSee('Laravel') // Check if the response contains 'Laravel'
                 ->assertDontSee('Rails'); // Check if the response does not contain 'Rails'
    }
}
