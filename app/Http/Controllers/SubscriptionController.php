<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Subscription::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionRequest $request)
    {
        // input is validated using StoreSubscriptionRequest::class
        $subscription = new Subscription($request->all());
        $subscription->save();
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
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return response(status:204);
    }
}
