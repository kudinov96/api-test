<?php

namespace Tests;

use App\Models\User;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Laravel\Sanctum\Sanctum;

class FeatureTestCase extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->faker = Container::getInstance()->make(Generator::class);
    }

    protected function responseDd(TestResponse $response, ?array $payload = null)
    {
        dd(
            json_encode(
                json_decode($response->baseResponse->getContent()), JSON_PRETTY_PRINT
            ),
            $payload
        );
    }

    protected function beUser(): User
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);
        $this->be($user);

        return $user;
    }
}
