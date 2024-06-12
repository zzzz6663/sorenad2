<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\Cat;
use App\Models\Site;
use App\Models\User;
use App\Models\Action;
use App\Models\Course;
use GuzzleHttp\Client;
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





    public function ads(Request $request)
    {


        // return response()->json([
        //     'site' =>  "not_ok",
        // ]);
        $user = new User();
        $ip = $user->get_ip();

        $machin = $request->header('User-Agent');
        $css = response()->make(asset('/css/css_add.css'));
        $css = asset('/css/css_add.css');
        $domin = $request->domin;
        $device = $request->device;
        if($device=='desktop'){
            $device="computer";
        }

        $advertise = null;
        $fixpost = null;
        $banner = null;
        $banner2 = null;
        $video = null;
        $hamsan = null;
        $text = null;
        $popup = null;
        $fixpost_req = $request->fixpost;
        $banner_req = $request->banner;
        $banner2_req = $request->banner2;
        $video_req = $request->video;
        $hamsan_req = $request->hamsan;
        $text_req = $request->text;
        $popup_req = $request->popup;
        $app_temp = ("admin.add_temp.app");
        $fixpost_temp = ("admin.add_temp.fixpost");
        $banner_temp = ("admin.add_temp.banner");
        $video_temp = ("admin.add_temp.video");
        $hamsan_temp = ("admin.add_temp.hamsan");
        $text_temp = ("admin.add_temp.text");
        $popup_temp = ("admin.add_temp.popup");
        // $site = Site::find(22);
        // $device = "mobile"

        // $sites=  Cache::get('sites', function() {
        //     return Site::whereStatus("confirmed");
        // });
        // $site= $sites->where('site', 'LIKE', "%{$domin}%")->first();
        $site = Site::where('site', 'LIKE', "%{$domin}%")->whereStatus("confirmed")->first();
        if (!$site) {
            return response()->json([
                'all' => $request->all(),
                'ip' =>  $ip,
                'site' =>  "not_ok",
            ]);
        }
        $site_owner = $site->user;
        $app = null;
        $fixpost = null;;
        if ($site_owner->float_app  &&  $device == "mobile") {
            $advertise = $this->query($site, $request, "app", $ip);
            if ($advertise) {
                $app = view($app_temp, compact(['advertise', "site", "ip"]))->render();
            }
        }
        //
        if ($site_owner->back_popup) {
            $advertise = $this->query($site, $request, "popup", $ip);
            if ($advertise) {
                $popup = view($popup_temp, compact(['advertise', "site", "ip"]))->render();
            }
        }

        if ($fixpost_req) {
            $advertise = $this->query($site, $request, "fixpost", $ip);
            if ($advertise) {
                $fixpost = view($fixpost_temp, compact(['advertise', "site", "ip"]))->render();
            }
        }

        if ($banner_req) {
            $advertise = $this->query($site, $request, "banner", $ip);
            if ($advertise) {
                $banner = view($banner_temp, compact(['advertise', "site", "ip"]))->render();
            }
        }
        if ($banner2_req) {
            $advertise = $this->query($site, $request, "banner", $ip);
            if ($advertise) {
                $banner2= view($banner_temp, compact(['advertise', "site", "ip"]))->render();
            }
        }
        if ($video_req) {
            $advertise = $this->query($site, $request, "video", $ip);
            if ($advertise) {
                $video = view($video_temp, compact(['advertise', "site", "ip"]))->render();
            }
        }
        if ($text_req) {
            $advertise = $this->query($site, $request, "text", $ip, 10);
            if ($advertise) {
                $text = view($text_temp, compact(['advertise', "site", "ip"]))->render();
            }
        }
        if ($site_owner->hamsan) {
            $advertise = $this->query($site, $request, "hamsan", $ip);
            if ($advertise) {
                $hamsan = view($hamsan_temp, compact(['advertise', "site", "ip"]))->render();
            }
        }
        // sss
        return response()->json([
            'all' => $request->all(),
            'ip' =>  $ip,
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
            'banner' => $banner,
            'banner2' => $banner2,
            'video' => $video,
            'hamsan' => $hamsan,
            'text' => $text,
            'device' => $device,
            'popup' => $popup,
            'site' => $site,
            'back_popup' =>   $site_owner->back_popup,

        ]);
    }
    public function query($site, $request, $type, $ip, $count = 1)
    {
        $site_owner = $site->user;
        $site_id = $site->id;
        $device = $request->device;
        if($device=='desktop'){
            $device="computer";
        }
        $advertise = Advertise::where('active', 1)->whereType($type)->where("confirm", "!=", "null")->whereStatus("ready_to_show");
        $advertise->orderByRaw('RAND()');
        $advertise->whereHas('cats', function ($query) use ($site) {
            $query->where('id', $site->cat_id);
        });
        if(  $device=="mobile"){
            $advertise->whereIn("device",['mobile',"mobile_computer"]);
        }
        if(  $device=="computer"){
            $advertise->whereIn("device",['computer',"mobile_computer"]);
        }
        $advertise
            ->where(function ($qu) use ($type, $ip,$site_id) {
                if ($type == "popup") {
                    // $qu->whereDoesntHave('actions')
                    $qu  ->whereDoesntHave("actions", function ($q3) use ( $ip,$site_id) {
                        $q3->where('ip', $ip)->where('site_id', $site_id)->whereDate('created_at', Carbon::today());
                        });
                } else {
                    $qu->whereDoesntHave('actions')
                        ->orWhereHas("actions", function ($q3) {
                            // $q3->whereDate('created_at', '=', now()->toDateString());
                            $q3->whereDate('created_at', Carbon::today());
                        }, '<', DB::raw('`limit_daily`'));
                }
            });
        if ($count > 1) {
            $advertise = $advertise->take(10)->get();;
        } else {
            $advertise = $advertise
            // ->orderBy('order_count', 'ASC')
                // ->orderByRaw('RAND()')
                // ->inRandomOrder()
                ->first();
        }





        $exist = false;
        if ($advertise) {
            if ($count > 1) {
                foreach ($advertise as $adver) {
                    $this->calculate($adver, $type, $site, $ip, $site_owner);
                }
            } else {
                $exist = $this->calculate($advertise, $type, $site, $ip, $site_owner);
            }
        }
        // if ($type=="popup" && $exist){
        //     return false;
        // }
        return $advertise;
    }

    public function getIp()
    {
        $client = new Client();
        $res = $client->get('https://api.db-ip.com/v2/free/self');
        $res = json_decode($res->getBody()->getContents(), true);
        return $res['ipAddress'];
    }

    public function calculate($advertise, $type, $site, $ip, $site_owner)
    {
        $advertise_owner = $advertise->user;
        $action['count_type'] = $advertise->count_type;
        $action['advertiser_id'] = $advertise->user->id;
        $action['advertise_id'] = $advertise->id;
        $action['siter_id'] = $site->user->id;
        $action['site_id'] = $site->id;
        $action['type'] = $type;
        $action['site'] = $site->site;
        $action['ip'] = $ip;
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
        if ($type == "popup") {
            $exist = Action::where('ip', $action['ip'])->where('site_id', $action['site_id'])->where('advertise_id', $action['advertise_id'])->whereDate('created_at', Carbon::today())->first();
        } else {
            $exist = Action::where('ip', $action['ip'])->where('site_id', $action['site_id'])->where('advertise_id', $action['advertise_id'])->first();
        }
        if (!$exist) {
            if ($advertise->count_type == "view") {
                $action['main'] = 1;
                Action::create($action);
                if ($advertise->actions->count() >= $advertise->order_count) {
                    $advertise->update(['status' => "down"]);
                    $advertise->user->send_pattern($$advertise->user->mobile, "3ii278gte7r1cz5", ['name' => $$advertise->user->name()]);
                }
            }
        }
        $advertise->update(['display' => $advertise->display + 1]);
        return $exist;
    }
}
