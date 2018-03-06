<?php

namespace Tests\Unit;

use App\Advertiser;
use Tests\TestCase;
use App\Advertisement;
use App\Jobs\CreateAdvertisement as Create;
use App\Jobs\UpdateAdvertisementStatus as Update;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdvertisementTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function we_can_create_an_advertisement(): void
    {
        $advertiser = factory(Advertiser::class)->create();

        $this->assertEquals(0, $advertiser->adss()->count());

        $ad = (new Create($advertiser, 'Foo', 'Foo bar baz', 1930, true))->handle();

        $this->assertEquals(1, $advertiser->adss()->count());
        $this->assertTrue($ad->status);
    }

    /** @test */
    public function we_can_toggle_the_advertisement_status(): void
    {
        $ad = factory(Advertisement::class)->create();

        $this->assertTrue($ad->status);

        (new Update($ad, false))->handle();

        $this->assertFalse($ad->fresh()->status);
    }
}
