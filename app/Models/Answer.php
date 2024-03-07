<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'customer_id',
        'ticket_id',
        'answer',
        'attach',
        'seen',

    ];
    public function customer(){
        return $this->belongsTo(User::class,"customer_id");
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function ticket(){
        return $this->belongsTo(Ticket::class );
    }
    public function attach(){
        if($this->attach){
            return public_path("/media/ticket/attach/".$this->attach);
        }
        return false;
    }
  
}
