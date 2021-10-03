<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Owner;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'type', 'race', 'owner_id'];

    protected $hidden = ['created_at', 'updated_at'];
    
    public function owner(){
        return $this->belongsTo(Owner::class);
    }
}
