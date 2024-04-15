<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;
    protected $fillable=[
        'advertiser_id',
        'advertise_id',

        'site_id',
        'siter_id',
        'type',
        'site',
        'amount',
        'ip',
        'count_type',
        'site_share',
        'admin_share',
        'adveriser_share',
        'signature',
        'main',//اصلی بودن یا نبودن اکشن
        //اکشنهایغیر اصلی برای شمارش بازدید فقط محاسبه میشوند
        'active',//محاسبه نشده اگر صفر بود یعنی محاسبه شده
    ];
    public function advertise(){
        return $this->belongsTo(Advertise::class);
    }
    public function advertiser(){
        return $this->belongsTo(User::class,"advertiser_id");
    }
    public function site(){
        return $this->belongsTo(Site::class);
    }
    public function siter(){
        return $this->belongsTo(User::class,"siter_id");
    }
}
