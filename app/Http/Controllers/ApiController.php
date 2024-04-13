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
        // return response()->json([
        //     'status' => "noسk",
        // ]);

        // $users = Cache::rememberForever('users', function () {
        //     return User::all();
        // });


        $css = response()->make(asset('/css/css_add.css'));
        $css = asset('/css/css_add.css');
        $domin = $request->domin;
        $device = $request->device;
        $fixpost_req = $request->fixpost;
        $app_temp = ("admin.add_temp.app");
        $fixpost_temp = ("admin.add_temp.fixpost");
        // $site = Site::find(22);
             // $device = "mobile"
        $site = Site::where('site', 'LIKE', "%{$domin}%")->whereStatus("confirmed")->first();
        $site_owner = $site->user;
        $app = null;
        $fixpost = null;
   ;
        if ($site_owner->float_app  &&  $device == "mobile") {
            $advertise = $this->query($site, $request, "app");
            if ($advertise) {
                $app = view($app_temp, compact(['advertise', "site"]))->render();
            }
        }

        if ($fixpost_req) {
            $advertise = $this->query($site, $request, "fixpost");
            if ($advertise) {
                $fixpost = view($fixpost_temp, compact(['advertise', "site"]))->render();
            }
        }


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
            'site_cat_id' => $site->cat_ied,
            'site_id' => $site->id,
            'fixpost_req' => $fixpost_req,
            'app' => $app,
            'fixpost' => $fixpost,
        ]);
    }
    public function query($site, $request, $type)
    {
        // ddd
        $site_owner = $site->user;

        $advertise = Advertise::where('active', 1)->whereType($type)->where("confirm", "!=", "null")->whereStatus("ready_to_show");
        $advertise->whereHas('cats', function ($query) use ($site) {
            $query->where('id', $site->cat_id);
        });
        $advertise->where(function ($q1) {
                $q1->where("count_type", "view")
                    ->orWhereHas("actions", function ($q3) {
                        $q3->whereDate('created_at', Carbon::today())
                      ->select('advertise_id')->groupBy('advertise_id')->havingRaw('COUNT(*) < advertises.limit_daily_view');
                    })
               ->where("count_type", "click")
                    ->orWhereHas("actions", function ($q4) {
                        $q4->whereDate('created_at', Carbon::today())
                        ->select('advertise_id')->groupBy('advertise_id')->havingRaw('COUNT(*) < advertises.limit_daily_click');
                    });

        });
        // $advertise->where(function ($qu) {
        //     $qu->doesntHave('actions')
        //     ->orWhereHas("actions", function ($query) {
        //         $query->whereDate('created_at', Carbon::today())
        //             ->where(function ($query) {
        //                 $query->where('advertises.count_type', 'view')->selectRaw('count(*)')
        //                     ->havingRaw('count(*) < advertises.limit_daily_view');
        //             })
        //             ->orWhere(function ($query) {
        //                 $query->where('advertises.count_type', 'click')->selectRaw('count(*)')
        //                     ->havingRaw('count(*) < advertises.limit_daily_click');
        //             });
        //     });
        // });
        $advertise = $advertise->inRandomOrder()->first();
        if ($advertise) {
            $advertise_owner = $advertise->user;
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

            $exist = Action::where('ip', $action['ip'])->where('site', $action['site'])->where('advertise_id', $action['advertise_id'])->first();
            if (!$exist) {
                if ($advertise->count_type == "view") {
                    $action['main'] = 1;
                    Action::create($action);
                    if ($advertise->actions->count() >= $advertise->view_count) {
                        $advertise->update(['status' => "down"]);
                    }
                }
            }
            $advertise->update(['display' => $advertise->display + 1]);
        }
        return $advertise;
    }
}
