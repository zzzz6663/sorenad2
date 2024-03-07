<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use PHPUnit\Framework\Constraint\Count;

class HomeController extends Controller
{
    public function clear()
    {
        // dump(bcrypt(1212));




        // $now = Carbon::now()->format("H:i:s");
        // // dd($now);
        // $invitedUser = new User;
        // ($invitedUser->send_pattern("09373699317", "svr5y3c1ophdnuo",['code'=>123]));
        // ($invitedUser->send_sms("09373699317", "تست"));

        // Auth::loginUsingId(1, 'true');
        Artisan::call('cache:clear');
        Artisan::call('route:cache');
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        Artisan::call('optimize:clear');
        Artisan::call('config:clear');

        $user=User::find(1);
        // $user->assignRole("admin");
        Auth::loginUsingId($user->id,true);
        // $user->assignRole("admin");
        return 12;
    }

    public function redirect()
    {
        $user=auth()->user();
        if($user->role=="admin"){
            $route="user.index";
        }else{
            $route="advertiser.faqs";
        }
        alert()->success("وود با موفقیت انجام شد ");
        return redirect()->route($route);
    }
    public function index()
    {

        return redirect()->route("login");
        return view('site.index', compact(['']));
    }
    public function login()
    {
        $user=auth()->user();
        if($user){
            // ddddd
        Auth::loginUsingId($user->id,true);
            return redirect()->route("redirect");
        }
        return view('auth.login', compact(['user']));
    }



    public function chek_code(Request $request)
    {
        $rnd=      session()->get("rand");
        $mobile=      session()->get("mobile");
        $user=User::whereMobile($mobile)->first();
        if($user && $request->code==$rnd){
            Auth::loginUsingId( $user->id);

        }
        return response()->json([
            'status'=>"ok",
            'all'=>$request->all(),
        ]);
    }
    public function mobile_login(Request $request)
    {
        $user = auth()->user();
        if ($request->isMethod('post')) {
            $rnd=rand ( 10000 , 99999 );
            $mobile=$request->mobile;
            session()->put("rand",$rnd);
            session()->put("mobile",$mobile);
            $user= new User;
        $user->send_pattern( $mobile, "svr5y3c1ophdnuo",['code'=>            $rnd]);

            return response()->json([
                'code'=>$rnd,
                'all'=>$request->all(),
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
            alert()->success("حساب شما با موفقیت ثبت شد ");
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

    public function download(Request $request )
    {

        return response()->download(($request->path));
        ;
    }
    public function change_panel(Request $request )
    {
        $advertiser=session()->get("advertiser");
        if( $advertiser){
            session()->forget("advertiser");
        }else{
            session()->put("advertiser",1);
        }


        return back();
        ;
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
            alert()->error('   اطلاعات ارسال شده صحیح نمی باشد');
            return back();
        }
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, true);
            alert()->success('   ورود با موفقیت انجام شد');
            return redirect()->route('redirect');
        } else {
            alert()->error('   اطلاعات ارسال شده صحیح نمی باشد');
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
