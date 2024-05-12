<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'active',
        'name',
    ];

    public function advertises(){
        return $this->BelongsToMany(Advertise::class);
    }
     public function chanals(){
        return $this->hasMany(Chanal::class);
    }
}
