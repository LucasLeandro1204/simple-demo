<?php

namespace App\Jobs;

use App\Advertisement;

class UpdateAdvertisementStatus
{
    /**
     * The Advertisement.
     *
     * @var Advertiser
     */
    protected $advertisement;

    /**
     * The status.
     *
     * @var bool
     */
    protected $status;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Advertisement $advertisement, bool $status)
    {
        $this->advertisement = $advertisement;
        $this->status = $status;
    }

    /**
     * Execute the job.
     */
    public function handle(): Advertisement
    {
        $this->advertisement->update([
            'status' => $this->status,
        ]);
        
        return tap($this->advertisement)->save();
    }
}