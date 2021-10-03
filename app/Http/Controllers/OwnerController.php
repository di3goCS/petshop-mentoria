<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;
use App\Services\OwnerService;

class OwnerController extends Controller
{
    protected $ownerService;

    public function __construct(OwnerService $ownerService){
        $this->ownerService = $ownerService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->ownerService->getOwners();

        return response()->json(['owners' => $result]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->ownerService->storeOwner($request->all());

        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        $result = $this->ownerService->showOwner($owner->id);

        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Owner $owner)
    {
        $response = $this->ownerService->updateOwner($request->all(), $owner->id);

        return response()->json(['response' => $response]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Owner $owner)
    {
        $response = $this->ownerService->deleteOwner($owner->id);

        return response()->json(['response' => $response]);
    }
}
