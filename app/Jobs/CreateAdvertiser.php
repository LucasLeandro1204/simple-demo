<?php

namespace App\Jobs;

use App\Advertiser;

class CreateAdvertiser
{
    /**
     * The name.
     *
     * @var string
     */
    protected $name;

    /**
     * The phone.
     *
     * @var string
     */
    protected $phone;

    /**
     * The addresss.
     *
     * @var string
     */
    protected $address;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $name, string $phone, string $address)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
    }

    /**
     * Execute the job.
     */
    public function handle(): Advertiser
    {
        return Advertiser::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);
    }
}