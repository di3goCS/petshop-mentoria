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

    public function index()
    {
        $result = $this->ownerService->getOwners();

        return response()->json(['owners' => $result]);
    }

    public function store(Request $request)
    {
        $result = $this->ownerService->storeOwner($request->all());

        return response()->json($result, 201);
    }


    public function show(Owner $owner)
    {
        $result = $this->ownerService->showOwner($owner->id);

        return $result;
    }

    public function update(Request $request, $id)
    {
        // $response = $this->ownerService->updateOwner($request->all(), $owner->id);
        $response = $this->ownerService->updateOwner($request->all(), $id);

        return response()->json($response);
    }

    public function destroy(Owner $owner)
    {
        $response = $this->ownerService->deleteOwner($owner->id);

        return response()->json($response);
    }
}
