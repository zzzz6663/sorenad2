<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cat;
use App\Models\Site;
use App\Models\User;
use App\Models\Action;
use App\Models\Course;
use App\Models\Section;
use App\Models\Setting;
use App\Models\Advertise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use PHPUnit\Framework\Constraint\Count;
use Laravel\Socialite\Facades\Socialite;

class ApiController extends Controller
{
    public function test(Request $request)
    {


        // $users = Cache::rememberForever('users', function () {
        //     return User::all();
        // });


        $css = response()->make(asset('/css/css_add.css'));
        $css = asset('/css/css_add.css');
        $domin = $request->domin;
        $app = ("admin.add_temp.app");
        $site = Site::where('site', 'LIKE', "%{$domin}%")->first();
        $site_owner = $site->user;
        $type = "app";
        // $advertise = Advertise::where('active', 1)->whereType("app")->where("confirm", "!=", "null")->whereStatus("ready_to_show")
        // ->whereHas("actions",function($query){
        //     $query->whereDate('created_at', Carbon::today())
        //    ->selectRaw('count(*)')->havingRaw('count(*) < advertises.limit_daily_view');
        // })
        // ->first();
        $advertise = Advertise::where('active', 1)->whereType("app")->where("confirm", "!=", "null")->whereStatus("ready_to_show");
        // if (Advertise::whereHas('cats')->count() > 0) {
            $advertise->whereHas('cats', function ($query) use ($site) {
                $query->where('id', $site->cat_id);
            });
        // }
           $advertise ->where(function ($qu) {
                $qu->doesntHave('actions')
                    ->orWhereHas("actions", function ($query) {
                        $query->whereDate('created_at', Carbon::today())
                       ->whereDate('created_at', Carbon::today())
                        ->where(function ($query) {
                            if (\DB::raw('advertises.count_type') === 'view') {
                                $query->selectRaw('count(*)')
                                    ->havingRaw('count(*) < advertises.limit_daily_view');
                            }


                            else {
                                $query->selectRaw('count(*)')
                                    ->havingRaw('count(*) < advertises.limit_daily_click');
                            }
                        });

                        // ->whereColumn('count_type', '=', 'advertises.count_type')
                        // ->selectRaw('count(*)')
                        // ->havingRaw('count(*) < CASE WHEN advertises.count_type = "view" THEN advertises.limit_daily_view ELSE advertises.limit_daily_click END');
                            // ->when(
                            //     \DB::raw('advertises.count_type = "view"'),
                            //     function ($query) {
                            //        return $query->selectRaw('count(*)')
                            //             ->havingRaw('count(*) < advertises.limit_daily_view');
                            //     },
                            //     function ($query) {
                            //         return  $query->selectRaw('count(*)')
                            //             ->havingRaw('count(*) < advertises.limit_daily_click');
                            //     }
                            // );
                        // ->when(\DB::raw('advertises.count_type = "click"'), function ($query) {
                        //     $query->selectRaw('count(*)')
                        //           ->havingRaw('count(*) < advertises.limit_daily_click');
                        // });
                    });
            });
            $advertise=      $advertise->inRandomOrder()
            ->first();

        if ($advertise) {
            $advertise_owner = $advertise->user;
            // $data['app_advertiser_show'] = $advertise_owner->setting_cache("app_advertiser_show");
            // $data['app_advertiser_click'] = $advertise_owner->setting_cache("app_advertiser_click");
            // $data['app_user_vip_click'] = $advertise_owner->setting_cache("app_user_vip_click");
            // $data['app_user_normal_click'] = $advertise_owner->setting_cache("app_user_normal_click");
            // $data['app_user_normal_show'] = $advertise_owner->setting_cache("app_user_normal_show");
            // $data['app_user_vip_show'] = $advertise_owner->setting_cache("app_user_vip_show");


            // 'site_share',
            // 'admin_share',
            // 'adveriser_share',e
            // 'unit_show',//قیمت در  لحظه ثبت
            // 'unit_click',//قیمت در  لحظه ثبت
            // 'unit_normal_click',//قیمت در  لحظه ثبت
            // 'unit_normal_show',//قیمت در  لحظه ثبت
            // 'unit_vip_show',//قیمت در  لحظه ثبت
            // 'unit_vip_click',//
            $action['count_type'] = $advertise->count_type;
            $action['advertiser_id'] = $advertise->user->id;
            $action['advertise_id'] = $advertise->id;
            $action['site_id'] = $site->user->id;
            $action['type'] = $type;
            $action['site'] = $site->site;
            $action['ip'] = $request->getClientIp();
            if ($site_owner->vip) {
                if ($advertise->count_type == "view") {
                    $action['admin_share'] = $advertise->unit_show - $advertise->unit_vip_show;
                    $action['site_share'] = $advertise->unit_vip_show;
                    $action['adveriser_share'] = $advertise->unit_vip_show * -1;
                }
                if ($advertise->count_type == "click") {
                    $action['admin_share'] = $advertise->unit_click - $advertise->unit_vip_click;
                    $action['site_share'] = $advertise->unit_vip_click;
                    $action['adveriser_share'] = $advertise->unit_vip_click * -1;
                }
            } else {
                if ($advertise->count_type == "view") {
                    $action['admin_share'] = $advertise->unit_show - $advertise->unit_normal_show;
                    $action['site_share'] = $advertise->unit_normal_show;
                    $action['adveriser_share'] = $advertise->unit_normal_show * -1;
                }
                if ($advertise->count_type == "click") {
                    $action['admin_share'] = $advertise->unit_click - $advertise->unit_normal_click;
                    $action['site_share'] = $advertise->unit_normal_click;
                    $action['adveriser_share'] = $advertise->unit_normal_click * -1;
                }
            }
            $exist=Action::where('ip', $action['ip'])->where('site', $action['site'])->where('advertise_id', $action['advertise_id'])->first();
            if(! $exist){
                if ($advertise->count_type == "view") {
                    $action['main'] = 1;
                    Action::create($action);
                    if ($advertise->actions->count() >= $advertise->view_count) {
                        $advertise->update(['status' => "down"]);
                    }
                }else{
                    $action['main'] = 0;
                    $action['active'] = 0;
                    Action::create($action);
                }
            }

        }




        if ($site_owner->float_app &&  $advertise) {
            return response()->json([
                'all' => $request->all(),
                'ip' => $request->ip(),
                'ips' => $request->getClientIp(),
                'css' => $css,
                'status' => "ok",
                'url' => $request->getRequestUri(),
                'url2' => $request->fullUrl(),
                'url3' => $request->url(),
                'url4' => $request->getHost(),
                'advertise' => $advertise,
                'site_owner' => $site_owner,
                'advertise_owner' => $advertise_owner,
                'action' => $action,
                'advertise_id' => $advertise->id,
                'site_cat_id' => $site->cat_id,
                'site_id' => $site->id,
                'body' => view($app, compact(['advertise', "site"]))->render(),
            ]);
        }


        return response()->json([
            'status' => "noسk",
            'float_app' => $site_owner->float_app,
            'advertise' => $advertise,
        ]);
    }
}
