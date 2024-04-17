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

    public function getUserIpAddr()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        return request()->ip();
    }



    public function test(Request $request)
    {
        // return response()->json([
        //     'status' => "noسk",
        // ]);


// echo $res->getStatusCode(); // 200
// echo $res->getBody(); // { "type": "User", ....


        // $users = Cache::rememberForever('users', function () {
        //     returnd User::all();
        // });

        $machin=$request->header('User-Agent');
        $css = response()->make(asset('/css/css_add.css'));
        $css = asset('/css/css_add.css');
        $ip = $this->getUserIpAddr();
        $domin = $request->domin;
        $device = $request->device;
        $fixpost_req = $request->fixpost;
        $app_temp = ("admin.add_temp.app");
        $fixpost_temp = ("admin.add_temp.fixpost");
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
        ]);
    }
    public function query($site, $request, $type,$ip)
    {
        // dddggg
        $site_owner = $site->user;


        // $advertise=  Cache::get('advertise', function() {
        //     return Advertise::where('active', 1)->where("confirm", "!=", "null")->whereStatus("ready_to_show");
        // });
        $advertise = Advertise::where('active', 1)->whereType($type)->where("confirm", "!=", "null")->whereStatus("ready_to_show");
        $advertise->whereHas('cats', function ($query) use ($site) {
            $query->where('id', $site->cat_id);
        });
        $advertise->where(function($qu){
            // $qu->doesntHave('actions')
            $qu->whereDoesntHave('actions')
            ->orWhereHas("actions", function ($q3) {
                $q3->whereDate('created_at', '=', now()->toDateString());
            //     // $q3->whereDate('created_at',"=",  Carbon::today())
            //     // ->select('advertise_id')->groupBy('advertise_id')->havingRaw('COUNT(*) < advertises.limit_daily');
            //     $today = now()->toDateString();
            //     $q3->whereDate('created_at', $today)
            //     ->selectRaw('advertise_id, COUNT(*) as action_count')
            //     ->groupBy('advertise_id')
            //     ->havingRaw('action_count < advertises.limit_daily');
            }, '<', DB::raw('`limit_daily`'));
        });


        // $posts = Post::whereHas('comments', function($query) {
        //     $query->whereDate('created_at', '=', now()->toDateString());
        // })->where(function($query) {
        //     $query->where('limit', '<', 5)
        //           ->orWhereNull('limit');
        // })->get();


        // $posts = Post::whereHas('comments', function($query) {
        //     $query->whereDate('created_at', '=', now()->toDateString());
        // }, '<', DB::raw('`limit_daily`'))->get();

        // $posts = Post::whereHas('comments', function($query) {
        //     $query->whereDate('created_at', '=', now()->toDateString());
        // }, '<', DB::raw('`limit`'))->get();

//         $today = now()->toDateString();

// $posts = Post::whereHas('comments', function ($query) use ($today) {
//     $query->whereDate('created_at', $today)
//           ->selectRaw('post_id, COUNT(*) as comment_count')
//           ->groupBy('post_id')
//           ->havingRaw('comment_count < posts.limit');
// })->get();



        // $posts = Post::whereHas('comments', function ($query) {
        //     $query->selectRaw('post_id, COUNT(*) as comment_count')
        //           ->groupBy('post_id')
        //           ->havingRaw('comment_count < posts.limit');
        // })->get();


        // $posts = Post::whereHas('comments', function ($query) {
        //     $query->join('posts', 'posts.id', '=', 'comments.post_id')
        //           ->select('posts.*')
        //           ->havingRaw('COUNT(*) < posts.limit');
        // })->get();


//         use App\Models\Post;

// $posts = Post::select('posts.*')
//     ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
//     ->whereDate('posts.created_at', now()->format('Y-m-d'))
//     ->groupBy('posts.id')
//     ->havingRaw('COUNT(comments.id) < posts.limit')
//     ->get();




        $advertise = $advertise
        ->whereType($type)
        ->inRandomOrder()
        ->first();
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
