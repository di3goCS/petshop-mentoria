<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;

use App\Models\Owner;
use App\Repositories\OwnerRepository;

class OwnerService {

    protected $ownerRepository;

    public function __construct(OwnerRepository $ownerRepository){
        $this->ownerRepository = $ownerRepository;
    }

    public function getOwners(){
        return $this->ownerRepository->getowners();
    }

    public function storeOwner($data){
        $validator = Validator::make($data, [
            'name' => 'required|max:100',
            'contact' => 'required',
        ]);

        if ($validator->fails()){
            return $validator->errors();
        }

        $owner;

        DB::transaction( function() use ($data, &$owner){
            $owner = $this->ownerRepository->storeOwner($data);
            return response()->json(['owner' => $owner]);
        });

        return $owner;
        
    }

    public function showOwner($id){
        $owner = [];
        DB::transaction( function() use ($id, &$owner){
            $owner = $this->ownerRepository->showOwner($id);
        });

        return $owner;
    }

    public function updateOwner($data, $id){
        $validator = Validator::make($data, [
            'name' => 'required|max:100',
            'contact' => 'required',
        ]);

        if ($validator->fails()){
            return $validator->errors();
        }

        $owner;

        DB::transaction( function() use ($data, $id, &$owner){
            $owner = $this->ownerRepository->updateOwner($id, $data);
        });

        $error['msg'] = 'Operação não realizada';
        $error['status'] =  503;

        return $owner ? response()->json(['owner' => $owner]) : response()->json(['error' => $error]);
    }

    public function deleteOwner($id) {
        $owner;
        DB::transaction( function() use ($id, &$owner){
            $owner = $this->ownerRepository->deleteOwner($id);
        });

        $error['msg'] = 'Operação não realizada';
        $error['status'] =  503;

        return $owner ? response()->json(['owner' => $owner]) : response()->json(['error' => $error]);
    }
}