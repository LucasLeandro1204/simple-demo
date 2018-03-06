<?php

namespace App\Jobs;

use App\Advertiser;
use App\Advertisement;

class CreateAdvertisement
{
    /**
     * The Advertiser.
     *
     * @var Advertiser
     */
    protected $advertiser;

    /**
     * The title.
     *
     * @var string
     */
    protected $title;

    /**
     * The body.
     *
     * @var string
     */
    protected $body;

    /**
     * The price.
     *
     * @var int
     */
    protected $price;

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
    public function __construct(Advertiser $advertiser, string $title, string $body, int $price, bool $status = true)
    {
        $this->advertiser = $advertiser;
        $this->title = $title;
        $this->body = $body;
        $this->price = $price;
        $this->status = $status;
    }

    /**
     * Execute the job.
     */
    public function handle(): Advertisement
    {
        return $this->advertiser->adss()->create([
            'title' => $this->title,
            'body' => $this->body,
            'price' => $this->price,
            'status' => $this->status,
        ]);
    }
}