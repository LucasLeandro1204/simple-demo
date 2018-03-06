<?php

namespace Tests\Unit;

use App\Advertiser;
use Tests\TestCase;
use App\Jobs\CreateAdvertiser as Create;
use App\Jobs\DeleteAdvertiser as Delete;
use App\Jobs\UpdateAdvertiser as Update;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdvertiserTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function we_can_create_an_advertiser(): void
    {
        $this->assertNull(Advertiser::first());

        $advertiser = (new Create('Foo bar', '48 9 9999 9999', 'Foo bar baz'))->handle();

        $this->assertInstanceOf(Advertiser::class, $advertiser);
        $this->assertEquals('Foo bar', $advertiser->name);
        $this->assertEquals('48 9 9999 9999', $advertiser->phone);
        $this->assertEquals('Foo bar baz', $advertiser->address);
        $this->assertNotNull(Advertiser::first());
    }

    /** @test */
    public function we_can_update_an_advertiser(): void
    {
        $advertiser = factory(Advertiser::class)->create();

        $this->assertNotEquals('Foo bar', $advertiser->name); 

        (new Update($advertiser, [
            'name' => 'Foo bar',
        ]))->handle();

        $this->assertEquals('Foo bar', $advertiser->name);
    }

    /** @test */
    public function we_can_delete_an_advertiser(): void
    {
        $advertiser = factory(Advertiser::class)->create();

        $this->assertNotNull(Advertiser::first());

        (new Delete($advertiser))->handle();

        $this->assertNull(Advertiser::first());
    }
}
