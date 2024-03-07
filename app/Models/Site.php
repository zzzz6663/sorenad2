<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'cat_id',
        'name',
        'site',
        'status',
        'popup_window',
        'floating_ad_app',
        'show_count_day',
        'confirm',
        'reason',

    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function cat(){
        return $this->belongsTo(Cat::class);
    }
    public function income(){
        return 0;
    }
}
