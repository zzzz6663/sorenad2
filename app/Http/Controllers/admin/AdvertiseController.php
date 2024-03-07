<?php

namespace App\Http\Controllers\admin;
use Carbon\Carbon;
use App\Models\User;
// use App\Notifications\SendKaveCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Advertise;

class AdvertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user=auth()->user();
        $advertises = Advertise::query();
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
        $advertises =$advertises
        // ->whereRole("customer")
        ->latest()->paginate(10);
        $customers=User::whereRole("customer")->get();
        return view('admin.advertise.all', compact(['advertises',"customers"]));
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
        // dd($request->all());
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
            $user->update(['avatar'=>$name_img]);
        }

        // اختصاص دادن سطح کاربری
        $user->assignRole($data['role']);
        alert()->success('کاربر با موفقیت ساخته شد ');
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
        return view('admin.advertise.edit', compact(['advertise']));
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
        // dd($request->all());
        $data = $request->validate([
            "title"=>"nullable",
            "info"=>"nullable",
            "text"=>"nullable",
            "landing_title1"=>"nullable",
            "landing_link1"=>"nullable",
            "landing_title2"=>"nullable",
            "landing_link2"=>"nullable",
            "landing_title3"=>"nullable",
            "landing_link3"=>"nullable",
            "limit_daily_view"=>"nullable",
            "limit_daily_click"=>"nullable",
        ]);
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

        $advertise->update($data);
        alert()->success('تبلیغ با موفقیت به روز  شد ');
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
        alert()->success('کاربر با موفقیت حذف شد ');
        return redirect()->route('user.index');
    }
    public function advertise_confirm(Advertise $advertise,Request $request)
    {
        if($advertise->status=="ready_to_confirm"){
            $advertise->update(['status'=>"ready_to_show"]);
            alert()->success("تبیغ با موفقیت تایید شد ");
        }else{
            alert()->warning("این تبلیغ قابل تایید نیست  ");

        }
            return redirect()->route("advertise.index");
    }

}
