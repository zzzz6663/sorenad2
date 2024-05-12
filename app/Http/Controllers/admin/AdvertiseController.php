<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Site;
// use App\Notifications\SendKaveCode;
use App\Models\User;
use App\Models\Advertise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Barryvdh\Debugbar\Facades\Debugbar;

class AdvertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user = auth()->user();
        $advertises = Advertise::query();
        // $advertises-> with(['actions']);
        if ($request->search) {
            $search = $request->search;
            $advertises->where('name', 'LIKE', "%{$search}%")
                ->orWhere('family', 'LIKE', "%{$search}%")
                ->orWhere('mobile', 'LIKE', "%{$search}%");
        }
        if ($request->status) {
            $advertises->where('status', $request->status);
        }
        if ($request->type) {
            $advertises->where('type', $request->type);
        }
        if ($request->user_id) {
            $advertises->where('user_id', $request->user_id);
        }
        if ($request->from) {
            $request->from = $user->convert_date($request->from);
            $advertises->where('created_at', '>', $request->from);
        }
        if ($request->to) {
            $request->to = $user->convert_date($request->to);
            $advertises->where('created_at', '<', $request->to);
        }
        $advertises = $advertises
            // ->whereRole("customer")
            ->latest()->paginate(30);
        $customers = User::whereRole("customer")->get();

        return view('admin.advertise.all', compact(['advertises', "customers"]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:256',
            'family' => 'required|max:256',
            'mobile' => 'required|max:11|unique:users,mobile',
            'personal_code' => 'required|max:11|unique:users,personal_code',
            'melli_code' => 'required|max:11|unique:users,melli_code',
            'role' => 'required',
            // 'region_id' => 'required',
            'avatar' => 'nullable',
        ]);

        $user = User::create($data);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $name_img = 'avatar_' . $user->id . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('/media/avatar/'), $name_img);
            $user->update(['avatar' => $name_img]);
        }

        // اختصاص دادن سطح کاربری
        $user->assignRole($data['role']);
          toast()->success('کاربر با موفقیت ساخته شد ');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Advertise $advertise)
    {
        return view('admin.advertise.show', compact(['advertise']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Advertise $advertise)
    {


        $site = Site::latest()->first();
        $price = 0;
        return view('admin.advertise.edit', compact(['advertise', "site", "price"]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertise $advertise)
    {
        // dump($advertise->type);
        // dd($request->all());

        switch ($advertise->type) {
            case "hamsan":
                $data = $request->validate([
                    'title' => "required|max:256",
                    'bt_color' => "required|max:10",
                    'landing_link1' => "required|url",
                    'landing_title1' => "required",
                    'cats' => "nullable",
                ]);
                break;
       case "chanal":
                $data = $request->validate([
                    'title' => "required|max:256",
                    'telegram' => "nullable",
                    'ita' => "nullable",
                    'rubika' => "nullable",
                    'bale' => "nullable",
                    'instagram' => "nullable",
                    'info' => "required",
                    'landing_link1' => "required|url",
                    'landing_title1' => "required",
                    'landing_link2' => "nullable|url",
                    'landing_title2' => "nullable",
                ]);
                break;


                $data = $request->validate([
                    "title" => "required",
                    "info" => "required",
                    "device" => "required",
                    "bg_color" => "required",
                    "landing_title1" => "required",
                    "landing_link1" => "required",
                    "call_to_action" => "required",
                ]);
                break;
            case "text":
                $data = $request->validate([
                    "title" => "required",
                    "text" => "required",
                    "landing_link1" => "required",
                ]);
                break;
            case "banner":
                $data = $request->validate([
                    "title" => "required",
                    "landing_link1" => "required",
                    "banner1" => "required",
                    "banner1" => "nullable",
                    "banner2" => "nullable",
                ]);
                break;
            case "app":
                $data = $request->validate([
                    "title" => "required",
                    "info" => "required",
                    "landing_link1" => "required",
                    "landing_title1" => "required",
                    "landing_link2" => "required",
                    "landing_title2" => "required",
                    "landing_link3" => "required",
                    "landing_title3" => "required",
                ]);



                break;
            case "popup":
                $data = $request->validate([
                    "title" => "required",
                    "device" => "required",
                    "landing_link1" => "required",
                ]);
                break;
                 case "video":
                $data = $request->validate([
                    "title" => "required",
                    "call_to_action" => "required",
                    "landing_link1" => "required",
                    "landing_title1" => "required",
                ]);
                break;
        }

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

        if ($request->hasFile('attach')) {
            $attach = $request->file('attach');
            $name_img = 'attach_' . $advertise->id . '.' . $attach->getClientOriginalExtension();
            $attach->move(public_path('/media/advertises/'), $name_img);
            $data['attach'] = $name_img;
        }

        if ($request->cats) {
            $advertise->cats()->sync($request->cats);
        }
   if ($request->groups) {
            $advertise->groups()->sync($request->groups);
        }



        $advertise->update($data);
          toast()->success('تبلیغ با موفقیت به روز  شد ');
        return redirect()->route('advertise.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
          toast()->success('کاربر با موفقیت حذف شد ');
        return redirect()->route('user.index');
    }
    public function advertise_confirm(Advertise $advertise, Request $request)
    {
        if ($advertise->status == "ready_to_confirm") {
            $advertise->update(['status' => "ready_to_show", "confirm" => Carbon::now()]);
              toast()->success("تبلیغ با موفقیت تایید شد ");
            $advertise->user->send_pattern($advertise->user->mobile, "k4qdf4se66hu8ch", ['name' => $advertise->user->name()]);
            // $advertise->user->send_pattern(  $advertise->user->mobile, "dvykkxdfbv9gj8x", ['name' => $advertise->user->name()]);
            // Cache::put('advertise', Advertise::where('active', 1)->where("confirm", "!=", "null")->whereStatus("ready_to_show"));
        } else {
              toast()->warning("این تبلیغ قابل تایید نیست  ");
        }
        return redirect()->route("advertise.index");
    }
}
