<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Subscription;
use Illuminate\Contracts\Cache\Repository as Cache;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Cache $cache)
    {
        $subs = [];
        if ($cache->has("subs")) {
            $subs = $cache->get("subs");
        } else {
            $subs = Subscription::all();
            $cache->set("subs", $subs);
        }
        return response()->json($subs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionRequest $request, Cache $cache)
    {
        // input is validated using StoreSubscriptionRequest::class
        $subscription = new Subscription($request->only("user_id", "website_id"));
        $subscription->save();
        $cache->delete("subs");
        return response(status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        return response()->json($subscription);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription, Cache $cache)
    {
        $subscription->delete();
        $cache->delete("subs");
        return response(status:204);
    }
}
