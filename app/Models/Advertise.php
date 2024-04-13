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
        'limit_daily_view',//محدودیت نمایش روزانه
        'limit_daily_click',//محدودیت کلیک روزانه
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
        'display',//نمایش کلی برای وضعیت کلیک
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
    public function banner1(){
        if($this->banner1){
            return asset('/media/advertises/'.$this->banner1);
        }
        return false;
    }

    public function banner2(){
        if($this->banner2){
            return asset('/media/advertises/'.$this->banner2);
        }
        return false;
    }
    public function icon(){
        if($this->icon){
            return asset('/media/advertises/'.$this->icon);
        }
        return false;
    }
}
