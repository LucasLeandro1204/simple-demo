<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Advertiser;
use App\Advertisement;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdvertiserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_list_advertisers(): void
    {
        $advertiser = factory(Advertiser::class)->create();

        factory(Advertisement::class, 2)->create([
            'advertiser_id' => $advertiser->id,
            'price' => 3000,
        ]);

        // another without add
        factory(Advertiser::class)->create([
            'name' => 'Foo',
        ]);

        $response = $this->get(route('advertiser.index'));
        $response->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    [
                        'id' => 1,
                        'name' => $advertiser->name,
                        'value' => 6000,
                    ],
                    [
                        'id' => 2,
                        'name' => 'Foo',
                        'value' => 0,
                    ],
                ],
            ]);
    }

    /** @test */
    public function cant_create_without_required_parameters(): void
    {
        $response = $this->post(route('advertiser.store', []));
        $response->assertStatus(302);

        $response = $this->post(route('advertiser.store', [
            'name' => 'Foo',
        ]));
        $response->assertStatus(302);

        $response = $this->post(route('advertiser.store', [
            'name' => 'Foo',
            'phone' => null,
            'address' => 'Foo at foo',
        ]));
        $response->assertStatus(302);
    }

    /** @test */
    public function can_create_advertiser(): void
    {
        $response = $this->post(route('advertiser.store'), [
            'name' => 'Foo',
            'phone' => '48 9 9999 9999',
            'address' => 'Foo at bar',
        ]);
        $response->assertStatus(201);

        $advertiser = Advertiser::first();

        $this->assertNotNull($advertiser);
        $this->assertEquals('Foo', $advertiser->name);
    }

    /** @test */
    public function can_update_advertiser(): void
    {
        $advertiser = factory(Advertiser::class)->create();
        
        $response = $this->put(route('advertiser.update', $advertiser), [
            'name' => 'Foo',
        ]);
        $response->assertStatus(200);

        $this->assertEquals('Foo', $advertiser->fresh()->name);
    }

    /** @test */
    public function can_delete_advertiser(): void
    {
        $advertiser = factory(Advertiser::class)->create();

        $response = $this->delete(route('advertiser.destroy', $advertiser));
        $response->assertStatus(200);

        $this->assertFalse(Advertiser::exists());
    }
}
