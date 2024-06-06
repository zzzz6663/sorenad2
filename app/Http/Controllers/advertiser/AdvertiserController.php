<?php

namespace App\Http\Controllers\advertiser;

use Carbon\Carbon;
use App\Models\Cat;
use App\Models\Faq;
use App\Models\Site;
use App\Models\User;
use App\Models\Group;
use App\Models\Action;
use App\Models\Chanal;
use App\Models\Course;
use App\Models\Section;
use App\Models\Setting;
use App\Rules\wordCount;
use App\Models\Advertise;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Facades\Validator;

class AdvertiserController extends Controller
{

    public function faqs(Request $request)
    {
        $user = auth()->user();

        $faqs = Faq::query();
        if ($se = session()->get("advertiser")) {
            $faqs->whereType("showman");
        } else {
            $faqs->whereType("advertiser");
        }
        $faqs = $faqs->get();
        return view('advertiser.faqs', compact(["user", "faqs"]));
    }

    public function advertiser_list(Request $request)
    {
        $user = auth()->user();
        $advertises = $user->advertises()->latest()->get();
        return view('advertiser.advertiser_list', compact(["user", "advertises"]));
    }

    public function advertise_pay(Request $request, Advertise $advertise)
    {
        $user = auth()->user();
        if ($user->id != $advertise->user_id) {
            alert()->warning("این آگهی مربوط به شما نیست ");
            return back();
        }
        if ($advertise->status != "created") {
            alert()->warning("این آگهی قبلا پرداخت شده ");
            return back();
        }
        $type = $advertise->type;
        $click = $user->click_price($type);
        $view = $user->view_price($type);
        $min_click = $user->setting_cache("chanal_advertiser_atlist_count");
        $min_sugestion_price = $user->setting_cache("chanal_advertiser_atlist_price");
        if($type=="chanal"){
            $click=$advertise->price_suggestion;
        }

        return view('advertiser.advertise_pay', compact(["user", "advertise",
         "type", "click"
         , "view"
         , "min_click"
         , "min_sugestion_price"
        ]));
    }
    public function new_advertise_site(Request $request, Advertise $advertise)
    {

        $user = auth()->user();
        $route = null;
        if ($request->isMethod("post")) {
            $type = $request->type;
            $step = $request->input('step');
            $rules = [];
            switch ($type) {
                case "app":
                    switch ($step) {
                        case '1':
                            $rules += [
                                'title' => "required|max:256",
                                'info' => "required|max:1500",
                                'landing_link1' => "required|url",
                                'landing_title1' => "required",
                                'landing_link2' => "nullable|url",
                                'landing_title2' => "nullable",
                                'landing_link3' => "nullable|url",
                                'landing_title3' => "nullable",
                                'icon' => "nullable|mimes:jpg,png,jpeg,gif|max:200",
                            ];
                            break;
                        case '2':
                            $rules += [
                                'cats' => "nullable",
                            ];
                            break;
                        case '3':
                            $rules += [
                                'count_type' => "required",
                                'limit_daily_click' => "nullable",
                                'order_count' => "required_if:count_type,view",
                                'limit_daily_view' => "nullable",
                                'pay_type' => "required_if:pay,1",
                            ];
                            break;
                    }
                    break;
                case "popup":
                    switch ($step) {
                        case '1':
                            $rules += [
                                'title' => "required",
                                'landing_link1' => "required|url",
                            ];
                            break;
                        case '2':
                            $rules += [
                                'device' => "required",
                            ];
                            break;
                        case '3':
                            $rules += [
                                'order_count' => "required|integer|min:1000",
                                'pay_type' => "required",
                            ];
                            break;
                    }
                    break;
                case "banner":
                    switch ($step) {
                        case '1':
                            $rules += [
                                'title' => "required|max:256",
                                'landing_link1' => "required|url",
                                'banner1' => "required|dimensions:width=300,min_height=160|max:1024",
                                'banner2' => "nullable|dimensions:width=800,min_height=131|max:1024",


                            ];
                            break;
                        case '2':
                            $rules += [
                                'device' => "required",
                                'cats' => "nullable",
                            ];
                            break;
                        case '3':
                            $rules += [
                                'count_type' => "required",
                                'limit_daily_click' => "nullable",
                                'order_count' => "required_if:count_type,view",
                                'limit_daily_view' => "nullable",
                                'pay_type' => "required_if:pay,1",
                            ];
                            break;
                    }
                    break;
                case "fixpost":
                    switch ($step) {
                        case '1':
                            $rules += [
                                'title' => "required|max:256",
                                'info' => "nullable|max:1500",
                                'landing_link1' => "required|url",
                                'landing_title1' => "required",
                                'call_to_action' => "required",
                                'bg_color' => "required",
                            ];
                            break;
                        case '2':
                            $rules += [
                                'cats' => "nullable",
                                'device' => "required",
                            ];
                            break;
                        case '3':
                            $rules += [
                                'count_type' => "required",
                                'limit_daily_click' => "nullable",
                                'order_count' => "required_if:count_type,view",
                                'limit_daily_view' => "nullable",
                                'pay_type' => "required_if:pay,1",
                            ];
                            break;
                    }
                    break;
                case "video":
                    switch ($step) {
                        case '1':
                            $rules += [
                                'title' => "required|max:256",
                                'landing_link1' => "required|url",
                                'landing_title1' => "required|max:40",
                                'call_to_action' => "required|max:100",
                                'video1' => "required|mimes:mp4| max:2048",
                            ];
                            break;
                        case '2':
                            $rules += [
                                'device' => "required",
                                'cats' => "nullable",
                            ];
                            break;
                        case '3':
                            $rules += [
                                'count_type' => "required",
                                'limit_daily_click' => "nullable",
                                'order_count' => "required_if:count_type,view",
                                'limit_daily_view' => "nullable",
                                'pay_type' => "required_if:pay,1",
                            ];
                            break;
                    }
                    break;
                case "text":
                    switch ($step) {
                        case '1':
                            $rules += [
                                'title' => "required|max:256",
                                'text' => 'required|max:100',
                                'landing_link1' => "required|url",
                            ];
                            break;
                        case '2':
                            $rules += [
                                'device' => "required",
                                'cats' => "nullable",
                            ];
                            break;
                        case '3':
                            $rules += [
                                'count_type' => "required",
                                'limit_daily_click' => "nullable",
                                'order_count' => "required_if:count_type,view",
                                'limit_daily_view' => "nullable",
                                'pay_type' => "required_if:pay,1",
                            ];
                            break;
                    }
                    break;

                    case "hamsan":
                        switch ($step) {
                            case '1':
                                $rules += [
                                    'title' => "required|max:25",
                                    'info' => "required|max:70",
                                    'bt_color' => "required|max:10",
                                    'landing_link1' => "required|url",
                                    'landing_title1' => "required",
                                ];
                                break;
                            case '2':
                                $rules += [
                                    'cats' => "nullable",
                                ];
                                break;
                            case '3':
                                $rules += [
                                    'count_type' => "required",
                                    'limit_daily_click' => "nullable",
                                    'order_count' => "required_if:count_type,view",
                                    'limit_daily_view' => "nullable",
                                    'pay_type' => "required",
                                ];
                                break;
                        }
                        break;

                        // switch ($step) {
                        //     case '1':
                        //         $rules += [
                        //             'title' => "required|max:256",
                        //             'text' => 'required|max:100',
                        //             'landing_link1' => "required|url",
                        //         ];
                        //         break;
                        //     case '2':
                        //         $rules += [
                        //             'device' => "required",
                        //             'cats' => "nullable",
                        //         ];
                        //         break;
                        //     case '3':
                        //         $rules += [
                        //             'count_type' => "required",
                        //             'limit_daily_click' => "nullable",
                        //             'order_count' => "required_if:count_type,view",
                        //             'limit_daily_view' => "nullable",
                        //             'pay_type' => "required_if:pay,1",
                        //         ];
                        //         break;
                        // }
                        break;


            }

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json($validator->errors());
            }
            if ($request->ajax()) {
                $data = $validator->safe()->all();
            } else {
                $data = $request->all();
            }


            $data["type"] = $type;
            $data["status"] = "created";
            $data["unit_show"] = $user->setting_cache($type . "_advertiser_show");
            $data["unit_click"] = $user->setting_cache($type . "_advertiser_click");
            $data["unit_vip_click"] = $user->setting_cache($type . "_user_vip_click");
            $data["unit_vip_show"] = $user->setting_cache($type . "_user_vip_show");
            $data["unit_normal_click"] = $user->setting_cache($type . "_user_normal_click");
            $data["unit_normal_show"] = $user->setting_cache($type . "_user_normal_show");
            $data['limit_daily'] = $request->limit_daily_view;
            if ($request->limit_daily_click) {
                $data['limit_daily'] = $request->limit_daily_click;
            }
            if (!$request->ajax()) {
                $data['advertise_id'] =  $advertise->id;
                $advertise = $user->advertises()->create($data);
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
                if ($request->hasFile('banner2')) {
                    $banner2 = $request->file('banner2');
                    $name_img = 'banner2_' . $advertise->id . '.' . $banner2->getClientOriginalExtension();
                    $banner2->move(public_path('/media/advertises/'), $name_img);
                    $data['banner2'] = $name_img;
                }
                if ($request->hasFile('video1')) {
                    $video1 = $request->file('video1');
                    $name_img = 'video1_' . $advertise->id . '.' . $video1->getClientOriginalExtension();
                    $video1->move(public_path('/media/advertises/'), $name_img);
                    $data['video1'] = $name_img;
                }
                $advertise->update($data);
                if ($request->cats) {
                    $advertise->cats()->attach($data['cats']);
                } else {
                    $advertise->cats()->attach(Cat::whereActive(1)->pluck("id")->toArray());
                }

                if (!$request->ajax()) {
                    if ($request->pay) {
                        return redirect()->route("send.pay", [$advertise->id, "pay_type" => $request->pay_type]);
                    } else {
                        return redirect()->route("advertiser.list");
                    }
                }
            }




            return response()->json([
                'status' => "ok",
                'rules' =>  $rules,
                'all' => $request->all()
            ]);
        }







        return view('advertiser.new_advertise_site', compact(["user", "advertise"]));
    }



    public function new_advertise_chanal(Request $request, Advertise $advertise)
    {

        $user = auth()->user();
        $route = null;
        $chanal_setting1 = Setting::whereName("chanal_setting1")->first()->val;
        $chanal_setting2 = Setting::whereName("chanal_setting2")->first()->val;
        $chanal_setting3 = Setting::whereName("chanal_setting3")->first()->val;
        $min_click = $user->setting_cache("chanal_advertiser_atlist_count");
        $min_sugestion_price = $user->setting_cache("chanal_advertiser_atlist_price");

        // $chanal_advertiser_atlist_count = Setting::whereName("chanal_advertiser_atlist_count")->first()->val;
        // $chanal_advertiser_atlist_price = Setting::whereName("chanal_advertiser_atlist_price")->first()->val;
        if ($request->isMethod("post")) {
            $type = $request->type;
            $step = $request->input('step');
            $rules = [];
            switch ($type) {
                case "chanal":
                    switch ($step) {
                        case '1':
                            $rules += [
                                'title' => "required|max:256",
                                'attach' => "required",
                                'landing_link1' => "required|url",
                                'landing_title1' => "required",
                                'landing_link2' => "nullable|url",
                                'landing_title2' => "nullable",
                                'info' => "nullable",
                            ];
                            break;
                        case '2':
                            $rules += [
                                'groups' => "nullable",
                                'telegram' => "nullable",
                                'ita' => "nullable",
                                'rubika' => "nullable",
                                'bale' => "nullable",
                                'instagram' => "nullable",
                                'socials' => "required",
                            ];
                            break;
                        case '3':
                            $rules += [
                                'price_suggestion' => "required|integer|min:" . $min_sugestion_price,
                                'order_count' => "required|integer|min:" . $min_click,
                                'pay_type' => "required",
                                'pay_type' => "required",
                            ];
                            break;
                    }
                    break;

            }

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json($validator->errors());
            }
            if ($request->ajax()) {
                $data = $validator->safe()->all();
            } else {
                $data = $request->all();
            }

            $data["type"] = $type;
            $data["status"] = "created";
            $data["unit_show"] = $user->setting_cache($type . "_advertiser_show");
            $data["unit_click"] = $user->setting_cache($type . "_advertiser_click");
            $data["unit_vip_click"] = $user->setting_cache($type . "_user_vip_click");
            $data["unit_vip_show"] = $user->setting_cache($type . "_user_vip_show");
            $data["unit_normal_click"] = $user->setting_cache($type . "_user_normal_click");
            $data["unit_normal_show"] = $user->setting_cache($type . "_user_normal_show");
            $data['limit_daily'] = $request->limit_daily_view;
            if($type=="chanal"){
                $data['unit_click'] = $request->price_suggestion;
            }
            if ($request->limit_daily_click) {
                $data['limit_daily'] = $request->limit_daily_click;
            }
            if (!$request->ajax()) {
                $data['advertise_id'] =  $advertise->id;
                $advertise = $user->advertises()->create($data);
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
                if ($request->hasFile('banner2')) {
                    $banner2 = $request->file('banner2');
                    $name_img = 'banner2_' . $advertise->id . '.' . $banner2->getClientOriginalExtension();
                    $banner2->move(public_path('/media/advertises/'), $name_img);
                    $data['banner2'] = $name_img;
                }
                   if ($request->hasFile('attach')) {
                    $attach = $request->file('attach');
                    $name_img = 'attach_' . $advertise->id . '.' . $attach->getClientOriginalExtension();
                    $attach->move(public_path('/media/advertises/'), $name_img);
                    $data['attach'] = $name_img;
                }
                $advertise->update($data);
                if ($request->cats) {
                    $advertise->cats()->attach($data['cats']);
                } else {
                    $advertise->cats()->attach(Cat::whereActive(1)->pluck("id")->toArray());
                }

                if ($request->groups) {
                    $advertise->groups()->attach($data['groups']);
                } else {
                    $advertise->groups()->attach(Cat::whereActive(1)->pluck("id")->toArray());
                }

                if (!$request->ajax()) {
                    if ($request->pay) {
                        return redirect()->route("send.pay", [$advertise->id, "pay_type" => $request->pay_type]);
                    } else {
                        return redirect()->route("advertiser.list");
                    }
                }
            }

            return response()->json([
                'status' => "ok",
                'rules' =>  $rules,
                'all' => $request->all()
            ]);
        }







        return view('advertiser.new_advertise_chanal', compact(["user",
        "advertise",
        "chanal_setting1",
        "chanal_setting2",
        "chanal_setting3",
        "min_click",
        // "chanal_advertiser_atlist_count",
        // "chanal_advertiser_atlist_price",
        "min_sugestion_price",
        "advertise",
    ]));
    }



    public function advertiser_new_ad_popup(Request $request, Advertise $advertise)
    {
        $user = auth()->user();
        $price = $user->view_price("popup");
        $type = "popup";
        if ($request->isMethod("post")) {
            // dd($request->ssall());
            if ($advertise->id) {
                $data['order_count'] =  $advertise->order_count;
                $data['landing_link1'] =  $advertise->landing_link1;
                $data['limit_daily'] =  $advertise->limit_daily;
                $data['title'] =  $advertise->title;
                $data['device'] =  $advertise->device;
                $data['pay_type'] =  $request->pay_type;
                $data["type"] = "popup";
            } else {
                $data = $request->validate([
                    'order_count' => "required|integer|min:1000",
                    'landing_link1' => "required|url",
                    'limit_daily_view' => "nullable",
                    'title' => "required",
                    'device' => "required",
                    'pay_type' => "required",
                ]);
                $data["type"] = "popup";
                $data["count_type"] = "view";
                $data["status"] = "created";
                $data["unit_show"] = $user->setting_cache($type . "_advertiser_show");
                $data["unit_click"] = $user->setting_cache($type . "_advertiser_click");
                $data["unit_vip_click"] = $user->setting_cache($type . "_user_vip_click");
                $data["unit_vip_show"] = $user->setting_cache($type . "_user_vip_show");
                $data["unit_normal_click"] = $user->setting_cache($type . "_user_normal_click");
                $data["unit_normal_show"] = $user->setting_cache($type . "_user_normal_show");
                $data['limit_daily'] = $request->limit_daily_view;
                if ($request->limit_daily_click) {
                    $data['limit_daily'] = $request->limit_daily_click;
                }
                $advertise = $user->advertises()->create($data);
            }

            $data['advertise_id'] =  $advertise->id;

            return redirect()->route("send.pay", ['type' => "popup", "data" => $data]);
        }

        return view('advertiser.advertiser_new_ad_popup', compact(["user", "price", "type", "advertise"]));
    }
    public function add_tiny_image(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name_img = 'file_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/media/advertises/tiny/'), $name_img);
            $data['file'] = $name_img;
        }
        return response()->json([
            'all' => $request->all(),
            'location' => asset('/media/advertises/tiny/' . $name_img)
        ]);
    }
    public function advertiser_new_ad_app(Request $request, Advertise $advertise)
    {
        $user = auth()->user();
        $click = $user->click_price('app');
        $view = $user->view_price('app');
        $type = "app";
        if ($request->isMethod("post")) {



            if ($advertise->id) {
                $data['title'] =  $advertise->title;
                $data['info'] =  $advertise->info;
                $data['landing_link1'] =  $advertise->landing_link1;
                $data['landing_title1'] =  $advertise->landing_title1;
                $data['landing_link2'] =  $advertise->landing_link2;
                $data['landing_title2'] =  $advertise->landing_title2;
                $data['landing_link3'] =  $advertise->landing_link3;
                $data['landing_title3'] =  $advertise->landing_title3;
                $data['icon'] =  $advertise->icon;
                $data['count_type'] =  $advertise->count_type;
                $data['banner1'] =  $advertise->banner1;
                $data['order_count'] =  $advertise->order_count;
                $data['order_count'] =  $advertise->order_count;
                $data['limit_daily_click'] =  $advertise->limit_daily_click;
                $data['pay_type'] =  $request->pay_type;
                $data["type"] = "app";
            } else {
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
                    'count_type' => "required",
                    'limit_daily_click' => "nullable",
                    'order_count' => "required_if:count_type,view",
                    'limit_daily_view' => "nullable",
                    'pay_type' => "required",
                    'icon' => "nullable|mimes:jpg,png,jpeg,gif|max:200",
                    'cats' => "nullable",
                ]);
                $data["type"] = "app";
                $data["status"] = "created";

                $data["unit_show"] = $user->setting_cache($type . "_advertiser_show");
                $data["unit_click"] = $user->setting_cache($type . "_advertiser_click");
                $data["unit_vip_click"] = $user->setting_cache($type . "_user_vip_click");
                $data["unit_vip_show"] = $user->setting_cache($type . "_user_vip_show");
                $data["unit_normal_click"] = $user->setting_cache($type . "_user_normal_click");
                $data["unit_normal_show"] = $user->setting_cache($type . "_user_normal_show");
                $data['limit_daily'] = $request->limit_daily_view;
                if ($request->limit_daily_click) {
                    $data['limit_daily'] = $request->limit_daily_click;
                }
                $advertise = $user->advertises()->create($data);
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
                if ($request->cats) {
                    $advertise->cats()->attach($data['cats']);
                } else {
                    $advertise->cats()->attach(Cat::whereActive(1)->pluck("id")->toArray());
                }
            }

            $data['advertise_id'] =  $advertise->id;

            return redirect()->route("send.pay", ['type' => "app", "data" => $data]);
        }
        return view('advertiser.advertiser_new_ad_app', compact(["user", "click", "view", "type", "advertise"]));
    }
    public function advertiser_new_ad_hamsan(Request $request, Advertise $advertise)
    {
        $user = auth()->user();
        $click = $user->click_price('hamsan');
        $view = $user->view_price('hamsan');
        $type = "hamsan";
        if ($request->isMethod("post")) {



            if ($advertise->id) {
                $data['title'] =  $advertise->title;
                $data['info'] =  $advertise->info;
                $data['landing_link1'] =  $advertise->landing_link1;
                $data['landing_title1'] =  $advertise->landing_title1;
                $data['landing_link2'] =  $advertise->landing_link2;
                $data['landing_title2'] =  $advertise->landing_title2;
                $data['landing_link3'] =  $advertise->landing_link3;
                $data['landing_title3'] =  $advertise->landing_title3;
                $data['icon'] =  $advertise->icon;
                $data['count_type'] =  $advertise->count_type;
                $data['banner1'] =  $advertise->banner1;
                $data['order_count'] =  $advertise->order_count;
                $data['order_count'] =  $advertise->order_count;
                $data['limit_daily_click'] =  $advertise->limit_daily_click;
                $data['pay_type'] =  $request->pay_type;
                $data["type"] = "hamsan";
            } else {
                $data = $request->validate([
                    'title' => "required|max:256",
                    'bt_color' => "required|max:10",
                    'landing_link1' => "required|url",
                    'landing_title1' => "required",
                    'count_type' => "required",

                    'limit_daily_click' => "nullable",
                    'order_count' => "required_if:count_type,view",
                    'limit_daily_view' => "nullable",
                    'pay_type' => "required",
                    'cats' => "nullable",
                ]);
                $data["type"] = "hamsan";
                $data["status"] = "created";

                $data["unit_show"] = $user->setting_cache($type . "_advertiser_show");
                $data["unit_click"] = $user->setting_cache($type . "_advertiser_click");
                $data["unit_vip_click"] = $user->setting_cache($type . "_user_vip_click");
                $data["unit_vip_show"] = $user->setting_cache($type . "_user_vip_show");
                $data["unit_normal_click"] = $user->setting_cache($type . "_user_normal_click");
                $data["unit_normal_show"] = $user->setting_cache($type . "_user_normal_show");
                $data['limit_daily'] = $request->limit_daily_view;
                if ($request->limit_daily_click) {
                    $data['limit_daily'] = $request->limit_daily_click;
                }
                $advertise = $user->advertises()->create($data);

                if ($request->hasFile('banner1')) {
                    $banner1 = $request->file('banner1');
                    $name_img = 'banner1_' . $advertise->id . '.' . $banner1->getClientOriginalExtension();
                    $banner1->move(public_path('/media/advertises/'), $name_img);
                    $data['banner1'] = $name_img;
                }

                $advertise->update($data);
                if ($request->cats) {
                    $advertise->cats()->attach($data['cats']);
                } else {
                    $advertise->cats()->attach(Cat::whereActive(1)->pluck("id")->toArray());
                }
            }

            $data['advertise_id'] =  $advertise->id;

            return redirect()->route("send.pay", ['type' => "hamsan", "data" => $data]);
        }
        return view('advertiser.advertiser_new_ad_hamsan', compact(["user", "click", "view", "type", "advertise"]));
    }
    public function advertiser_new_ad_banner(Request $request, Advertise $advertise)
    {
        $user = auth()->user();
        $click = $user->click_price("banner");
        $view = $user->view_price("banner");
        $type = "banner";
        if ($request->isMethod("post")) {
            if ($advertise->id) {
                $data['title'] =  $advertise->title;
                $data['info'] =  $advertise->info;
                $data['landing_link1'] =  $advertise->landing_link1;
                $data['banner1'] =  $advertise->banner1;
                $data['banner2'] =  $advertise->banner2;

                $data['order_count'] =  $advertise->order_count;

                $data['order_count'] =  $advertise->order_count;
                $data['limit_daily'] =  $advertise->limit_daily;


                $data['pay_type'] =  $request->pay_type;
                $data["type"] = "banner";
            } else {
                // dd($request->all());
                $data = $request->validate([
                    'title' => "required|max:256",
                    // 'info' => "required|max:1500",
                    'landing_link1' => "required|url",
                    'banner1' => "required",
                    'banner2' => "nullable",
                    'count_type' => "required",

                    'limit_daily_click' => "nullable",
                    'order_count' => "required",
                    'limit_daily_view' => "nullable",
                    'pay_type' => "required",
                    'cats' => "nullable",
                ]);
                $data["type"] = "banner";
                $data["status"] = "created";

                $data["unit_show"] = $user->setting_cache($type . "_advertiser_show");
                $data["unit_click"] = $user->setting_cache($type . "_advertiser_click");
                $data["unit_vip_click"] = $user->setting_cache($type . "_user_vip_click");
                $data["unit_vip_show"] = $user->setting_cache($type . "_user_vip_show");
                $data["unit_normal_click"] = $user->setting_cache($type . "_user_normal_click");
                $data["unit_normal_show"] = $user->setting_cache($type . "_user_normal_show");
                $data['limit_daily'] = $request->limit_daily_view;
                if ($request->limit_daily_click) {
                    $data['limit_daily'] = $request->limit_daily_click;
                }
                $advertise = $user->advertises()->create($data);
                // if ($request->hasFile('icon')) {
                //     $icon = $request->file('icon');
                //     $name_img = 'icon_' . $advertise->id . '.' . $icon->getClientOriginalExtension();
                //     $icon->move(public_path('/media/advertises/'), $name_img);
                //     $data['icon'] = $name_img;
                // }
                if ($request->hasFile('banner1')) {
                    $banner1 = $request->file('banner1');
                    $name_img = 'banner1_' . $advertise->id . '.' . $banner1->getClientOriginalExtension();
                    $banner1->move(public_path('/media/advertises/'), $name_img);
                    $data['banner1'] = $name_img;
                }
                if ($request->hasFile('banner2')) {
                    $banner2 = $request->file('banner2');
                    $name_img = 'banner2_' . $advertise->id . '.' . $banner2->getClientOriginalExtension();
                    $banner2->move(public_path('/media/advertises/'), $name_img);
                    $data['banner2'] = $name_img;
                }

                $advertise->update($data);
                if ($request->cats) {
                    $advertise->cats()->attach($data['cats']);
                } else {
                    $advertise->cats()->attach(Cat::whereActive(1)->pluck("id")->toArray());
                }
            }

            $data['advertise_id'] =  $advertise->id;

            return redirect()->route("send.pay", ['type' =>    $type, "data" => $data]);
        }
        return view('advertiser.advertiser_new_ad_banner', compact(["user", "click", "view", "type", "advertise"]));
    }
    public function advertiser_new_ad_fixpost(Request $request, Advertise $advertise)
    {
        $user = auth()->user();
        $click = $user->click_price("fixpost");
        $view = $user->view_price("fixpost");
        $type = "fixpost";
        if ($request->isMethod("post")) {
            // dd($request->all());
            if ($advertise->id) {
                $data['title'] =  $advertise->title;
                $data['info'] =  $advertise->info;
                $data['landing_link1'] =  $advertise->landing_link1;
                $data['landing_title1'] =  $advertise->landing_title1;
                $data['call_to_action'] =  $advertise->call_to_action;
                $data['count_type'] =  $advertise->count_type;
                // $data['banner1'] =  $advertise->banner1;

                $data['order_count'] =  $advertise->order_count;

                $data['order_count'] =  $advertise->order_count;
                $data['limit_daily'] =  $advertise->limit_daily;
                $data['device'] =  $advertise->device;
                $data['bg_color'] =  $advertise->bg_color;
                $data['pay_type'] =  $request->pay_type;
                $data["type"] = "fixpost";
            } else {
                $data = $request->validate([
                    'title' => "required|max:256",
                    'info' => "required|max:1500",
                    'landing_link1' => "required|url",
                    'landing_title1' => "required",
                    'call_to_action' => "required",
                    'bg_color' => "required",
                    // 'banner1' => "required",
                    'count_type' => "required",

                    'limit_daily_click' => "nullable",
                    'order_count' => "required_if:count_type,view",
                    'limit_daily_view' => "nullable",
                    'pay_type' => "required",
                    'device' => "required",
                    'cats' => "nullable",
                ]);
                $data["type"] = "fixpost";
                $data["status"] = "created";

                $data["unit_show"] = $user->setting_cache($type . "_advertiser_show");
                $data["unit_click"] = $user->setting_cache($type . "_advertiser_click");
                $data["unit_vip_click"] = $user->setting_cache($type . "_user_vip_click");
                $data["unit_vip_show"] = $user->setting_cache($type . "_user_vip_show");
                $data["unit_normal_click"] = $user->setting_cache($type . "_user_normal_click");
                $data["unit_normal_show"] = $user->setting_cache($type . "_user_normal_show");
                $data['limit_daily'] = $request->limit_daily_view;
                if ($request->limit_daily_click) {
                    $data['limit_daily'] = $request->limit_daily_click;
                }
                $advertise = $user->advertises()->create($data);
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
                if ($request->cats) {
                    $advertise->cats()->attach($data['cats']);
                } else {
                    $advertise->cats()->attach(Cat::whereActive(1)->pluck("id")->toArray());
                }
            }
            $data['advertise_id'] =  $advertise->id;
            return redirect()->route("send.pay", ['type' =>    $type, "data" => $data]);
        }
        return view('advertiser.advertiser_new_ad_fixpost', compact(["user", "click", "view", "type", "advertise"]));
    }
    public function advertiser_new_ad_text(Request $request, Advertise $advertise)
    {
        $user = auth()->user();
        $click = $user->click_price("text");
        $view = $user->view_price("text");
        $type = "text";
        if ($request->isMethod("post")) {
            // dd($request->all());



            if ($advertise->id) {
                $data['title'] =  $advertise->title;
                $data['text'] =  $advertise->text;
                $data['landing_link1'] =  $advertise->landing_link1;
                $data['order_count'] =  $advertise->order_count;
                $data['order_count'] =  $advertise->order_count;
                $data['limit_daily'] =  $advertise->limit_daily;
                $data['device'] =  $advertise->device;
                $data['pay_type'] =  $request->pay_type;
                $data["type"] = "text";
            } else {
                // dd($request->all());
                $data = $request->validate([
                    'title' => "required|max:256",
                    'text' => 'required|max:100',
                    'landing_link1' => "required|url",
                    'count_type' => "required",
                    'limit_daily_click' => "nullable",
                    'order_count' => "required_if:count_type,view",
                    'limit_daily_view' => "nullable",
                    'pay_type' => "required",
                    'device' => "required",
                    'cats' => "nullable",
                ]);
                $data["type"] = "text";
                $data["status"] = "created";

                $data["unit_show"] = $user->setting_cache($type . "_advertiser_show");
                $data["unit_click"] = $user->setting_cache($type . "_advertiser_click");
                $data["unit_vip_click"] = $user->setting_cache($type . "_user_vip_click");
                $data["unit_vip_show"] = $user->setting_cache($type . "_user_vip_show");
                $data["unit_normal_click"] = $user->setting_cache($type . "_user_normal_click");
                $data["unit_normal_show"] = $user->setting_cache($type . "_user_normal_show");
                $data['limit_daily'] = $request->limit_daily_view;
                if ($request->limit_daily_click) {
                    $data['limit_daily'] = $request->limit_daily_click;
                }
                $advertise = $user->advertises()->create($data);
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
                if ($request->cats) {
                    $advertise->cats()->attach($data['cats']);
                } else {
                    $advertise->cats()->attach(Cat::whereActive(1)->pluck("id")->toArray());
                }
            }
            $data['advertise_id'] =  $advertise->id;
            return redirect()->route("send.pay", ['type' =>     $type, "data" => $data]);
        }
        return view('advertiser.advertiser_new_ad_text', compact(["user", "click", "view", "type", "advertise"]));
    }
    public function advertiser_new_ad_video(Request $request, Advertise $advertise)
    {
        $user = auth()->user();
        $click = $user->click_price("video");
        $view = $user->view_price("video");
        $type = "video";
        if ($request->isMethod("post")) {
            // dd($request->all());



            if ($advertise->id) {
                $data['title'] =  $advertise->title;
                $data['landing_link1'] =  $advertise->landing_link1;
                $data['order_count'] =  $advertise->order_count;
                $data['order_count'] =  $advertise->order_count;
                $data['limit_daily'] =  $advertise->limit_daily;
                $data['count_type'] =  $advertise->count_type;
                $data['landing_title1'] =  $advertise->landing_title1;
                $data['call_to_action'] =  $advertise->call_to_action;
                $data['device'] =  $advertise->device;
                $data['pay_type'] =  $request->pay_type;
                $data["type"] = "video";
            } else {
                // dd($request->all());
                $data = $request->validate([
                    'title' => "required|max:256",
                    'landing_link1' => "required|url",
                    'landing_title1' => "required|max:40",
                    'call_to_action' => "required|max:100",
                    'count_type' => "required",
                    'limit_daily_click' => "nullable",
                    'order_count' => "required_if:count_type,view",
                    'limit_daily_view' => "nullable",
                    'pay_type' => "required",
                    'device' => "required",
                    'video1' => "required",
                    'cats' => "nullable",
                ]);
                $data["type"] = "video";
                $data["status"] = "created";

                $data["unit_show"] = $user->setting_cache($type . "_advertiser_show");
                $data["unit_click"] = $user->setting_cache($type . "_advertiser_click");
                $data["unit_vip_click"] = $user->setting_cache($type . "_user_vip_click");
                $data["unit_vip_show"] = $user->setting_cache($type . "_user_vip_show");
                $data["unit_normal_click"] = $user->setting_cache($type . "_user_normal_click");
                $data["unit_normal_show"] = $user->setting_cache($type . "_user_normal_show");
                $data['limit_daily'] = $request->limit_daily_view;
                if ($request->limit_daily_click) {
                    $data['limit_daily'] = $request->limit_daily_click;
                }
                $advertise = $user->advertises()->create($data);
                if ($request->hasFile('video1')) {
                    $video1 = $request->file('video1');
                    $name_img = 'video1_' . $advertise->id . '.' . $video1->getClientOriginalExtension();
                    $video1->move(public_path('/media/advertises/'), $name_img);
                    $data['video1'] = $name_img;
                }

                $advertise->update($data);
                if ($request->cats) {
                    $advertise->cats()->attach($data['cats']);
                } else {
                    $advertise->cats()->attach(Cat::whereActive(1)->pluck("id")->toArray());
                }
            }
            $data['advertise_id'] =  $advertise->id;
            return redirect()->route("send.pay", ['type' =>     $type, "data" => $data]);
        }
        return view('advertiser.advertiser_new_ad_video', compact(["user", "click", "view", "type", "advertise"]));
    }


    public function advertiser_new_ad_chanal(Request $request, Advertise $advertise)
    {
        $user = auth()->user();

        $chanal_advertiser_atlist_count = Setting::whereName("chanal_advertiser_atlist_count")->first()->val;
        $chanal_advertiser_atlist_price = Setting::whereName("chanal_advertiser_atlist_price")->first()->val;
        $min_sugestion_price = $user->setting_cache("chanal_advertiser_atlist_price");
        $min_click = $user->setting_cache("chanal_advertiser_atlist_count");
        $chanal_setting1 = Setting::whereName("chanal_setting1")->first()->val;
        $chanal_setting2 = Setting::whereName("chanal_setting2")->first()->val;
        $chanal_setting3 = Setting::whereName("chanal_setting3")->first()->val;


        $type = "chanal";
        if ($request->isMethod("post")) {



            if ($advertise->id) {
                $data['title'] =  $advertise->title;
                $data['telegram'] =  $advertise->telegram;
                $data['ita'] =  $advertise->ita;
                $data['rubika'] =  $advertise->rubika;
                $data['bale'] =  $advertise->bale;
                $data['instagram'] =  $advertise->instagram;
                $data['info'] =  $advertise->info;
                $data['landing_link1'] =  $advertise->landing_link1;
                $data['order_count'] =  $advertise->order_count;
                $data['count_type'] =  $advertise->count_type;
                $data['pay_type'] =  $request->pay_type;
                $data["type"] = "chanal";
            } else {
                // dd($request->all());
                $data = $request->validate([
                    'title' => "required|max:256",
                    'telegram' => "nullable",
                    'ita' => "nullable",
                    'rubika' => "nullable",
                    'bale' => "nullable",
                    'instagram' => "nullable",
                    'info' => "required",
                    'socials' => "required",
                    'landing_link1' => "required|url",
                    'landing_title1' => "required",
                    'landing_link2' => "nullable|url",
                    'landing_title2' => "nullable",

                    'price_suggestion' => "required|integer|min:" . $min_sugestion_price,
                    'order_count' => "required|integer|min:" . $min_click,
                    'pay_type' => "required",
                    'pay_type' => "required",
                    'groups' => "nullable",
                ]);
                $data["type"] = "chanal";
                $data["status"] = "created";
                $data["count_type"] = "click";
                $data['telegram'] =   in_array("telegram", $data['socials']) ? "on" : null;
                $data['ita'] =   in_array("ita", $data['socials']) ? "on" : null;
                $data['rubika'] =   in_array("rubika", $data['socials']) ? "on" : null;
                $data['bale'] =   in_array("bale", $data['socials']) ? "on" : null;
                $data['instagram'] =   in_array("instagram", $data['socials']) ? "on" : null;
                $data["unit_click"] = $data['price_suggestion'];
                // $data["unit_show"] = $user->setting_cache($type . "_advertiser_show");
                // $data["unit_click"] = $user->setting_cache($type . "_advertiser_click");
                $data["unit_vip_click"] = $data['price_suggestion'];
                $data["unit_normal_click"] = $data['price_suggestion'];
                // $data["unit_vip_show"] = $user->setting_cache($type . "_user_vip_show");
                // $data["unit_normal_click"] = $user->setting_cache($type . "_user_normal_click");
                // $data["unit_normal_show"] = $user->setting_cache($type . "_user_normal_show");
                $advertise = $user->advertises()->create($data);
                if ($request->hasFile('attach')) {
                    $attach = $request->file('attach');
                    $name_img = 'attach_' . $advertise->id . '.' . $attach->getClientOriginalExtension();
                    $attach->move(public_path('/media/advertises/'), $name_img);
                    $data['attach'] = $name_img;
                }

                $advertise->update($data);
                if (isset($data['groups'])) {
                    $advertise->groups()->attach($data['groups']);
                } else {
                    $advertise->groups()->attach(Group::whereActive(1)->pluck("id")->toArray());
                }
            }
            $data['advertise_id'] =  $advertise->id;
            return redirect()->route("send.pay", ['type' =>     $type, "data" => $data]);
        }
        return view('advertiser.advertiser_new_ad_chanal', compact(['chanal_setting1', 'chanal_setting2', "min_click", "min_sugestion_price", "user", "chanal_advertiser_atlist_count", "chanal_advertiser_atlist_price", "type", "advertise"]));
    }




    public function withdrawal_request(Request $request)
    {
        $user = auth()->user();
        $min_val_checkout = Setting::whereName("min_val_checkout")->first()->val;
        if ($request->isMethod("post")) {
            $data = $request->validate([
                'amount' => "required|integer|min:$min_val_checkout|max:" .   $user->balance(),
            ]);
            $withdrawal =  $user->withdrawals()->create([
                'status' => "wait_for_admin_confirm",
                'amount' => $data['amount'],
            ]);
            $user->transactions()->create([
                'status' => "wait_for_admin_confirm",
                'amount' => -1 * $data['amount'],
                'type' => "withdrawal",
                'withdrawal_id' => $withdrawal->id,
                'track' => $withdrawal->id + 1000,
            ]);

            toast()->success("درخواست شما با موفقیت ثبت شد  ");
            $user->send_pattern($user->mobile, "k4qdf4se66hu8ch", ['name' => $user->name()]);

            return redirect()->route("advertiser.withdrawal.request");
        }
        return view('advertiser.withdrawal_request', compact(["user", "min_val_checkout"]));
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
            toast()->success("اطلاعات با موفقیت ثبت شد ");
            return redirect()->route("advertiser.profile");
        }



        return view('advertiser.profile', compact(["user"]));
    }
    public function logs(Request $request)
    {
        $user = auth()->user();

        $logs = $user->logs()->latest()->get();
        return view('advertiser.logs', compact(["user", "logs"]));
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
            toast()->success("اطلاعات با موفقیت ثبت شد ");
            return redirect()->route("advertiser.change.password");
        }


        return view('advertiser.change_password', compact(["user"]));
    }
    public function add_active(Request $request, Advertise $advertise)
    {
        $active = 0;
        if ($advertise->active == 1) {
            $advertise->update(['active' => 0]);
            $active = 0;
        } else {
            $advertise->update(['active' => 1]);
            $active = 1;
        }
        return response()->json([
            'status' => "ok",
            'active' => $active,
        ]);
    }
    public function site_script(Request $request)
    {
        $user = auth()->user();
        if ($request->isMethod("post")) {
            $data = $request->validate([
                'back_popup' => "nullable",
                'float_app' => "nullable",
                'hamsan' => "nullable",
                'show_display_times' => "required",
            ]);
            $user->update($data);
            toast()->success("اطلاعات باموفقیت ذخیره شد ");
            return redirect()->route("advertiser.site.script");
        }
        return view('advertiser.site_script', compact(["user"]));
    }
    public function chanal_script(Request $request)
    {
        $user = auth()->user();
        $chanal_setting3 = Setting::whereName("chanal_setting3")->first();
        if ($request->isMethod("post")) {
            $data = $request->validate([
                'back_popup' => "nullable",
                'float_app' => "nullable",
                'hamsan' => "nullable",
                'show_display_times' => "required",
            ]);
            $user->update($data);
            toast()->success("اطلاعات باموفقیت ذخیره شد ");
            return redirect()->route("advertiser.site.script");
        }
        $advertises = Advertise::query();
        $advertises->whereType("chanal")->whereStatus("ready_to_show");
        if ($request->time) {
            $advertises->orderBy('id', $request->time);
        }

        if ($request->benefit) {
            $advertises->orderBy('unit_click', $request->benefit);
        }
        if ($request->group_id) {
            $advertises->whereHas('groups', function ($qu) use ($request) {
                $qu->where('group_id', $request->group_id);
            });
        }
        if ($request->socials) {
            $socials = $request->socials;
            if (in_array("instagram", request("socials", []))) {
                $advertises->whereRaw('instagram = "" ');
            }
            if (in_array("ita", request("socials", []))) {
                $advertises->whereRaw('ita = "" ');
            }
            if (in_array("rubika", request("socials", []))) {

                $advertises->whereRaw('rubika = "" ');
            }
            if (in_array("bale", request("socials", []))) {
                $advertises->whereRaw('bale = "" ');
            }
            if (in_array("telegram", request("socials", []))) {
                $advertises->whereRaw('telegram = "" ');
            }
        }
        // dd($request->all());
        $advertises = $advertises->get();
        return view('advertiser.chanal_script', compact(["user", "chanal_setting3", "advertises"]));
    }
    public function sites(Request $request)
    {
        $user = auth()->user();
        // dd( $user);
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
            toast()->success("سایت با موفقیت اضافه شد");
            return redirect()->route("advertiser.sites");
        }

        $sites = $user->sites;
        return view('advertiser.sites', compact(["user", "sites"]));
    }
    public function chanals(Request $request)
    {
        $user = auth()->user();
        // dd( $user);
        // dd($request->all());
        if ($request->isMethod("post")) {
            $data = $request->validate([
                'name' => "required|min:5|max:30",
                'url' =>   array(
                    'required',
                    'max:100',
                    'unique:chanals,url',
                    'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'
                ),
                'members' => "required",
                'group_id' => "required",
            ]);
            $data['status'] = "created";
            $user->chanals()->create($data);
            toast()->success("کانال با موفقیت اضافه شد");
            return redirect()->route("advertiser.chanals");
        }

        $chanals = $user->chanals;
        return view('advertiser.chanals', compact(["user", "chanals"]));
    }
    public function update_site(Request $request, Site $site)
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
            toast()->success("سایت با موفقیت اضافه شد");
            return redirect()->route("advertiser.sites");
        }

        $sites = $user->sites;
        return view('advertiser.update_site', compact(["user", "site"]));
    }
    public function update_chanal(Request $request, Chanal $chanal)
    {
        $user = auth()->user();
        if ($request->isMethod("post")) {
            $data = $request->validate([
                'name' => "required|min:5|max:30",
                'url' =>   array(
                    'required',
                    'max:100',
                    'unique:chanals,url',
                    'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'
                ),
                'members' => "required",
                'group_id' => "required",
            ]);
            $chanal->update($data);
            toast()->success("کانال با موفقیت اضافه شد");
            return redirect()->route("advertiser.chanals");
        }

        $chanals = $user->chanals;
        return view('advertiser.update_chanal', compact(["user", "chanal"]));
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
            toast()->success("اطلاعات با موفقیت ثبت شد ");
            return redirect()->route("advertiser.bank.info");
        }
        return view('advertiser.bank_info', compact(["user"]));
    }
    public function advertise_reject(Request $request, Advertise $advertise)
    {
        if ($advertise->status != "ready_to_show") {
            toast()->warning('این عملیات ممکن نیست');
            return back();
        }

        $advertise->update(['status' => 'down']);

        if ($advertise->count_type == "view") {
            $data['count'] = $advertise->order_count;
            $data['unit'] = $advertise->unit_show;
        }

        if ($advertise->count_type == "click") {
            $data['count'] = $advertise->order_count;
            $data['unit'] = $advertise->unit_click;
        }
        $data['total'] = $advertise->actions()->where("main", 1)->count();
        $data['amount'] = ($data['count'] - $data['total']) * $data['unit'];


        $transaction = $advertise->user->transactions()->create([
            'site_id' =>  '',
            'amount' =>    $data['amount'],
            'transactionId' => "8181",
            'type' => "charge",
            'pay_type' => "",
            'advertise_id' => $advertise->id,
            'status' => "payed",
        ]);
        toast()->success("شارژ با موفقیت به حساب شما برگشت");
        return back();
    }
    public function advertiser_log(Request $request)
    {
        $user = auth()->user();

        $user = auth()->user();
        $actions = Action::query();
        $actions->where("siter_id", $user->id);
        // $actions->where('main',1);
        // $actions->where('active',0);
        if ($request->site_id) {
            $actions->where('site_id', $request->site_id);
        }


        if ($request->has("priod")) {
            $actions->whereDate('created_at', '>=', Carbon::now()->subDays($request->priod));
        }

        if ($request->from) {

            // $request->from = $user->convert_date($request->from);
            $actions->where('created_at', '>=', $request->from);
        }
        if ($request->to) {
            // $request->to = $user->convert_date($request->to);
            $actions->where('created_at', '<', $request->to);
        }
        $action_log = clone   $actions;
        $actions = $actions->latest()->get();
        $transaction = $user->transactions()->whereType('clear');
        $advertises = $user->advertises;
        $time = [
            'فروردین',
            'اردیبهشت',
            'خرداد',
            'تیر',
            'مرداد',
            'شهریور',
            'مهر',
            'آبان',
            'آذر',
            'دی',
            'بهمن',
            'اسفند',
        ];
        $income = [];
        for ($i = 12; $i >= 1; $i--) {
            $log =  clone   $action_log;

            $year = jdate(date('Y-m-d'))->getYear();
            $month = $i;
            $day = 1;
            $persian_date = $year . '-' . $month . '-' . $day;
            $date_count = (new Jalalian($year, $month, $day))->getMonthDays();
            $first_month = \Morilog\Jalali\CalendarUtils::toGregorian($year, $month, $day);
            $first_month = $first_month[0] . '-' . $first_month[1] . '-' . $first_month[2];

            $end_month = \Morilog\Jalali\CalendarUtils::toGregorian($year, $month, $date_count);
            $end_month = $end_month[0] . '-' . $end_month[1] . '-' . $end_month[2];
            $log->whereDate('created_at', '>=', $first_month);
            $log->whereDate('created_at', '<=', $end_month);
            $income[] = $log->sum('site_share');
            // $end_month = \Morilog\Jalali\Jalalian::jalaliToGregorian($year, $month, $date_count, '-');
        }
        $income = array_reverse($income);


        // $time=[
        //     1,
        //     2,
        //     3,
        //     4,
        //     4,
        //     5,
        // ];
        // dd(json_encode( $time,JSON_UNESCAPED_UNICODE));
        return view('advertiser.advertiser_log', compact(["user", "actions", "advertises", "action_log", "time", 'income']));
    }
}
