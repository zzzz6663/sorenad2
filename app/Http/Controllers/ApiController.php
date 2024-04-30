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





    public function test(Request $request)
    {


        // return response()->json([
        //     'site' =>  "not_ok",
        // ]);
            $user=new User();
        $ip = $user->get_ip();

        $machin=$request->header('User-Agent');
        $css = response()->make(asset('/css/css_add.css'));
        $css = asset('/css/css_add.css');
        $domin = $request->domin;
        $device = $request->device;

        $advertise=null;
        $fixpost=null;
        $banner=null;
       $video=null;
       $hamsan=null;
        $fixpost_req = $request->fixpost;
        $banner_req = $request->banner;
        $video_req = $request->video;
        $hamsan_req = $request->hamsan;
        $app_temp = ("admin.add_temp.app");
        $fixpost_temp = ("admin.add_temp.fixpost");
        $banner_temp = ("admin.add_temp.banner");
        $video_temp = ("admin.add_temp.video");
        $hamsan_temp = ("admin.add_temp.hamsan");
        // $site = Site::find(22);
        // $device = "mobile"

        // $sites=  Cache::get('sites', function() {
        //     return Site::whereStatus("confirmed");
        // });
        // $site= $sites->where('site', 'LIKE', "%{$domin}%")->first();
        $site = Site::where('site', 'LIKE', "%{$domin}%")->whereStatus("confirmed")->first();
        if(! $site){
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
            $advertise = $this->query($site, $request, "app",$ip);
            if ($advertise) {
                $app = view($app_temp, compact(['advertise', "site","ip"]))->render();
            }
        }

        if ($fixpost_req) {
            $advertise = $this->query($site, $request, "fixpost",$ip);
            if ($advertise) {
                $fixpost = view($fixpost_temp, compact(['advertise', "site","ip"]))->render();
            }
        }

        if ($banner_req) {
            $advertise = $this->query($site, $request, "banner",$ip);
            if ($advertise) {
                $banner = view($banner_temp, compact(['advertise', "site","ip"]))->render();
            }
        }
        if ($video_req) {
            $advertise = $this->query($site, $request, "video",$ip);
            if ($advertise) {
                $video = view($video_temp, compact(['advertise', "site","ip"]))->render();
            }
        }
        if ($site_owner->hamsan) {
            $advertise = $this->query($site, $request, "hamsan",$ip);
            if ($advertise) {
                $hamsan = view($hamsan_temp, compact(['advertise', "site","ip"]))->render();
            }
        }
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
            'video' => $video,
            'hamsan' => $hamsan,
            'site' => $site,
        ]);
    }
    public function query($site, $request, $type,$ip)
    {
        $site_owner = $site->user;
        $advertise = Advertise::where('active', 1)->whereType($type)->where("confirm", "!=", "null")->whereStatus("ready_to_show");
        $advertise->whereHas('cats', function ($query) use ($site) {
            $query->where('id', $site->cat_id);
        });
        $advertise
        ->where(function($qu){
            $qu->whereDoesntHave('actions')
            ->orWhereHas("actions", function ($q3) {
                $q3->whereDate('created_at', '=', now()->toDateString());
            }, '<', DB::raw('`limit_daily`'));
        });
        $advertise = $advertise->whereType($type)->inRandomOrder()->first();
        if ($advertise) {
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
            $exist = Action::where('ip', $action['ip'])->where('site_id', $action['site_id'])->where('advertise_id', $action['advertise_id'])->first();
            if (!$exist) {
                if ($advertise->count_type == "view") {
                    $action['main'] = 1;
                    Action::create($action);
                    if ($advertise->actions->count() >= $advertise->view_count) {
                        $advertise->update(['status' => "down"]);
                        $advertise->user->send_pattern( $$advertise->user->mobile, "3ii278gte7r1cz5", ['name' => $$advertise->user->name()]);
                    }
                }
            }
            $advertise->update(['display' => $advertise->display + 1]);
        }
        return $advertise;
    }

    public function getIp(){
        $client = new Client();
        $res = $client->get('https://api.db-ip.com/v2/free/self');
       $res= json_decode($res->getBody()->getContents(), true);
        return $res['ipAddress'];
    }
 }
