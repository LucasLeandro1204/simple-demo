<?php

use App\Advertiser;
use App\Advertisement;
use Illuminate\Database\Seeder;

class AdvertisersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Advertiser::class, 15)->create()->each(function (Advertiser $advertiser) {
            $advertiser->adss()->saveMany(factory(Advertisement::class, rand(1, 5))->make([
                'advertiser_id' => $advertiser->id,
            ]));
        });
    }
}
