<?php

namespace App\Jobs;

use App\Advertiser;

class UpdateAdvertiser
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
    public function __construct(Advertiser $advertiser, array $attributes)
    {
        $this->advertiser = $advertiser;
        $this->attributes = $attributes;
    }

    /**
     * Execute the job.
     */
    public function handle(): Advertiser
    {
        $this->advertiser->update($this->attributes);

        return tap($this->advertiser)->save();
    }
}