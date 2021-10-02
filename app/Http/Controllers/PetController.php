<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Services\PetService;
use Illuminate\Http\Request;

class PetController extends Controller
{
    protected $petService;

    public function __construct(PetService $petService){
        $this->petService = $petService;
    }
 
    public function index()
    {
        $pets = $this->petService->getPets();

        return response()->json(['pets' => $pets]);
    }


    public function store(Request $request)
    {
        $response = $this->petService->storePet($request->all());

        return response()->json(['response' => $response]);
    }

    public function show(Pet $pet)
    {
        // Já que com Model Binding, o Laravel já encontra o $pet pelo id enviado para a rota,
        // isso aqui seria dispensável? Nesse ponto aqui eu já tenho a resposta. 
        $response = $this->petService->showPet($pet);

        return response()->json(['response' => $response]);
    }

    public function update(Request $request, Pet $pet)
    {
        $response = $this->petService->updatePet($request->all(), $pet);

        return response()->json(['response' => $response]);
    }

    public function destroy(Pet $pet)
    {
        $response = $this->petService->deletePet($pet->id);

        return response()->json(['response' => $response]);
    }
}
