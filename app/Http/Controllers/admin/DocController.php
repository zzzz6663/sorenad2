<?php

namespace App\Http\Controllers\admin;
use Carbon\Carbon;
use App\Models\Doc;
// use App\Notifications\SendKaveCode;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $docs = Doc::query();
        // if ($request->search) {
        //     $search = $request->search;
        //     $docs->where('name', 'LIKE', "%{$search}%")
        //         ->orWhere('family', 'LIKE', "%{$search}%")
        //         ->orWhere('mobile', 'LIKE', "%{$search}%");
        // }

         $user=auth()->user();
        if ($request->from) {
            $request->from = $user->convert_date($request->from);
            $docs->where('submited', '>', $request->from);
        }
        if ($request->to) {
            $request->to = $user->convert_date($request->to);
            $docs->where('submited', '<', $request->to);
        }
        $docs = $docs->orderBy('submited', 'DESC')->paginate(10);
        return view('admin.doc.all', compact(['docs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts=Account::whereActive(1)->get();
        return view('admin.doc.create',compact(['accounts']));
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
            'submited' => 'required',
            'debt_id' => 'required|different:demand_id',
            'demand_id' => 'required',
            'debt_price' => 'required',
            // 'demand_price' => 'required',
            'attach' => 'nullable',
            'info' => 'nullable',
        ]);
        $user=auth()->user();
        // dd( $data);
        $data['demand_price']=$data['debt_price'];
        $data['submited']=$user->convert_date($data['submited']);
        $debt=Account::find($data['debt_id']);
        if(!$debt){
            $debt=$user->accounts()->create(['name'=>$data['debt_id']]);
            $data['debt_id']=$debt->id;
        }
        $demand=Account::find($data['demand_id']);
        if(!$demand){
            $demand=$user->accounts()->create(['name'=>$data['demand_id']]);
            $data['demand_id']=$demand->id;
        }
       $docs= $user->docs()->create($data);
            if ($request->hasFile('attach')) {
            $attach = $request->file('attach');
            $name_img = 'attach_' . $docs->id . '.' . $attach->getClientOriginalExtension();
            $attach->move(public_path('/media/attach/'), $name_img);
        $docs->update(['attach'=>$name_img]);

        }

        alert()->success('سند با موفقیت ساخته شد ');
        return redirect()->route('doc.index');
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
    public function edit(Request $request, Doc $doc)
    {
        $accounts=Account::whereActive(1)->get();
        return view('admin.doc.edit', compact(['doc',"accounts"]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doc $doc)
    {
        $data = $request->validate([
            'submited' => 'required',
            'debt_id' => 'required|different:demand_id',
            'demand_id' => 'required',
            'debt_price' => 'required',
            // 'demand_price' => 'required',
            'attach' => 'nullable',
            'info' => 'nullable',
        ]);
        $user=auth()->user();
        // dd( $data);
        $data['demand_price']=$data['debt_price'];
        $data['submited']=$user->convert_date($data['submited']);
        $debt=Account::find($data['debt_id']);
        if(!$debt){
            $debt=$user->accounts()->create(['name'=>$data['debt_id']]);
            $data['debt_id']=$debt->id;
        }
        $demand=Account::find($data['demand_id']);
        if(!$demand){
            $demand=$user->accounts()->create(['name'=>$data['demand_id']]);
            $data['demand_id']=$demand->id;
        }
        $doc->update($data);

            if ($request->hasFile('attach')) {
            $attach = $request->file('attach');
            $name_img = 'attach_' . $doc->id . '.' . $attach->getClientOriginalExtension();
            $attach->move(public_path('/media/attach/'), $name_img);
        $doc->update(['attach'=>$name_img]);

        }
        alert()->success('سند با موفقیت به روز  شد ');
        return redirect()->route('doc.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doc $doc)
    {
        $doc->delete();
        alert()->success('سند با موفقیت حذف شد ');
        return redirect()->route('doc.index');
    }

    public function download(Request $request ){
        $name=$request->name;
        return response()->download(public_path('/media/attach/'.$name));

    }
    public function update_serial(Request $request,Doc $doc ){
        $user=auth()->user();
        $doc->update([
            'status'=>"submited"
            ,"serial"=>$request->serial
            ,"approved_id"=>$user->id
        ]);
        return response()->json([
            'status'=>"ok",
            'all'=>$request->all(),
        ]);;

    }

}
