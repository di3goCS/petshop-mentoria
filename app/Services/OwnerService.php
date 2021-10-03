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
        });

        return ['owner' => $owner];
        
    }

    public function showOwner($id){
        $owner = [];
        DB::transaction( function() use ($id, &$owner){
            $owner = $this->ownerRepository->showOwner($id);
        });

        return ['owner' => $owner];
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

        return ['owner' => $owner];
    }

    public function deleteOwner($id) {
        $owner;
        $result;
        DB::transaction( function() use ($id, &$owner, &$result){
            $owner = $this->ownerRepository->showOwner($id);
            $result = $this->ownerRepository->deleteOwner($id);
        });

        $error['msg'] = 'Operação não realizada';

        return $result ? ['owner' => $owner] : ['error' => $error];
    }
}