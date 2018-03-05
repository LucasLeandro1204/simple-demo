<?php

namespace App\Http\Controllers;

use App\Advertiser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Jobs\CreateAdvertiser as Create;
use App\Jobs\UpdateAdvertiser as Update;
use App\Jobs\DeleteAdvertiser as Delete;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\AdvertiserResumeResource as Resume;

class AdvertiserController extends Controller
{
    /**
     * List the advertisers resume.
     */
    public function index(): ResourceCollection
    {
        return Resume::collection(Advertiser::all());
    }

    /**
     * Store advertiser.
     */
    public function store(Request $request): Response
    {
        $data = array_values($request->validate([
            'name' => 'required|string|max:80',
            'phone' => 'required|string|max:30',
            'address' => 'required|string|max:240',
        ]));

        dispatch_now(new Create(...$data));

        return response(Response::$statusTexts[Response::HTTP_CREATED], Response::HTTP_CREATED);
    }

    /**
     * Update advertiser.
     */
    public function update(Advertiser $advertiser, Request $request): void
    {
        $data = $request->validate([
            'name' => 'string|max:80',
            'phone' => 'string|max:30',
            'address' => 'string|max:240',
        ]);

        dispatch_now(new Update($advertiser, $data));
    }

    /**
     * Delete advertiser.
     */
    public function delete(Advertiser $advertiser): void
    {
        dispatch_now(new Delete($advertiser));
    }
}
