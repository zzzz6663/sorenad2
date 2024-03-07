<?php

namespace App\Http\Controllers\advertiser;

use Carbon\Carbon;
use App\Models\Faq;
use App\Models\Site;
use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use App\Models\Setting;
use App\Rules\wordCount;
use App\Models\Advertise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use PHPUnit\Framework\Constraint\Count;

class AdvertiserController extends Controller
{

    public function faqs(Request $request)
    {
        $user = auth()->user();
        $faqs = Faq::all();
        return view('advertiser.faqs', compact(["user", "faqs"]));
    }

    public function advertiser_list(Request $request)
    {
        $user = auth()->user();
        $advertises = $user->advertises;
        return view('advertiser.advertiser_list', compact(["user", "advertises"]));
    }

    public function advertiser_new_ad_popup(Request $request,Advertise $advertise)
    {
        $user = auth()->user();
        $price=$user->view_price();
        if ($request->isMethod("post")) {
            // dd($request->all());
            if($advertise->id){
                $data['view_count']=  $advertise->view_count;
                $data['landing_link1']=  $advertise->landing_link1;
                $data['limit_daily_view']=  $advertise->limit_daily_view;
                $data['title']=  $advertise->title;
                $data['device']=  $advertise->device;
                $data['pay_type']=  $request->pay_type;
                $data["type"]="popup";
            }
            else{
                $data = $request->validate([
                    'view_count' => "required|integer|min:1000",
                    'landing_link1' => "required|url",
                    'limit_daily_view' => "required",
                    'title' => "required",
                    'device' => "required",
                    'pay_type' => "required",
                ]);
                $data["type"]="popup";
                $data["status"]="created";
                $advertise=$user->advertises()->create($data);
            }

            $data['advertise_id']=  $advertise->id;

            return redirect()->route("send.pay",['type'=>"popup","data"=>$data]);

        }

        return view('advertiser.advertiser_new_ad_popup', compact(["user","price"]));
    }
    public function advertiser_new_ad_app(Request $request,Advertise $advertise)
    {
        $user = auth()->user();
        $click=$user->click_price();
        $view=$user->view_price();
        if ($request->isMethod("post")) {



            if($advertise->id){
                $data['title']=  $advertise->title;
                $data['info']=  $advertise->info;
                $data['landing_link1']=  $advertise->landing_link1;
                $data['landing_title1']=  $advertise->landing_title1;
                $data['landing_link2']=  $advertise->landing_link2;
                $data['landing_title2']=  $advertise->landing_title2;
                $data['landing_link3']=  $advertise->landing_link3;
                $data['landing_title3']=  $advertise->landing_title3;
                $data['icon']=  $advertise->icon;
                $data['count_type']=  $advertise->count_type;
                $data['banner1']=  $advertise->banner1;
                $data['limit_daily_view']=  $advertise->limit_daily_view;

                $data['click_count']=  $advertise->click_count;
                $data['limit_daily_click']=  $advertise->limit_daily_click;

                $data['view_count']=  $advertise->view_count;
                $data['limit_daily_view']=  $advertise->limit_daily_view;


                $data['pay_type']=  $request->pay_type;
                $data["type"]="app";
            }
            else{
                // dd($request->all());
                $data = $request->validate([
                    'title' => "required|max:256",
                    'info' => "required|max:1500",
                    'landing_link1' => "required|url",
                    'landing_title1' => "required",
                    'landing_link2' => "nullable|url",
                    'landing_title2' => "nullable",
                    'landing_link3' => "nullable|url",
                    'landing_title3' => "nullable",
                    'icon' => "required",
                    'banner1' => "required",
                    'count_type' => "required",

                    'click_count' => "required_if:count_type,click",
                    'limit_daily_click' => "required_if:count_type,click",
                    'view_count' => "required_if:count_type,view",
                    'limit_daily_view' => "required_if:count_type,view",
                    'pay_type' => "required",
                    // 'icon' => "required|mimes:jpg,png,jpeg,gif|max:200|dimensions:width=32,height=32",
                    // 'banner1' => "required|mimes:jpg,png,jpeg,gif|max:200|dimensions:width=554,height=276",
                    'icon' => "nullable|mimes:jpg,png,jpeg,gif|max:200",
                    'banner1' => "nullable|mimes:jpg,png,jpeg,gif|max:200",
                    'cats' => "nullable",
                ]);
                $data["type"]="app";
                $data["status"]="created";

                $advertise=$user->advertises()->create($data);
                if ($request->hasFile('icon')) {
                    $icon = $request->file('icon');
                    $name_img = 'icon_' . $advertise->id . '.' . $icon->getClientOriginalExtension();
                    $icon->move(public_path('/media/advertises/'), $name_img);
                    $data['icon'] = $name_img;
                }
                if ($request->hasFile('banner1')) {
                    $banner1 = $request->file('banner1');
                    $name_img = 'banner1_' . $advertise->id . '.' . $banner1->getClientOriginalExtension();
                    $banner1->move(public_path('/media/advertises/'), $name_img);
                    $data['banner1'] = $name_img;
                }

                $advertise->update($data);
                if($request->cats){
                    $advertise->cats()->attach($data['cats']);
                }

            }

            $data['advertise_id']=  $advertise->id;

            return redirect()->route("send.pay",['type'=>"app","data"=>$data]);

        }
        return view('advertiser.advertiser_new_ad_app', compact(["user","click" ,"view"]));
    }
    public function advertiser_new_ad_banner(Request $request,Advertise $advertise)
    {
        $user = auth()->user();
        $click=$user->click_price();
        $view=$user->view_price();
        if ($request->isMethod("post")) {
            // dd($request->all());



            if($advertise->id){
                $data['title']=  $advertise->title;
                $data['info']=  $advertise->info;
                $data['landing_link1']=  $advertise->landing_link1;
                $data['banner1']=  $advertise->banner1;
                $data['limit_daily_view']=  $advertise->limit_daily_view;

                $data['click_count']=  $advertise->click_count;
                $data['limit_daily_click']=  $advertise->limit_daily_click;

                $data['view_count']=  $advertise->view_count;
                $data['limit_daily_view']=  $advertise->limit_daily_view;


                $data['pay_type']=  $request->pay_type;
                $data["type"]="banner";
            }
            else{
                // dd($request->all());
                $data = $request->validate([
                    'title' => "required|max:256",
                    // 'info' => "required|max:1500",
                    'landing_link1' => "required|url",
                    'banner1' => "required",
                    'count_type' => "required",
                    'click_count' => "required_if:count_type,click",
                    'limit_daily_click' => "required_if:count_type,click",
                    'view_count' => "required_if:count_type,view",
                    'limit_daily_view' => "required_if:count_type,view",
                    'pay_type' => "required",
                    'cats' => "nullable",
                ]);
                $data["type"]="banner";
                $data["status"]="created";

                $advertise=$user->advertises()->create($data);
                if ($request->hasFile('icon')) {
                    $icon = $request->file('icon');
                    $name_img = 'icon_' . $advertise->id . '.' . $icon->getClientOriginalExtension();
                    $icon->move(public_path('/media/advertises/'), $name_img);
                    $data['icon'] = $name_img;
                }
                if ($request->hasFile('banner1')) {
                    $banner1 = $request->file('banner1');
                    $name_img = 'banner1_' . $advertise->id . '.' . $banner1->getClientOriginalExtension();
                    $banner1->move(public_path('/media/advertises/'), $name_img);
                    $data['banner1'] = $name_img;
                }

                $advertise->update($data);
                if($request->cats){
                    $advertise->cats()->attach($data['cats']);
                }

            }

            $data['advertise_id']=  $advertise->id;

            return redirect()->route("send.pay",['type'=>"banner","data"=>$data]);

        }
        return view('advertiser.advertiser_new_ad_banner', compact(["user","click" ,"view"]));
    }
    public function advertiser_new_ad_fixpost(Request $request,Advertise $advertise)
    {
        $user = auth()->user();
        $click=$user->click_price();
        $view=$user->view_price();
        if ($request->isMethod("post")) {
            // dd($request->all());



            if($advertise->id){
                $data['title']=  $advertise->title;
                $data['info']=  $advertise->info;
                $data['landing_link1']=  $advertise->landing_link1;
                $data['landing_title1']=  $advertise->landing_title1;
                $data['call_to_action']=  $advertise->call_to_action;
                $data['count_type']=  $advertise->count_type;
                $data['banner1']=  $advertise->banner1;
                $data['limit_daily_view']=  $advertise->limit_daily_view;
                $data['click_count']=  $advertise->click_count;
                $data['limit_daily_click']=  $advertise->limit_daily_click;
                $data['view_count']=  $advertise->view_count;
                $data['limit_daily_view']=  $advertise->limit_daily_view;
                $data['device']=  $advertise->device;
                $data['pay_type']=  $request->pay_type;
                $data["type"]="fixpost";
            }
            else{
                // dd($request->all());
                $data = $request->validate([
                    'title' => "required|max:256",
                    // 'info' => "required|max:1500",
                    'landing_link1' => "required|url",
                    'landing_title1' => "required",
                    'call_to_action' => "required",
                    'banner1' => "required",
                    'count_type' => "required",
                    'click_count' => "required_if:count_type,click",
                    'limit_daily_click' => "required_if:count_type,click",
                    'view_count' => "required_if:count_type,view",
                    'limit_daily_view' => "required_if:count_type,view",
                    'pay_type' => "required",
                    'device' => "required",
                    'cats' => "nullable",
                ]);
                $data["type"]="fixpost";
                $data["status"]="created";
                $advertise=$user->advertises()->create($data);
                if ($request->hasFile('icon')) {
                    $icon = $request->file('icon');
                    $name_img = 'icon_' . $advertise->id . '.' . $icon->getClientOriginalExtension();
                    $icon->move(public_path('/media/advertises/'), $name_img);
                    $data['icon'] = $name_img;
                }
                if ($request->hasFile('banner1')) {
                    $banner1 = $request->file('banner1');
                    $name_img = 'banner1_' . $advertise->id . '.' . $banner1->getClientOriginalExtension();
                    $banner1->move(public_path('/media/advertises/'), $name_img);
                    $data['banner1'] = $name_img;
                }
                $advertise->update($data);
                if($request->cats){
                    $advertise->cats()->attach($data['cats']);
                }
            }
            $data['advertise_id']=  $advertise->id;
            return redirect()->route("send.pay",['type'=>"banner","data"=>$data]);
        }
        return view('advertiser.advertiser_new_ad_fixpost', compact(["user","click" ,"view"]));
    }
    public function advertiser_new_ad_text(Request $request,Advertise $advertise)
    {
        $user = auth()->user();
        $click=$user->click_price();
        $view=$user->view_price();
        if ($request->isMethod("post")) {
            // dd($request->all());



            if($advertise->id){
                $data['title']=  $advertise->title;
                $data['text']=  $advertise->text;
                $data['landing_link1']=  $advertise->landing_link1;
                $data['click_count']=  $advertise->click_count;
                $data['limit_daily_click']=  $advertise->limit_daily_click;
                $data['view_count']=  $advertise->view_count;
                $data['limit_daily_view']=  $advertise->limit_daily_view;
                $data['device']=  $advertise->device;
                $data['pay_type']=  $request->pay_type;
                $data["type"]="text";
            }
            else{
                // dd($request->all());
                $data = $request->validate([
                    'title' => "required|max:256",
                    // 'text' => "required|max:256",
                    'text' => ['required|max:100'],
                    // 'info' => "required|max:1500",
                    'landing_link1' => "required|url",
                    'count_type' => "required",
                    'click_count' => "required_if:count_type,click",
                    'limit_daily_click' => "required_if:count_type,click",
                    'view_count' => "required_if:count_type,view",
                    'limit_daily_view' => "required_if:count_type,view",
                    'pay_type' => "required",
                    'device' => "required",
                    'cats' => "nullable",
                ]);
                $data["type"]="text";
                $data["status"]="created";
                $advertise=$user->advertises()->create($data);
                if ($request->hasFile('icon')) {
                    $icon = $request->file('icon');
                    $name_img = 'icon_' . $advertise->id . '.' . $icon->getClientOriginalExtension();
                    $icon->move(public_path('/media/advertises/'), $name_img);
                    $data['icon'] = $name_img;
                }
                if ($request->hasFile('banner1')) {
                    $banner1 = $request->file('banner1');
                    $name_img = 'banner1_' . $advertise->id . '.' . $banner1->getClientOriginalExtension();
                    $banner1->move(public_path('/media/advertises/'), $name_img);
                    $data['banner1'] = $name_img;
                }
                $advertise->update($data);
                if($request->cats){
                    $advertise->cats()->attach($data['cats']);
                }
            }
            $data['advertise_id']=  $advertise->id;
            return redirect()->route("send.pay",['type'=>"banner","data"=>$data]);
        }
        return view('advertiser.advertiser_new_ad_text', compact(["user","click" ,"view"]));
    }
    public function advertiser_new_ad_video(Request $request,Advertise $advertise)
    {
        $user = auth()->user();
        $click=$user->click_price();
        $view=$user->view_price();
        if ($request->isMethod("post")) {
            // dd($request->all());



            if($advertise->id){
                $data['title']=  $advertise->title;
                $data['landing_link1']=  $advertise->landing_link1;
                $data['click_count']=  $advertise->click_count;
                $data['limit_daily_click']=  $advertise->limit_daily_click;
                $data['view_count']=  $advertise->view_count;
                $data['limit_daily_view']=  $advertise->limit_daily_view;
                $data['count_type']=  $advertise->count_type;
                $data['device']=  $advertise->device;
                $data['pay_type']=  $request->pay_type;
                $data["type"]="video";
            }
            else{
                // dd($request->all());
                $data = $request->validate([
                    'title' => "required|max:256",
                    'landing_link1' => "required|url",
                    'count_type' => "required",
                    'click_count' => "required_if:count_type,click",
                    'limit_daily_click' => "required_if:count_type,click",
                    'view_count' => "required_if:count_type,view",
                    'limit_daily_view' => "required_if:count_type,view",
                    'pay_type' => "required",
                    'device' => "required",
                    'video1' => "required",
                    'cats' => "nullable",
                ]);
                $data["type"]="video";
                $data["status"]="created";
                $advertise=$user->advertises()->create($data);
                if ($request->hasFile('video1')) {
                    $video1 = $request->file('video1');
                    $name_img = 'video1_' . $advertise->id . '.' . $video1->getClientOriginalExtension();
                    $video1->move(public_path('/media/advertises/'), $name_img);
                    $data['video1'] = $name_img;
                }

                $advertise->update($data);
                if($request->cats){
                    $advertise->cats()->attach($data['cats']);
                }
            }
            $data['advertise_id']=  $advertise->id;
            return redirect()->route("send.pay",['type'=>"banner","data"=>$data]);
        }
        return view('advertiser.advertiser_new_ad_video', compact(["user","click" ,"view"]));
    }
    public function withdrawal_request(Request $request)
    {
        $user = auth()->user();
        $min_val_checkout=Setting::whereName("min_val_checkout")->first()->val;
        if ($request->isMethod("post")) {
            $data = $request->validate([
                'amount' => "required|integer|min:$min_val_checkout|max:".   $user->balance(),
            ]);
            $withdrawal=  $user->withdrawals()->create([
                'status'=>"wait_for_admin_confirm",
                'amount'=>$data['amount'],
            ]);
            $user->transactions()->create([
                'status'=>"wait_for_admin_confirm",
                'amount'=>-1*$data['amount'],
                'type'=>"withdrawal",
                'withdrawal_id'=>$withdrawal->id,
                'track'=>$withdrawal->id+1000,
            ]);

            alert()->success("درخواست شما با موفقیت ثبت شد  ");
            return redirect()->route("advertiser.withdrawal.request");
        }
        return view('advertiser.withdrawal_request', compact(["user","min_val_checkout"]));
    }
    public function profile(Request $request)
    {
        $user = auth()->user();

        if ($request->isMethod("post")) {
            $data = $request->validate([
                'name' => "required",
                'family' => "required",
                'mellicode' => "required|size:10",
                'avatar' => "nullable",
            ]);

            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $name_img = 'avatar_' . $user->id . '.' . $avatar->getClientOriginalExtension();
                $avatar->move(public_path('/media/users/avatar/'), $name_img);
                $data['avatar'] = $name_img;
            }


            $user->update($data);
            alert()->success("اطلاعات با موفقیت ثبت شد ");
            return redirect()->route("advertiser.profile");
        }



        return view('advertiser.profile', compact(["user"]));
    }
    public function logs(Request $request){
        $user = auth()->user();
        $logs=$user->logs()->latest()->get();
        return view('advertiser.logs', compact(["user","logs"]));

    }
    public function change_password(Request $request)
    {
        $user = auth()->user();

        if ($request->isMethod("post")) {
            $data = $request->validate([
                'password' => "required|confirmed|min:6",
            ]);
            $data['password'] = bcrypt($data['password']);
            $user->update($data);
            alert()->success("اطلاعات با موفقیت ثبت شد ");
            return redirect()->route("advertiser.change.password");
        }


        return view('advertiser.change_password', compact(["user"]));
    }
    public function sites(Request $request)
    {
        $user = auth()->user();
        // dd($request->all());
        if ($request->isMethod("post")) {
            $data = $request->validate([
                'name' => "required|min:5|max:30",
                'site' =>   array(
                    'required',
                    'unique:sites,site',
                    'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'
                ),
                'cat_id' => "required",
            ]);
            $data['status'] = "created";
            $user->sites()->create($data);
            alert()->success("سایت با موفقیت اضافه شد");
            return redirect()->route("advertiser.sites");
        }

        $sites = $user->sites;
        return view('advertiser.sites', compact(["user", "sites"]));
    }
    public function update_site(Request $request ,Site $site)
    {
        $user = auth()->user();
        if ($request->isMethod("post")) {
            $data = $request->validate([
                'name' => "required|max:50",
                'site' =>   array(
                    'required',
                    'unique:sites,site',
                    'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'
                ),
                'cat_id' => "required",
            ]);
            $data['status'] = "created";
            $data['confirm'] = null;
            $site->update($data);
            alert()->success("سایت با موفقیت اضافه شد");
            return redirect()->route("advertiser.sites");
        }

        $sites = $user->sites;
        return view('advertiser.update_site', compact(["user", "site"]));
    }
    public function bank_info(Request $request)
    {
        $user = auth()->user();
        if ($request->isMethod("post")) {
            $data = $request->validate([
                'shaba' => "required|size:24",
                'cart' => "required|size:16",
                'account' => "required",
                'a_mellicode' => "required|size:10",
                'bank' => "required",
            ]);
            $data['confirm_bank_account'] = null;
            $user->update($data);
            alert()->success("اطلاعات با موفقیت ثبت شد ");
            return redirect()->route("advertiser.bank.info");
        }
        return view('advertiser.bank_info', compact(["user"]));
    }
}
