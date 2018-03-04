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

    /**
     * Advertiser name.
     *
     * @var string
     */
    protected $name = 'Cláudio';

    /**
     * Advertiser phone.
     *
     * @var string
     */
    protected $phone = '48 9 9999 9999';

    /**
     * Advertiser address.
     *
     * @var string
     */
    protected $address = 'Rua Manoel Carlos';
    
    /** @test */
    public function we_can_create_an_advertiser(): void
    {
        $this->assertNull(Advertiser::first());

        $advertiser = (new Create($this->name, $this->phone, $this->address))->handle();

        $this->assertInstanceOf(Advertiser::class, $advertiser);
        $this->assertEquals($this->name, $advertiser->name);
        $this->assertEquals($this->phone, $advertiser->phone);
        $this->assertEquals($this->address, $advertiser->address);
        $this->assertNotNull(Advertiser::first());
    }

    /** @test */
    public function we_can_update_an_advertiser(): void
    {
        $advertiser = factory(Advertiser::class)->create();

        (new Update($advertiser, [
            'name' => $this->name,
        ]))->handle();

        $this->assertEquals($this->name, $this->advertiser->name);
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
