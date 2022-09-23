<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Operation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CalculatorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 
     *
     * @return void
     */
    public function testShouldResultTheSumOfTwoNumbers()
    {
        $user = User::factory()->create();

        Operation::create([
            'type' => 'addition',
            'cost' => 1
        ]);

        $response = $this->actingAs($user)->postJson('/api/v1/calculator',[
            'type' => 'addition',
            'value1' => 5,
            'value2' => 2
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'result' => 7,
            ]);
    }

    /**
     * 
     *
     * @return void
     */
    public function testShouldResultFailIfValueIsString()
    {
        $user = User::factory()->create();

        Operation::create([
            'type' => 'addition',
            'cost' => 1
        ]);

        $response = $this->actingAs($user)->postJson('/api/v1/calculator',[
            'type' => 'addition',
            'value1' => 'a',
            'value2' => 1
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                'errors' => [
                    [
                        'title' => 'invalid-data-type',
                    ],
                ]
            ]);
    }

    /**
     * 
     *
     * @return void
     */
    public function testShouldResultFailIfTypeDoesNotExists()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/v1/calculator',[
            'type' => 'addition',
            'value1' => 'a',
            'value2' => 1
        ]);

        $response
            ->assertStatus(404)
            ->assertJson([
                'errors' => [
                    [
                        'title' => 'type-not-exists',
                    ],
                ]
            ]);
    }

    /**
     * 
     *
     * @return void
     */
    public function testShouldResultFailIfUserHasNoCredits()
    {
        $user = User::factory([
            'balance' => 0
        ])->create();

        $response = $this->actingAs($user)->postJson('/api/v1/calculator',[
            'type' => 'addition',
            'value1' => 1,
            'value2' => 1
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                'errors' => [
                    [
                        'title' => 'insufficient-balance',
                    ],
                ]
            ]);
    }

    /**
     * 
     *
     * @return void
     */
    public function testShouldResultFailIfUserHasNoEnoughCredits()
    {
        $user = User::factory([
            'balance' => 1
        ])->create();

        Operation::create([
            'type' => 'addition',
            'cost' => 2
        ]);

        $response = $this->actingAs($user)->postJson('/api/v1/calculator',[
            'type' => 'addition',
            'value1' => 1,
            'value2' => 1
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                'errors' => [
                    [
                        'title' => 'insufficient-balance',
                    ],
                ]
            ]);
    }
}
