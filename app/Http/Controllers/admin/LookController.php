<?php

namespace App\Http\Controllers\admin;
use Carbon\Carbon;
use App\Models\Look;
// use App\Notifications\SendKaveCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $looks =Look::query();
        // if ($request->search) {
        //     $search = $request->search;
        //     $looks->where('name', 'LIKE', "%{$search}%")
        //         ->orWhere('family', 'LIKE', "%{$search}%")
        //         ->orWhere('mobile', 'LIKE', "%{$search}%");
        // }

        $user=auth()->user();
        // dd( $user);

        if($user->role=="inspector"){
            $looks->where("user_id",$user->id);
        }
        $looks = $looks
        ->latest()->paginate(10);
        return view('admin.look.all', compact(['looks']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.look.create');
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
            "name" => "required|max:50",
            "personal_code" => "required|max:50",
            "years_of_service" => "required|max:50",
            "degree" => "required|max:50",
            "basis_of_teaching" => "required|max:50",
            "student_statistics" => "required|max:50",
            "region_id" => "required|max:50",
            "school_name" => "required|max:50",
            "mobile" => "required|max:50",
            "look_date" => "required|max:50",
            "pass_priod" => "required|max:50",
            "units_q1_val" => "required|max:10",
            "units_q2_val" => "required|max:10",
            "units_q3_val" => "required|max:10",
            "units_q4_val" => "required|max:10",
            "units_q5_val" => "required|max:10",
            "units_q6_val" => "required|max:10",
            "units_q7_val" => "required|max:10",
            "units_q8_val" => "required|max:10",
            "units_q9_val" => "required|max:10",
            "units_q10_val" => "required|max:10",
            "units_q11_val" => "required|max:10",
            "units_q12_val" => "required|max:10",
            "units_q13_val" => "required|max:10",
            "units_q14_val" => "required|max:10",
            "units_q15_val" => "required|max:10",
            "units_q16_val" => "required|max:10",
            "units_q17_val" => "required|max:10",
            "units_q18_val" => "required|max:10",
            "units_q19_val" => "required|max:10",
            "units_q20_val" => "required|max:10",
            "creative" => "required",
            "problem" => "required",
            "visitors" => "nullable",
            // "visitor1_name" => "required|max:50",
            // "visitor1_val" => "required|max:50",
            // "visitor2_name" => "required|max:50",
            // "visitor2_val" => "required|max:50",

        ]);
        // dd( $data);
        $data['total_score']=0;
        $user=auth()->user();
        $data['status']="created";
        $data['look_date']=$user->convert_date(   $data['look_date']);
        for($i=1;$i<21;$i++){
            $data["units_q".$i."_score"]=$user->check_score_axis2("units_q".$i)*(int)$data["units_q".$i."_val" ];
            $data['total_score']+=$data["units_q".$i."_score"];
        }
        $data['performance_percentage']=floor(($data['total_score']*100)/140);
        // dd($data);
       $visit= $user->looks()->create($data);
        if($request->file('attaches')){
            foreach ($request->file('attaches') as $file) {
                $name_img = 'attach_' . $visit->id . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/media/visit/'), $name_img);
             $gg= $visit->attaches()->create(['user_id'=>$user->id,"name"=>$name_img]);
            }
        }
        alert()->success('بازدید با موفقیت ساخته شد ');
        return redirect()->route('look.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Look $look)
    {
        return view('admin.look.show', compact(['look']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Look $look)
    {
        return view('admin.look.edit', compact(['look']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Look $look)
    {
        $data = $request->validate([
            "name" => "required|max:50",
            "personal_code" => "required|max:50",
            "years_of_service" => "required|max:50",
            "degree" => "required|max:50",
            "basis_of_teaching" => "required|max:50",
            "student_statistics" => "required|max:50",
            "region_id" => "required|max:50",
            "school_name" => "required|max:50",
            "mobile" => "required|max:50",
            "look_date" => "required|max:50",
            "pass_priod" => "required|max:50",
            "units_q1_val" => "required|max:10",
            "units_q2_val" => "required|max:10",
            "units_q3_val" => "required|max:10",
            "units_q4_val" => "required|max:10",
            "units_q5_val" => "required|max:10",
            "units_q6_val" => "required|max:10",
            "units_q7_val" => "required|max:10",
            "units_q8_val" => "required|max:10",
            "units_q9_val" => "required|max:10",
            "units_q10_val" => "required|max:10",
            "units_q11_val" => "required|max:10",
            "units_q12_val" => "required|max:10",
            "units_q13_val" => "required|max:10",
            "units_q14_val" => "required|max:10",
            "units_q15_val" => "required|max:10",
            "units_q16_val" => "required|max:10",
            "units_q17_val" => "required|max:10",
            "units_q18_val" => "required|max:10",
            "units_q19_val" => "required|max:10",
            "units_q20_val" => "required|max:10",
            "creative" => "required",
            "problem" => "required",
            "visitors" => "nullable",

            // "visitor1_name" => "required|max:50",
            // "visitor1_val" => "required|max:50",
            // "visitor2_name" => "required|max:50",
            // "visitor2_val" => "required|max:50",

        ]);
        // dd( $data);
        $data['total_score']=0;
        $user=auth()->user();
        $data['status']="created";
        $data['look_date']=$user->convert_date(   $data['look_date']);
        for($i=1;$i<21;$i++){
            $data["units_q".$i."_score"]=$user->check_score_axis2("units_q".$i)*(int)$data["units_q".$i."_val" ];
            $data['total_score']+=$data["units_q".$i."_score"];
        }
        $data['performance_percentage']=floor(($data['total_score']*100)/140);
        // dd($data);
       $look= $user->looks()->create($data);
        if($request->file('attaches')){
            foreach ($request->file('attaches') as $file) {
                $name_img = 'attach_' . $look->id . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/media/visit/'), $name_img);
             $gg= $look->attaches()->create(['user_id'=>$user->id,"name"=>$name_img]);
            }
        }
        $look->update($data);
        alert()->success('بازدید با موفقیت به روز  شد ');
        return redirect()->route('look.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(look $look)
    {
        $look->delete();
        alert()->success('بازدید با موفقیت حذف شد ');
        return redirect()->route('look.index');
    }
    public function look_note(Look $look,Request $request)
    {
        if($request->isMethod('post')){
            $data=$request->validate([
                'note'=>"required"
            ]);
            $data['status']="noted";
            $look->update($data);
            alert()->success('یادداشت با موفقیت ثبت شد ');
            return redirect()->route('look.index');
        }
        return view('admin.look.look_note', compact(['look']));
    }

}
