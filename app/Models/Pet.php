<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Owner;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'type', 'breed', 'owner_id'];

    protected $hidden = ['created_at', 'updated_at', 'owner_id'];
    
    public function owner(){
        return $this->belongsTo(Owner::class);
    }
}
