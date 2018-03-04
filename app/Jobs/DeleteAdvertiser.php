<?php

namespace App\Jobs;

use App\Advertiser;

class deleteAdvertiser
{
    /**
     * The advertiser.
     *
     * @var Advertiser
     */
    protected $advertiser;

    /**
     * The attributes to update.
     *
     * @var array
     */
    protected $attributes;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Advertiser $advertiser)
    {
        $this->advertiser = $advertiser;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->advertiser->delete();
    }
}