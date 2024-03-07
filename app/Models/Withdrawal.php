<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'amount',
        'status',
        'confirm',
        'deposit',
        'info',
        'attach',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function transaction(){
        return $this->hasOne(Transaction::class);
    }
  
    public function attach(){
        if($this->attach){
            return public_path("/media/users/withdrawal/".$this->attach);
        }
        return false;
    }
}
