<?php

namespace Tests\Feature;

use App\Classes\StorageRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $totalSize = (new StorageRepository('test', 'test'))->getDirectorySize('/home/luccui');

        echo $totalSize;
    }
}
