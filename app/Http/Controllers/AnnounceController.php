<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use App\Http\Requests\StoreAnnounceRequest;
use App\Http\Requests\UpdateAnnounceRequest;

class AnnounceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnnounceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Announce $announce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announce $announce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnounceRequest $request, Announce $announce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announce $announce)
    {
        //
    }
}
