<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Site;
use App\Models\User;
use App\Models\Action;
use App\Models\Course;
use App\Models\Section;
use App\Models\Setting;
use App\Models\Advertise;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use PHPUnit\Framework\Constraint\Count;
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller
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

    public function getUserIpAddr2()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    public function clear(Request $request)
    {




        return response()->json([
            'status'=>"ok"
        ]);
        Transaction::truncate();
        Advertise::truncate();
        DB::table('advertise_cat')->truncate();
        DB::table('advertise_group')->truncate();


    // $ar=[
    //     'ss'=>1
    // ];
    // $ar+=[
    //     'ss'=>1
    // ];

    // dd($ar);

        // $ads=Advertise::with(['actions'])->latest()->get();
        // dd(  $ads);
        // dump($this->getUserIpAddr());
        // dump($this->getUserIpAddr2());


        // $sum=Action::where('active', 1)->update(['active'=>0]);

        // $all_action=Action::where('active', 1)->get();;

        // $all = Action::where('active', 1);
        // $arr = $all->pluck("id")->toArray();
        // $all_action = $all->distinct()->pluck('site_id');
        // $admin = User::find(1);

        // $transaction = $admin->transactions()->create([
        //     'amount' => $all->get()->sum("admin_share"),
        //     'transactionId' => "7171",
        //     'type' => "clear",
        //     'pay_type' => "",
        //     'advertise_id' => null,
        //     'status' => "payed",
        // ]);
        // foreach ($all_action as $action) {
        //     $site_actions = Action::where("site_id", $action)->whereIn('id', $arr)->get()->sum("site_share");
        //     dump($site_actions);
        //     $site_owner = User::find($action);
        //     $transaction = $site_owner->transactions()->create([
        //         'amount' =>  $site_actions,
        //         'transactionId' => "7171",
        //         'type' => "clear",
        //         'pay_type' => "",
        //         'advertise_id' => null,
        //         'status' => "payed",
        //     ]);
        // }
        // $advertise=Advertise::find(4);
        // dd($advertise->actions);

        // // Action::whereIn('id', $arr)->update(['active' => 0]);

        //     Action::where("count_type","click")->update(['main'=>1]);

        // $now = Carbon::now()->format("H:i:s");
        // // dd($now);
        $invitedUser = new User;
        // ($invitedUser->send_pattern("09373699317", "svr5y3c1ophdnuo",['code'=>123]));
        // ($invitedUser->send_sms("09373699317", "تست"));
        $invitedUser->send_pattern( '09373699317', "4lm4k11nj3mgv8h", ['name' => "sss",'title' => "ddd"]);

        // Auth::loginUsingId(1, 'true');
        Artisan::call('cache:clear');
        Artisan::call('route:cache');
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        Artisan::call('optimize:clear');
        Artisan::call('config:clear');

        // $user=User::find(1);
        // $user->assignRole("admin");
        // Auth::loginUsingId($user->id,true);
        // $user->assignRole("admin");
        // $user->assignRole("admin");.
        // return redirect()->route('redirect');

        return 12;
    }




    public function redirect_add(Request  $request)
    {
        $user = new User();
        $action['ip'] = $user->get_ip();
        $advertise = Advertise::find($request->advertis_id);
        $site = Site::find($request->site_id);
        if ($advertise->count_type == "click" && $advertise->type!="chanal") {
            $action['count_type'] = $advertise->count_type;
            $action['advertiser_id'] = $advertise->user->id;
            $action['advertise_id'] = $advertise->id;
            $action['site'] = $site->site;
            $action['type'] = $advertise->type;
            $action['siter_id'] = $site->user->id;
            $action['site_id'] = $site->id;
            $action['signature'] = $request->signature;
            // });

            if ($site->user->vip) {
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

            if ($advertise->count_type == "click") {
                // && !Action::whereActive(1)->where("signature",$request->signature)->first()

                $exist = Action::where('ip', $action['ip'])->where('site_id', $action['site_id'])->where('advertise_id', $action['advertise_id'])->first();
                if (!$exist) {
                    $action["main"] = 1;
                    Action::create($action);
                }
                if ($advertise->actions->count() >= $advertise->order_count) {
                    $advertise->update(['status' => "down"]);
                }
            }
        }else{
           if( $advertise->type=="chanal"){
            $data['chanal_advertiser_percent']=Setting::whereName("chanal_advertiser_percent")->first()->val;
            $action['ip'] = $user->get_ip();

            $action['count_type'] = $advertise->count_type;
            $action['unit_click'] = $advertise->unit_click;
            $action['advertiser_id'] = $advertise->user->id;
            $action['advertise_id'] = $advertise->id;
            $action['type'] = $advertise->type;
            $action['signature'] = $request->signature;

            $action['admin_share'] = (  $action['unit_click']*$data['chanal_advertiser_percent'])/100;
            $action['site_share'] =    $action['unit_click']-  $action['admin_share'];
            $action['adveriser_share'] =  $action['unit_click'] * -1;


            $chanal_owner=User::find( $request->owner);
            $action['site_id']=  $chanal_owner->id;
            $exist = Action::where('ip', $action['ip'])->where('site_id', $action['site_id'])->where('advertise_id', $action['advertise_id'])->first();
            if (!$exist) {
                $action["main"] = 1;
                Action::create($action);
            }
            if ($advertise->actions->count() >= $advertise->order_count) {
                $advertise->update(['status' => "down"]);
             $advertise->user->send_pattern(   $advertise->user->mobile, "4lm4k11nj3mgv8h", ['name' =>  $advertise->user->name(),'title' =>  $advertise->title]);
             }
           }
        }
        switch ($advertise->type) {
            case "chanal":
            case "app":
                $link = $advertise["landing_link" . $request->link_number];
                return redirect()->to($link);
                break;
            case "fixpost":
                $link = $advertise["landing_link1"];
                break;
                case "text":
                    $link = $advertise["landing_link1"];
                    break;
            case "banner":
                $link = $advertise["landing_link1"];
                break;
                   case "video":
                $link = $advertise["landing_link1"];
                break;
                case "hamsan":
                    $link = $advertise["landing_link1"];
             break;
        }
        return view('advertiser.redirect_add', compact(['link']));
    }
    public function css_add(Request  $request)
    {

        $response = response()->make(asset('/css/css_add.css'));
        $response->header('Content-Type', 'text/css');
        return $response;
        return asset('/css/css_add.css');
    }
    public function redirect_google(Request  $request)
    {
        return Socialite::driver('google')->stateless()->redirect();
    }
    public function gcallback()
    {
        try {
            $goo = Socialite::driver('google')->stateless()->user();
            $user = User::whereEmail($goo->email)->first();
            if ($user) {
                Auth::loginUsingId($user->id, true);
                if ($fclass = session()->get('flink')) {
                    $fclass = Fclass::find($fclass);
                    $fclass->update(['student_id' => $user->id]);
                    $fclass->meets()->update(['student_id' => $user->id]);;
                    $teacher = User::find($fclass->user->id);
                    $teacher->create_ski_room($user);
                    session()->forget('flink');
                }
                return redirect()->route('student.dashboard');
            } else {
                //                $user=  User::create([
                //                    'email'=>$goo->email,
                //                    'name'=>$goo->name,
                //                    'level'=>'student',
                //                    'password'=>'123456'
                //                ]);

                  toast()->error('     ابتدا ثبت نام کنید ');
                return back();
            }
        } catch (\Exception $e) {
            //
              toast()->error('ارتباط با گوگل برقرار نشد ');
            return back();
        }
    }


    public function redirect()
    {
        $user = auth()->user();
        if ($user->role == "admin") {
            $route = "user.index";
        } else {
            $route = "change.panel";
        }
        return redirect()->route($route);
    }
    public function index()
    {

        return redirect()->route("login");
        return view('site.index', compact(['']));
    }
    public function login()
    {
        $user = auth()->user();
        if ($user) {
            // ddddd
            Auth::loginUsingId($user->id, true);
            return redirect()->route("redirect");
        }
        return view('auth.login', compact(['user']));
    }



    public function chek_code(Request $request)
    {
        $rnd =      session()->get("rand");
        $mobile =      session()->get("mobile");
        $user = User::whereMobile($mobile)->first();
        if ($user && $request->code == $rnd) {
            Auth::loginUsingId($user->id);
        }
        return response()->json([
            'status' => "ok",
            'all' => $request->all(),
        ]);
    }
    public function mobile_login(Request $request)
    {
        $user = auth()->user();
        if ($request->isMethod('post')) {
            $rnd = rand(10000, 99999);
            $mobile = $request->mobile;
            session()->put("rand", $rnd);
            session()->put("mobile", $mobile);
            $user = new User;
            $user->send_pattern($mobile, "svr5y3c1ophdnuo", ['code' => $rnd]);
            return response()->json([
                'code' => $rnd,
                'all' => $request->all(),
            ]);
        }
        return view('auth.mobile_login', compact(['user']));
    }
    public function register(Request $request)
    {
        $user = auth()->user();
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'name' => "required",
                'family' => "required",
                'mobile' => "required|unique:users,mobile",
                'password' => 'required|confirmed|min:6',
            ]);
            $data['role'] = "customer";
            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);
            $user->assignRole("customer");
              toast()->success("حساب شما با موفقیت ثبت شد ");
            return redirect()->route("login");
        }
        // if (Hash::check($request->password, $exist_user->password)) {
        // $data['password'] = bcrypt($data['password']);
        return view('auth.register', compact(['user']));
    }
    public function logout()
    {

        Auth::logout();
        return redirect('/');
    }

    public function download(Request $request)
    {

        return response()->download(($request->path));;
    }
    public function change_panel(Request $request)
    {
        $advertiser = session()->get("advertiser");
        if ($advertiser) {
            session()->forget("advertiser");
        } else {
            session()->put("advertiser", 1);
        }

        if ($advertiser == 1) {
            return redirect()->route("customer.log");;
        } else {
            return redirect()->route("advertiser.log");;
        }

        return back();;
    }

    public function check_login(Request $request)
    {
        $data = $request->validate([
            'mobile' => 'required',
            'password' => 'required',
        ]);
        $user = User::whereMobile($request->mobile)->whereIn('role', ['admin', "customer"])->first();
        //    $user->assignRole('admin')
        // dd(Hash::check($request->password, $user->password));
        if (!$user) {
              toast()->error('   اطلاعات ارسال شده صحیح نمی باشد');
            return back();
        }
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, true);
            // dd($request->all());
            if ($request->type=="advertiser") {
                session()->put("advertiser", 1);

            } else {
                session()->forget("advertiser");

            }
              toast()->success('   ورود با موفقیت انجام شد');
            return redirect()->route('redirect');
        } else {
              toast()->error('   اطلاعات ارسال شده صحیح نمی باشد');
            return back();
        }
    }



    public function send_sms(Request $request)
    {
        $user = auth()->user();
        $rand = rand(1000, 9999);
        $mobile = $request->mobile;
        session()->put("mobile", $mobile);
        session()->put("rand", $rand);


        $user = User::whereMobile($mobile)->first();
        if (!$user) {
            $user = User::create([
                "mobile" => $mobile,
                "role" => "student",
            ]);
            $user->assignRole("student");
        }

        return response()->json([
            'rand' => $rand,
            'mobile' => $mobile,
            'status' => "ok",
            'all' => $request->all()
        ]);
    }
    public function check_code(Request $request)
    {
        $user = auth()->user();
        $code = $request->code;
        $rand =  session()->get("rand");
        $mobile =  session()->get("mobile");
        $user = User::whereMobile($mobile)->first();
        $status = "nok";
        if ($code == $rand) {
            $status = "ok";
            Auth::loginUsingId($user->id, true);
        }
        return response()->json([
            'status' => $status,
            'rand' => $rand,
            'code' => $code,
            'all' => $request->all()
        ]);
    }
    public function courses(Request $request)
    {
        $user = auth()->user();
        $courses = Course::whereActive(1)->get();
        return view('site.courses', compact(['user', "courses"]));
    }
    public function single_course(Request $request, $slug, Section $section)
    {
        $course = Course::whereSlug($slug)->first();
        return view('site.single_course', compact(['course', "section"]));
    }
}
