<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    use HasFactory;
    protected$fillable=[
        'user_id',//
        'title',//
        'landing_title1',//صفحه ورود
        'landing_title2',//صفحه ورود
        'landing_title3',//صفحه ورود
        'landing_link1',//صفحه ورود
        'landing_link2',//صفحه ورود
        'landing_link3',//صفحه ورود
        'info',//توضیحات آگهی
        'type',//نوع آگهی
        'count_type',//نوع شمارش آگهی
        'model_price',//
        'limit_daily',//محدودیت  روزانه
        'device',//ابزار نمایش
        'banner1',//بنر یک
        'banner2',//بنر دو
        'banner',//بنر دو
        'icon',//بنر دو
        'click_count',//کلیک درخواستی
        'view_count',//نمایش درخواستی
        'payed',//وضعیت پرداخت
        'status',//وضعیت
        'price',//قیمت
        'tax',//مالیات
        'remain',//بقیمانده
        'confirm',//تایید
        'call_to_action',//اقدام به دعوت
        'text',//متن تبلیغ
        'video1',//ویدئو
        'active',//ویدئو
        'unit_show',//قیمت در  لحظه ثبت
        'unit_click',//قیمت در  لحظه ثبت
        'unit_normal_click',//قیمت در  لحظه ثبت
        'unit_normal_show',//قیمت در  لحظه ثبت
        'unit_vip_show',//قیمت در  لحظه ثبت
        'unit_vip_click',//قیمت در  لحظه ثبت
        'dispay_count',//تعداد نمایش کلی
        'bg_color',//رتگ بک گراند
        'bt_color',//رتگ بک گراند bt
        'display',//نمایش کلی برای وضعیت کلیک
        'attach',//
        'ita' ,
        'rubika' ,
        'bale' ,
        'instagram' ,


    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function actions(){
        return $this->hasMany(Action::class);
    }


    public function transaction(){
        return $this->hasMany(Transaction::class);
    }
    public function cats(){
        return $this->BelongsToMany(Cat::class);
    }

    public function groups(){
        return $this->BelongsToMany(Group::class);
    }
    public function banner1(){
        if($this->id &&$this->banner1){
            return asset('/media/advertises/'.$this->banner1);
        }
        return false;
    }

    public function banner2(){
        if($this->id &&$this->banner2){
            return asset('/media/advertises/'.$this->banner2);
        }
        return false;
    }
    public function icon(){

        if($this->id && $this->icon){
            return asset('/media/advertises/'.$this->icon);
        }
        return false;
    }
    public function video1(){
        if($this->id && $this->video1){
            return asset('/media/advertises/'.$this->video1);
        }
        return false;
    }

    public function attach(){
        if($this->id && $this->attach){
            return asset('/media/advertises/'.$this->attach);
        }
        return false;
    }
}
