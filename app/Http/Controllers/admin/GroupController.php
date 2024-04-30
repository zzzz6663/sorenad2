<?php

namespace App\Http\Controllers\admin;
use Carbon\Carbon;
use App\Models\Group;
// use App\Notifigroupions\SendKaveCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $groups = Group::query();
        // if ($request->search) {
        //     $search = $request->search;
        //     $groups->where('name', 'LIKE', "%{$search}%")
        //         ->orWhere('family', 'LIKE', "%{$search}%")
        //         ->orWhere('mobile', 'LIKE', "%{$search}%");
        // }

        $groups = $groups
        ->latest()->paginate(10);
        return view('admin.group.all', compact(['groups']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.group.create');
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
        $user=auth()->user();
        $data['user_id']=$user->id;
       Group::create($data);
        alert()->success('دسته بندی  با موفقیت ساخته شد ');
        return redirect()->route('group.index');
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
    public function edit(Request $request, Group $group)
    {
        return view('admin.group.edit', compact(['group']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $data = $request->validate([
            'name' => 'required|max:256',
            'active' => 'required',
        ]);
        $group->update($data);
        alert()->success('دسته بندی  با موفقیت به روز  شد ');
        return redirect()->route('group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();
        alert()->success('دسته بندی  با موفقیت حذف شد ');
        return redirect()->route('group.index');
    }
  public function active_group(Group $group)
    {

        // dd($group);
        // $group->update(['deleted_at'=>null]);
        $group->restore();
        // group::onlyTrashed()->where('id', $group->id)->restore();

        alert()->success('دسته بندی  با موفقیت فعال شد ');
        return redirect()->route('group.index');
    }

}
