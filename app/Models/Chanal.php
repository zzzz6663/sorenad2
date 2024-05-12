<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chanal extends Model
{
    use HasFactory;
    protected$fillable=[
        'user_id',
        'group_id',
        'name',
        'url',
        'members',
        'status',


    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function group(){
        return $this->belongsTo(Group::class);
    }
}
