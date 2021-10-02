<?php

namespace App\Interfaces;

interface PetRepositoryInterface {
    public function getPets();

    public function storePet($data);

    public function showPet($id);

    public function updatePet($id, $data);

    public function deletePet($id);
}