<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;

use App\Models\Pet;
use App\Repositories\PetRepository;

class PetService {

    protected $petRepository;

    public function __construct(PetRepository $petRepository){
        $this->petRepository = $petRepository;
    }

    public function getPets(){
        return $this->petRepository->getPets();
    }

    /* Não fiz verifivações de unicidade no nome dos Pets, pois imagino que seja muito fácil,
        no mundo real, que vários pets tenham o mesmo nome */
    public function storePet($data){
        $validator = Validator::make($data, [
            'name' => 'required|max:100',
            'age' => 'required|integer',
            'type' => ['required', Rule::in(['cat', 'dog'])],
            //'type' => ['required', Rule::in('gato', 'cachorro')],
            'race' => 'required|max:100',
            'owner_id' => 'required|exists:App\Models\Owner,id'
        ]);

        if ($validator->fails()){
            return $validator->errors();
        }

        $pet;

        DB::transaction( function() use ($data, &$pet){
            $pet = $this->petRepository->storePet($data);
            return response()->json(['pet' => $pet]);
        });

        $error['msg'] = 'Operação não realizada';
        $error['status'] =  503;

        return $pet ? response()->json(['pet' => $pet]) : response()->json(['error' => $error]);
        
    }

    public function showPet($id){
        $pet = [];
        DB::transaction( function() use ($id, &$pet){
            $pet = $this->petRepository->showPet($id);
        });

        return $pet;
    }

    public function updatePet($data, $id){
        $validator = Validator::make($data, [
            'name' => 'max:100',
            'age' => 'integer',
            'type' => [Rule::in(['cat', 'dog'])],
            //'type' => ['required', Rule::in('gato', 'cachorro')],
            'race' => 'max:100',
            'owner' => 'max:100',
        ]);

        if ($validator->fails()){
            return $validator->errors();
        }

        $pet;

        DB::transaction( function() use ($data, $id, &$pet){
            $pet = $this->petRepository->updatePet($id, $data);
        });

        $error['msg'] = 'Operação não realizada';
        $error['status'] =  503;

        return $pet ? response()->json(['pet' => $pet]) : response()->json(['error' => $error]);
    }

    public function deletePet($id) {
        $pet;
        DB::transaction( function() use ($id, &$pet){
            $pet = $this->petRepository->deletePet($id);
        });

        $error['msg'] = 'Operação não realizada';
        $error['status'] =  503;

        return $pet ? response()->json(['pet' => $pet]) : response()->json(['error' => $error]);
    }
}