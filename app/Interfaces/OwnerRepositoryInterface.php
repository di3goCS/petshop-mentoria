<?php

namespace App\Interfaces;

interface OwnerRepositoryInterface {
    public function getOwners();

    public function storeOwner($data);

    public function showOwner($id);

    public function updateOwner($id, $data);

    public function deleteOwner($id);
}