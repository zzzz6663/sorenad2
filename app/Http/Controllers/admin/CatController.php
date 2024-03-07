<?php

namespace App\Http\Controllers\admin;
use Carbon\Carbon;
use App\Models\Cat;
// use App\Notifications\SendKaveCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cats = Cat::query();
        // if ($request->search) {
        //     $search = $request->search;
        //     $cats->where('name', 'LIKE', "%{$search}%")
        //         ->orWhere('family', 'LIKE', "%{$search}%")
        //         ->orWhere('mobile', 'LIKE', "%{$search}%");
        // }

        $cats = $cats
        ->latest()->paginate(10);
        return view('admin.cat.all', compact(['cats']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.cat.create');
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
       cat::create($data);
        alert()->success('دسته بندی  با موفقیت ساخته شد ');
        return redirect()->route('cat.index');
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
    public function edit(Request $request, Cat $cat)
    {
        return view('admin.cat.edit', compact(['cat']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cat $cat)
    {
        $data = $request->validate([
            'name' => 'required|max:256',
            'active' => 'required',
        ]);
        $cat->update($data);
        alert()->success('دسته بندی  با موفقیت به روز  شد ');
        return redirect()->route('cat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(cat $cat)
    {
        $cat->delete();
        alert()->success('دسته بندی  با موفقیت حذف شد ');
        return redirect()->route('cat.index');
    }
  public function active_cat(cat $cat)
    {

        // dd($cat);
        // $cat->update(['deleted_at'=>null]);
        $cat->restore();
        // cat::onlyTrashed()->where('id', $cat->id)->restore();

        alert()->success('دسته بندی  با موفقیت فعال شد ');
        return redirect()->route('cat.index');
    }

}
