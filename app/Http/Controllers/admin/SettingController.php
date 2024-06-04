<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    // setting_ads_app
    // ads_app
    public function setting_ads_app(Request $request){
        if($request->isMethod("post")){
            $data=$request->validate([
                'app_advertiser_click'=>"required",
                'app_advertiser_show'=>"required",
                'app_limit_order'=>"required",
                'app_active_site'=>"required",
                'app_user_vip_click'=>"required|integer|lt:app_advertiser_click",
                'app_user_vip_show'=>"required|integer|lt:app_advertiser_show",
                'app_user_normal_click'=>"required|integer|lt:app_advertiser_click",
                'app_user_normal_show'=>"required|integer|lt:app_advertiser_show",
            ]);
            foreach($data as $key=>$val){
                $setting=Setting::whereName( $key)->first();
                $setting->update(['val'=>$val]);
                cache()->put($key, $val);
            }
            toast()->success("اطلاعات با موفقیت ذخیره شد ");
            return redirect()->route("setting.ads.app");
        }

        // $setting_ads_app=Setting::whereType("setting_ads_app")->get();
        $app_advertiser_click=Setting::whereName("app_advertiser_click")->first();
        $app_advertiser_show=Setting::whereName("app_advertiser_show")->first();
        $app_limit_order=Setting::whereName("app_limit_order")->first();
        $app_active_site=Setting::whereName("app_active_site")->first();
        $app_user_vip_click=Setting::whereName("app_user_vip_click")->first();
        $app_user_vip_show=Setting::whereName("app_user_vip_show")->first();
        $app_user_normal_click=Setting::whereName("app_user_normal_click")->first();
        $app_user_normal_show=Setting::whereName("app_user_normal_show")->first();


        return view('admin.setting.setting_ads_app', compact([
            "app_advertiser_click",
            "app_advertiser_show",
            "app_limit_order",
            "app_active_site",
            "app_user_vip_click",
            "app_user_vip_show",
            "app_user_normal_click",
            "app_user_normal_show",
        ]));
    }
    public function setting_ads_banner(Request $request){
        if($request->isMethod("post")){
            $data=$request->validate([
                'banner_advertiser_click'=>"required",
                'banner_advertiser_show'=>"required",
                'banner_limit_order'=>"required",
                'banner_active_site'=>"required",
                'banner_user_vip_click'=>"required",
                'banner_user_vip_show'=>"required",
                'banner_user_normal_click'=>"required",
                'banner_user_normal_show'=>"required",
            ]);
            foreach($data as $key=>$val){
                $setting=Setting::whereName( $key)->first();
                $setting->update(['val'=>$val]);
                cache()->put($key, $val);

            }
            toast()->success("اطلاعات با موفقیت ذخیره شد ");
            return redirect()->route("setting.ads.banner");
        }

        // $setting_ads_banner=Setting::whereType("setting_ads_banner")->get();
        $banner_advertiser_click=Setting::whereName("banner_advertiser_click")->first();
        $banner_advertiser_show=Setting::whereName("banner_advertiser_show")->first();
        $banner_limit_order=Setting::whereName("banner_limit_order")->first();
        $banner_active_site=Setting::whereName("banner_active_site")->first();
        $banner_user_vip_click=Setting::whereName("banner_user_vip_click")->first();
        $banner_user_vip_show=Setting::whereName("banner_user_vip_show")->first();
        $banner_user_normal_click=Setting::whereName("banner_user_normal_click")->first();
        $banner_user_normal_show=Setting::whereName("banner_user_normal_show")->first();
        return view('admin.setting.setting_ads_banner', compact([
            "banner_advertiser_click",
            "banner_advertiser_show",
            "banner_limit_order",
            "banner_active_site",
            "banner_user_vip_click",
            "banner_user_vip_show",
            "banner_user_normal_click",
            "banner_user_normal_show",
        ]));
    }

    public function setting_ads_fixpost(Request $request){
        if($request->isMethod("post")){
            $data=$request->validate([
                'fixpost_advertiser_click'=>"required",
                'fixpost_advertiser_show'=>"required",
                'fixpost_limit_order'=>"required",
                'fixpost_active_site'=>"required",
                'fixpost_user_vip_click'=>"required",
                'fixpost_user_vip_show'=>"required",
                'fixpost_user_normal_click'=>"required",
                'fixpost_user_normal_show'=>"required",
            ]);
            foreach($data as $key=>$val){
                $setting=Setting::whereName( $key)->first();
                $setting->update(['val'=>$val]);
                cache()->put($key, $val);

            }
            toast()->success("اطلاعات با موفقیت ذخیره شد ");
            return redirect()->route("setting.ads.fixpost");
        }

        // $setting_ads_fixpost=Setting::whereType("setting_ads_fixpost")->get();
        $fixpost_advertiser_click=Setting::whereName("fixpost_advertiser_click")->first();
        $fixpost_advertiser_show=Setting::whereName("fixpost_advertiser_show")->first();
        $fixpost_limit_order=Setting::whereName("fixpost_limit_order")->first();
        $fixpost_active_site=Setting::whereName("fixpost_active_site")->first();
        $fixpost_user_vip_click=Setting::whereName("fixpost_user_vip_click")->first();
        $fixpost_user_vip_show=Setting::whereName("fixpost_user_vip_show")->first();
        $fixpost_user_normal_click=Setting::whereName("fixpost_user_normal_click")->first();
        $fixpost_user_normal_show=Setting::whereName("fixpost_user_normal_show")->first();
        return view('admin.setting.setting_ads_fixpost', compact([
            "fixpost_advertiser_click",
            "fixpost_advertiser_show",
            "fixpost_limit_order",
            "fixpost_active_site",
            "fixpost_user_vip_click",
            "fixpost_user_vip_show",
            "fixpost_user_normal_click",
            "fixpost_user_normal_show",
        ]));
    }

    public function setting_ads_popup(Request $request){
        if($request->isMethod("post")){
            $data=$request->validate([
                'popup_advertiser_click'=>"required",
                'popup_advertiser_show'=>"required",
                'popup_limit_order'=>"required",
                'popup_active_site'=>"required",
                'popup_user_vip_click'=>"required",
                'popup_user_vip_show'=>"required",
                'popup_user_normal_click'=>"required",
                'popup_user_normal_show'=>"required",
            ]);
            foreach($data as $key=>$val){
                $setting=Setting::whereName( $key)->first();
                $setting->update(['val'=>$val]);
                cache()->put($key, $val);

            }
            toast()->success("اطلاعات با موفقیت ذخیره شد ");
            return redirect()->route("setting.ads.popup");
        }

        // $setting_ads_popup=Setting::whereType("setting_ads_popup")->get();
        $popup_advertiser_click=Setting::whereName("popup_advertiser_click")->first();
        $popup_advertiser_show=Setting::whereName("popup_advertiser_show")->first();
        $popup_limit_order=Setting::whereName("popup_limit_order")->first();
        $popup_active_site=Setting::whereName("popup_active_site")->first();
        $popup_user_vip_click=Setting::whereName("popup_user_vip_click")->first();
        $popup_user_vip_show=Setting::whereName("popup_user_vip_show")->first();
        $popup_user_normal_click=Setting::whereName("popup_user_normal_click")->first();
        $popup_user_normal_show=Setting::whereName("popup_user_normal_show")->first();
        return view('admin.setting.setting_ads_popup', compact([
            "popup_advertiser_click",
            "popup_advertiser_show",
            "popup_limit_order",
            "popup_active_site",
            "popup_user_vip_click",
            "popup_user_vip_show",
            "popup_user_normal_click",
            "popup_user_normal_show",
        ]));
    }

    public function setting_ads_video(Request $request){
        if($request->isMethod("post")){
            $data=$request->validate([
                'video_advertiser_click'=>"required",
                'video_advertiser_show'=>"required",
                'video_limit_order'=>"required",
                'video_active_site'=>"required",
                'video_user_vip_click'=>"required",
                'video_user_vip_show'=>"required",
                'video_user_normal_click'=>"required",
                'video_user_normal_show'=>"required",
            ]);
            foreach($data as $key=>$val){
                $setting=Setting::whereName( $key)->first();
                $setting->update(['val'=>$val]);
                cache()->put($key, $val);
            }
            toast()->success("اطلاعات با موفقیت ذخیره شد ");
            return redirect()->route("setting.ads.video");
        }

        // $setting_ads_video=Setting::whereType("setting_ads_video")->get();
        $video_advertiser_click=Setting::whereName("video_advertiser_click")->first();
        $video_advertiser_show=Setting::whereName("video_advertiser_show")->first();
        $video_limit_order=Setting::whereName("video_limit_order")->first();
        $video_active_site=Setting::whereName("video_active_site")->first();
        $video_user_vip_click=Setting::whereName("video_user_vip_click")->first();
        $video_user_vip_show=Setting::whereName("video_user_vip_show")->first();
        $video_user_normal_click=Setting::whereName("video_user_normal_click")->first();
        $video_user_normal_show=Setting::whereName("video_user_normal_show")->first();
        return view('admin.setting.setting_ads_video', compact([
            "video_advertiser_click",
            "video_advertiser_show",
            "video_limit_order",
            "video_active_site",
            "video_user_vip_click",
            "video_user_vip_show",
            "video_user_normal_click",
            "video_user_normal_show",
        ]));
    }



    public function site_setting(Request $request){

        $tax_percent_page_ad=Setting::whereName("tax_percent_page_ad")->first();
        $min_val_checkout=Setting::whereName("min_val_checkout")->first();
        $min_val_charge=Setting::whereName("min_val_charge")->first();
        if($request->isMethod("post")){
            $data=$request->validate([
                'tax_percent_page_ad'=>"required|max:15",
                'min_val_checkout'=>"required|integer",
                'min_val_charge'=>"required|integer",
                'change_pass_admin'=>"nullable",
                'repeat_pass_admin'=>"nullable",
            ]);
            if($request->change_pass_admin && ($request->change_pass_admin!=$request->repeat_pass_admin)){
                toast()->warning("پسورد وتکرار آن مطابقت ندارد");
                return redirect()->route("site.setting");

            }
            $user=User::find(1);
            $data['password']=bcrypt($request->change_pass_admin);
            $user->update(['password'=>$data['password']]);
            $tax_percent_page_ad->update([
                'val'=>$data['tax_percent_page_ad']
            ]);
            $min_val_checkout->update([
                'val'=>$data['min_val_checkout']
            ]);
                foreach($data as $key=>$val){
                $setting=Setting::whereName( $key)->first();
                $setting->update(['val'=>$val]);
                cache()->put($key, $val);
            }

            toast()->success("اطلاعات با موفقیت ذخیره شد ");
            return redirect()->route("site.setting");

        }


        return view('admin.setting.site_setting', compact([
            "tax_percent_page_ad",
            "min_val_checkout",
            "min_val_charge",
        ]));

       }


    public function setting_ads_text(Request $request){

        if($request->isMethod("post")){
            $data=$request->validate([
                'text_advertiser_click'=>"required",
                'text_advertiser_show'=>"required",
                'text_limit_order'=>"required",
                'text_active_site'=>"required",
                'text_user_vip_click'=>"required",
                'text_user_vip_show'=>"required",
                'text_user_normal_click'=>"required",
                'text_user_normal_show'=>"required",
            ]);
            foreach($data as $key=>$val){
                $setting=Setting::whereName( $key)->first();
                $setting->update(['val'=>$val]);
                cache()->put($key, $val);

            }
            toast()->success("اطلاعات با موفقیت ذخیره شد ");
            return redirect()->route("setting.ads.text");
        }

        // $setting_ads_text=Setting::whereType("setting_ads_text")->get();
        $text_advertiser_click=Setting::whereName("text_advertiser_click")->first();
        $text_advertiser_show=Setting::whereName("text_advertiser_show")->first();
        $text_limit_order=Setting::whereName("text_limit_order")->first();
        $text_active_site=Setting::whereName("text_active_site")->first();
        $text_user_vip_click=Setting::whereName("text_user_vip_click")->first();
        $text_user_vip_show=Setting::whereName("text_user_vip_show")->first();
        $text_user_normal_click=Setting::whereName("text_user_normal_click")->first();
        $text_user_normal_show=Setting::whereName("text_user_normal_show")->first();


        return view('admin.setting.setting_ads_text', compact([
            "text_advertiser_click",
            "text_advertiser_show",
            "text_limit_order",
            "text_active_site",
            "text_user_vip_click",
            "text_user_vip_show",
            "text_user_normal_click",
            "text_user_normal_show",
        ]));
    }

    public function setting_ads_chanal(Request $request){
        if($request->isMethod("post")){

            $data=$request->validate([
                'chanal_active_site'=>"required",
                'chanal_advertiser_atlist_price'=>"required",
                'chanal_advertiser_atlist_count'=>"required",
                'chanal_user_normal_show'=>"required",
                'chanal_user_vip_show'=>"required",
                'chanal_setting1'=>"nullable",
                'chanal_setting2'=>"nullable",
                'chanal_setting3'=>"nullable",
            ]);

            foreach($data as $key=>$val){
                $setting=Setting::whereName( $key)->first();
                $setting->update(['val'=>$val]);
                cache()->put($key, $val);
            }
            toast()->success("اطلاعات با موفقیت ذخیره شد ");
            return redirect()->route("setting.ads.chanal");
        }

        // $setting_ads_text=Setting::whereType("setting_ads_text")->get();
        $chanal_setting1=Setting::whereName("chanal_setting1")->first();
        $chanal_setting2=Setting::whereName("chanal_setting2")->first();
        $chanal_setting3=Setting::whereName("chanal_setting3")->first();
        $chanal_active_site=Setting::whereName("chanal_active_site")->first();
        $chanal_advertiser_atlist_price=Setting::whereName("chanal_advertiser_atlist_price")->first();
        $chanal_advertiser_atlist_count=Setting::whereName("chanal_advertiser_atlist_count")->first();
        $chanal_user_normal_show=Setting::whereName("chanal_user_normal_show")->first();
        $chanal_user_vip_show=Setting::whereName("chanal_user_vip_show")->first();
         return view('admin.setting.setting_ads_chanal', compact([
            "chanal_setting1",
            "chanal_setting2",
            "chanal_setting3",
            "chanal_active_site",
            "chanal_advertiser_atlist_price",
            "chanal_advertiser_atlist_count",
            "chanal_user_normal_show",
            "chanal_user_vip_show",
        ]));
    }

    public function setting_ads_hamsan(Request $request){
        if($request->isMethod("post")){
            $data=$request->validate([
                'hamsan_advertiser_click'=>"required",
                'hamsan_advertiser_show'=>"required",
                'hamsan_limit_order'=>"required",
                'hamsan_active_site'=>"required",
                'hamsan_user_vip_click'=>"required",
                'hamsan_user_vip_show'=>"required",
                'hamsan_user_normal_click'=>"required",
                'hamsan_user_normal_show'=>"required",
            ]);
            foreach($data as $key=>$val){
                $setting=Setting::whereName( $key)->first();
                $setting->update(['val'=>$val]);
                cache()->put($key, $val);
            }
            toast()->success("اطلاعات با موفقیت ذخیره شد ");
            return redirect()->route("setting.ads.hamsan");
        }

        // $setting_ads_hamsan=Setting::whereType("setting_ads_hamsan")->get();
        $hamsan_advertiser_click=Setting::whereName("hamsan_advertiser_click")->first();
        $hamsan_advertiser_show=Setting::whereName("hamsan_advertiser_show")->first();
        $hamsan_limit_order=Setting::whereName("hamsan_limit_order")->first();
        $hamsan_active_site=Setting::whereName("hamsan_active_site")->first();
        $hamsan_user_vip_click=Setting::whereName("hamsan_user_vip_click")->first();
        $hamsan_user_vip_show=Setting::whereName("hamsan_user_vip_show")->first();
        $hamsan_user_normal_click=Setting::whereName("hamsan_user_normal_click")->first();
        $hamsan_user_normal_show=Setting::whereName("hamsan_user_normal_show")->first();
         return view('admin.setting.setting_ads_hamsan', compact([
            "hamsan_advertiser_click",
            "hamsan_advertiser_show",
            "hamsan_limit_order",
            "hamsan_active_site",
            "hamsan_user_vip_click",
            "hamsan_user_vip_show",
            "hamsan_user_normal_click",
            "hamsan_user_normal_show",
        ]));
    }



}
