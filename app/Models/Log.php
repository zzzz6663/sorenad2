<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'log',
        'type',
        'link',
        'seen',
        'site_id',
        'advertise_id',
        'transaction_id',
        'withdrawal_id',
        'answer_id',


    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function site(){
        return $this->belongsTo(Site::class);
    }

    public function advertise(){
        return $this->belongsTo(Advertise::class);
    }

    public function withdrawal(){
        return $this->belongsTo(Withdrawal::class);
    }
    public function answer(){
        return $this->belongsTo(Answer::class);
    }

}
