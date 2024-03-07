<?php

namespace App\Http\Controllers\admin;
use Carbon\Carbon;
use App\Models\Faq;
// use App\Notifications\SendKaveCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $faqs = Faq::query();
        // if ($request->search) {
        //     $search = $request->search;
        //     $faqs->where('name', 'LIKE', "%{$search}%")
        //         ->orWhere('family', 'LIKE', "%{$search}%")
        //         ->orWhere('mobile', 'LIKE', "%{$search}%");
        // }

        $faqs = $faqs
        ->latest()->paginate(10);
        return view('admin.faq.all', compact(['faqs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.faq.create');
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
            'title' => 'required|max:256',
            'content' => 'required',
        ]);
        $user=auth()->user();
        $data['user_id']=$user->id;
       faq::create($data);
        alert()->success('سوال با موفقیت ساخته شد ');
        return redirect()->route('faq.index');
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
    public function edit(Request $request, faq $faq)
    {
        return view('admin.faq.edit', compact(['faq']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, faq $faq)
    {
        $data = $request->validate([
            'title' => 'required|max:256',
            'content' => 'required',
        ]);
        $faq->update($data);
        alert()->success('سوال با موفقیت به روز  شد ');
        return redirect()->route('faq.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(faq $faq)
    {
        $faq->delete();
        alert()->success('سوال با موفقیت حذف شد ');
        return redirect()->route('faq.index');
    }
  public function active_faq(faq $faq)
    {

        // dd($faq);
        // $faq->update(['deleted_at'=>null]);
        $faq->restore();
        // faq::onlyTrashed()->where('id', $faq->id)->restore();

        alert()->success('سوال با موفقیت فعال شد ');
        return redirect()->route('faq.index');
    }

}
