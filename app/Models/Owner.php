<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Pet;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact'];

    protected $visible = ['name', 'contact'];

    public function pet(){
        return $this->hasMany(Pet::class);
    }
}
