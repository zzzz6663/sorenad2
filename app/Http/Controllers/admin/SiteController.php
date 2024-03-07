<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
// use App\Notifisiteions\SendKaveCode;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    /**
     * Display a listidng of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $sites = Site::query();
        // ssssss
        // if ($request->search) {
        //     $search = $request->search;
        //     $sites->where('name', 'LIKE', "%{$search}%")
        //         ->orWhere('family', 'LIKE', "%{$search}%")
        //         ->orWhere('mobile', 'LIKE', "%{$search}%");
        // }
        if ($request->search) {
            $search = $request->search;
            $sites->where('name', 'LIKE', "%{$search}%")
                ->orWhere('site', 'LIKE', "%{$search}%");
        }

        // if ($request->vip) {
        //     $sites->where('vip', $request->vip);
        // }
        if ($request->status) {
            $sites->where('status', $request->status);
        }

        if ($request->user_id) {
            $sites->where('user_id', $request->user_id);
        }
        if ($request->from) {
            $request->from = $user->convert_date($request->from);
            $sites->where('created_at', '>', $request->from);
        }
        if ($request->to) {
            $request->to = $user->convert_date($request->to);
            $sites->where('created_at', '<', $request->to);
        }
        $sites = $sites
            ->latest()->paginate(10);
        $customers = User::whereRole("customer")->whereHas("sites", function ($query) {
        })->get();
        return view('admin.site.all', compact(['sites', "customers"]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.site.create');
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
            'active' => 'required',
        ]);
        $user = auth()->user();
        $data['user_id'] = $user->id;
        site::create($data);
        alert()->success('دسته بندی  با موفقیت ساخته شد ');
        return redirect()->route('site.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, site $site)
    {
        return view('admin.site.edit', compact(['site']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, site $site)
    {
        $data = $request->validate([
            'name' => 'required|max:256',
            'active' => 'required',
        ]);
        $site->update($data);
        alert()->success('دسته بندی  با موفقیت به روز  شد ');
        return redirect()->route('site.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(site $site)
    {
        $site->delete();
        alert()->success('دسته بندی  با موفقیت حذف شد ');
        return redirect()->route('site.index');
    }
    public function site_confirm(Site $site, Request $request)
    {

        // dd($site);
        if ($request->isMethod("post")) {
            $data = $request->validate([
                'status' => "required",
                'reason' => "required",
            ]);
            $site->update(['confirm' => Carbon::now(), 'status' => $data['status'],"reason"=>$data['reason']]);
            if ($data['status'] == "rejected") {
                $site->user->logs()->create([
                    'type' => "reject_site",
                    'site_id' => $site->id,
                ]);
            } else {
                $site->user->logs()->create([
                    'type' => "confirm_site",
                    'site_id' => $site->id,
                ]);
            }
            alert()->success('اطلاعات با موفقیت ثبت شد  ');

            return redirect()->route('site.index');
        }


        return view('admin.site.site_confirm', compact(['site']));
    }
}
