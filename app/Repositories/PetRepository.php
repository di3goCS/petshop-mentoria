<?php

namespace App\Repositories;

use App\Models\Pet;
use App\Interfaces\PetRepositoryInterface;

class PetRepository implements PetRepositoryInterface{

    protected $pet;

    public function __construct(Pet $pet){
        $this->pet = $pet;
    }

    // As transactions devem ficar no Repository ou no Service?

    public function getPets(){
        //$pets = $this->pet->paginate(20);
        $pets = $this->pet->all();
        return $pets;
    }

    public function storePet($data){
        $result = $this->pet->create($data);
        return $result;
    }

    public function showPet($id){
        $pet = $this->pet->find($id);
        return $pet;
    }

    public function updatePet($id, $data){
        $pet = $this->pet->find($id)->first();
        $change = $pet->update($data);

        if ($change){
            return $pet;
        }

        return $change;  
    }

    public function deletePet($id){
        $result = $this->pet->destroy($id);

        return ['deleted' => $result];
    }
}