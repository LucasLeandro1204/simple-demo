<?php

namespace App\Http\Controllers;

use App\Advertiser;
use App\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Jobs\CreateAdvertisement as Create;
use App\Jobs\UpdateAdvertisementStatus as Update;

class AdvertisementController extends Controller
{
    /**
     * Store advertisement.
     */
    public function store(Request $request): Response
    {
        $data = array_values($request->validate([
            'title' => 'required|string|max:80',
            'body' => 'required|string|max:240',
            'price' => 'required|int',
        ]));

        dispatch_now(new Create(Advertiser::findOrFail($request->advertiser), ...$data));

        return response(Response::$statusTexts[Response::HTTP_CREATED], Response::HTTP_CREATED);
    }

    /**
     * Update advertisement status.
     */
    public function update(Advertisement $ad, Request $request): void
    {
        $data = $request->validate([
            'status' => 'required|bool',
        ]);

        dispatch_now(new Update($ad, $data['status']));
    }
}
