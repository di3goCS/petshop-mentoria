<?php

namespace App\Repositories;

use App\Models\Owner;
use App\Interfaces\OwnerRepositoryInterface;

class OwnerRepository implements OwnerRepositoryInterface{

    protected $owner;

    public function __construct(Owner $owner){
        $this->owner = $owner;
    }

    public function getOwners(){
        $owners = $this->owner->all();
        return $owners;
    }

    public function storeOwner($data){
        $result = $this->owner->firstOrCreate($data);
        return $result;
    }

    public function showOwner($id){
        $owner = $this->owner->find($id);
        return $owner;
    }

    public function updateOwner($id, $data){
        $owner = $this->owner->find($id)->first();
        $change = $owner->update($data);

        if ($change){
            return $owner;
        }

        return $change;  
    }

    public function deleteOwner($id){
        $result = $this->owner->destroy($id);

        return ['deleted' => $result];
    }
}