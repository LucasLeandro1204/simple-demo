<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Advertiser;
use App\Advertisement;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdvertisementControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function cant_create_an_advertisement_without_advertiser(): void
    {
        $response = $this->json('POST', route('advertisement.store'));
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'title', 'body', 'price',
        ]);

        $response = $this->json('POST', route('advertisement.store'), [
            'title' => 'Foo',
            'body' => 'kkkkk',
            'price' => 131390,
        ]);
        $response->assertStatus(404);
    }

    /** @test */
    public function can_create_an_advertisement(): void
    {
        $advertiser = factory(Advertiser::class)->create();
        
        $response = $this->post(route('advertisement.store'), [
            'advertiser' => $advertiser->id,
            'title' => 'Foo',
            'body' => 'Bar',
            'price' => 1390,
        ]);
        $response->assertStatus(201);

        $ad = Advertisement::first();

        $this->assertNotNull($ad);
        $this->assertEquals('Foo', $ad->title);
        $this->assertTrue($advertiser->adss()->exists());
    }

    /** @test */
    public function can_toggle_advertisement_status(): void
    {
        $ad = factory(Advertisement::class)->create();

        $this->assertTrue($ad->status);

        $response = $this->put(route('advertisement.update', $ad), [
            'title' => 'Foo',
            'status' => false,
        ]);
        $response->assertStatus(200);

        $ad = $ad->fresh();

        $this->assertFalse($ad->status);

        // Update status only
        $this->assertNotEquals('Foo', $ad->title);
    }
}
