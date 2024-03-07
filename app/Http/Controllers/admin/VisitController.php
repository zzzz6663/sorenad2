<?php

namespace App\Http\Controllers\admin;
use Carbon\Carbon;
use App\Models\Visit;
// use App\Notifications\SendKaveCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psy\CodeCleaner\ReturnTypePass;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $visits = Visit::query();
        // if ($request->search) {
        //     $search = $request->search;
        //     $visits->where('name', 'LIKE', "%{$search}%")
        //         ->orWhere('family', 'LIKE', "%{$search}%")
        //         ->orWhere('mobile', 'LIKE', "%{$search}%");
        // }

        $user=auth()->user();

        if($user->role=="inspector"){
            $visits->where("user_id",$user->id);
        }
        $visits = $visits
        ->latest()->paginate(10);
        return view('admin.visit.all', compact(['visits']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.visit.create');
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
            "region_id" => "required|max:30",
            "unit_Name_educational" => "required|max:30",
            "location" => "required|max:30",
            "gender" => "required|max:30",
            "preiod" => "required|max:30",
            "unit_type" => "required|max:30",
            "manager_name" => "required|max:30",
            "manager_course" => "required|max:30",
            "manager_year_service" => "required|max:30",
            "manager_tell" => "required|max:30",
            "manager_adress" => "required|max:500",
            "educational_background_one_girl" => "required|max:5",
            "educational_background_one_boy" => "required|max:5",
            // "educational_background_one_sum" => "required|max:5",
            "educational_background_one_class_count" => "required|max:5",
            "educational_background_one_density" => "required|max:5",
            "educational_background_tow_girl" => "required|max:5",
            "educational_background_tow_boy" => "required|max:5",
            // "educational_background_tow_sum" => "required|max:5",
            "educational_background_tow_class_count" => "required|max:5",
            "educational_background_tow_density" => "required|max:5",
            "educational_background_three_girl" => "required|max:5",
            "educational_background_three_boy" => "required|max:5",
            // "educational_background_three_sum" => "required|max:5",
            "educational_background_three_class_count" => "required|max:5",
            "educational_background_three_density" =>"required|max:5",
            "educational_background_four_girl" => "required|max:5",
            "educational_background_four_boy" => "required|max:5",
            // "educational_background_four_sum" => "required|max:5",
            "educational_background_four_class_count" => "required|max:5",
            "educational_background_four_density" => "required|max:5",
            "educational_background_five_girl" => "required|max:5",
            "educational_background_five_boy" => "required|max:5",
            // "educational_background_five_sum" => "required|max:5",
            "educational_background_five_class_count" => "required|max:5",
            "educational_background_five_density" => "required|max:5",
            "educational_background_six_girl" => "required|max:5",
            "educational_background_six_boy" => "required|max:5",
            // "educational_background_six_sum" => "required|max:5",
            "educational_background_six_class_count" => "required|max:5",
            "educational_background_six_density" => "required|max:5",


            "total_teachers_count" => "nullable|max:5",
            "total_teachers_hour" => "nullable|max:5",
            "educational_assistant_count" => "nullable|max:5",
            "educational_assistant_hour" => "nullable|max:5",
            "deputy_assistant_count" => "nullable|max:5",
            "deputy_assistant_hour" => "nullable|max:5",
            "breeding_assistant_count" => "nullable|max:5",
            "breeding_assistant_hour" => "nullable|max:5",
            "consultant_working_count" => "nullable|max:5",
            "consultant_working_hour" => "nullable|max:5",
            "hygiene_coach_count" => "nullable|max:5",
            "hygiene_coach_hour" => "nullable|max:5",
            "breeding_coach_count" => "nullable|max:5",
            "breeding_coach_hour" => "nullable|max:5",
            "servicer_coach_count" => "nullable|max:5",
            "servicer_coach_hour" => "nullable|max:5",
            "janitor_coach_count" => "nullable|max:5",
            "janitor_coach_hour" => "nullable|max:5",
            "visitors" => "nullable|max:100",
            "visit_date" => "required",
            // "performance_percentage" => "required|max:5",
            "q1_val" => "required|max:5",
            "q1_more" => "required|max:5",
            "q2_val" => "required|max:5",
            "q2_more" => "required|max:5",
            "q3_val" => "required|max:5",
            "q3_more" => "required|max:5",
            "q4_val" => "required|max:5",
            "q4_more" => "required|max:5",
            "q5_val" => "required|max:5",
            "q6_val" => "required|max:5",
            "q7_val" => "required|max:5",
            "q7_more" => "required|max:5",
            "q8_val" => "required|max:5",
            "q9_val" => "required|max:5",
            "q10_val" => "required|max:5",
            // "q10_more" => "required|max:5",
            "unit_q1_val" => "required|max:5",

            "unit_q2_val" => "required|max:5",

            "unit_q3_val" => "required|max:5",

            "unit_q4_val" => "required|max:5",

            "unit_q5_val" => "required|max:5",

            "unit_q6_val" => "required|max:5",

            "unit_q7_val" => "required|max:5",

            "unit_q8_val" => "required|max:5",

            "unit_q9_val" => "required|max:5",

            "unit_q10_val" => "required|max:5",

            "unit_q11_val" => "required|max:5",

            "unit_q12_val" => "required|max:5",

            "unit_q13_val" => "required|max:5",

            "unit_q14_val" => "required|max:5",

            "unit_q15_val" => "required|max:5",

            "unit_q16_val" => "required|max:5",

            "unit_q17_val" => "required|max:5",

            "unit_q18_val" => "required|max:5",

            "unit_q19_val" => "required|max:5",

            "unit_q20_val" => "required|max:5",

            "unit_q21_val" => "required|max:5",

            "unit_q22_val" => "required|max:5",

            "unit_q23_val" => "required|max:5",

            "unit_q24_val" => "required|max:5",

            "unit_q25_val" => "required|max:5",

            "unit_q26_val" => "required|max:5",

            "unit_q27_val" => "required|max:5",

            "unit_q28_val" => "required|max:5",

            "unit_q29_val" => "required|max:5",

            "unit_q30_val" => "required|max:5",

            "unit_q31_val" => "required|max:5",

            "unit_q32_val" => "required|max:5",

            "unit_q33_val" => "required|max:5",

            "unit_q34_val" => "required|max:5",

            "unit_q35_val" => "required|max:5",

            "unit_q36_val" => "required|max:5",

            "creative" => "required|max:4500",
        ]);
        // dd( $data);
        $user=auth()->user();
        $data['status']="created";
        $data['visit_date']=$user->convert_date(   $data['visit_date']);

        $data['educational_background_one_sum']=$data['educational_background_one_girl']+$data['educational_background_one_boy'];
        $data['educational_background_tow_sum']=$data['educational_background_tow_girl']+$data['educational_background_tow_boy'];
        $data['educational_background_three_sum']=$data['educational_background_three_girl']+$data['educational_background_three_boy'];
        $data['educational_background_four_sum']=$data['educational_background_four_girl']+$data['educational_background_four_boy'];
        $data['educational_background_five_sum']=$data['educational_background_five_girl']+$data['educational_background_five_boy'];
        $data['educational_background_six_sum']=$data['educational_background_six_girl']+$data['educational_background_six_boy'];

        $data['educational_background_total_girl']=
        $data['educational_background_one_girl']+ $data['educational_background_tow_girl']+ $data['educational_background_three_girl']+
        $data['educational_background_four_girl']+ $data['educational_background_five_girl']+ $data['educational_background_six_girl'];

        $data['educational_background_total_boy']=
        $data['educational_background_one_boy']+ $data['educational_background_tow_boy']+ $data['educational_background_three_boy']+
        $data['educational_background_four_boy']+ $data['educational_background_five_boy']+ $data['educational_background_six_boy'];

        $data['educational_background_total_sum']=
        $data['educational_background_one_sum']+ $data['educational_background_tow_sum']+ $data['educational_background_three_sum']+
        $data['educational_background_four_sum']+ $data['educational_background_five_sum']+ $data['educational_background_six_sum'];

        $data['educational_background_total_class_count']=
        $data['educational_background_one_class_count']+ $data['educational_background_tow_class_count']+ $data['educational_background_three_class_count']+
        $data['educational_background_four_class_count']+ $data['educational_background_five_class_count']+ $data['educational_background_six_class_count'];


        $data['educational_background_total_density']=
        $data['educational_background_one_density']+ $data['educational_background_tow_density']+ $data['educational_background_three_density']+
        $data['educational_background_four_density']+ $data['educational_background_five_density']+ $data['educational_background_six_density'];
        $data['total_score']=$data['q1_val']+$data['q2_val']+$data['q3_val']+$data['q4_val']+$data['q5_val']+
        $data['q6_val']+$data['q7_val']+$data['q8_val']+$data['q9_val'];
        for($i=1;$i<37;$i++){
            $data["unit_q".$i."_score"]=$user->check_score_axis("unit_q".$i)*(int)$data["unit_q".$i."_val" ];
            $data['total_score']+=$data["unit_q".$i."_score"];
        }
        $data['performance_percentage']=floor(($data['total_score']*100)/340);
       $visit= $user->visits()->create($data);
        if($request->file('attaches')){
            foreach ($request->file('attaches') as $file) {
                $name_img = 'attach_' . $visit->id . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/media/visit/'), $name_img);
             $gg= $visit->attaches()->create(['user_id'=>$user->id,"name"=>$name_img]);
            }
        }
        alert()->success('بازدید با موفقیت ساخته شد ');
        return redirect()->route('visit.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Visit $visit)
    {
        return view('admin.visit.show', compact(['visit']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Visit $visit)
    {
        return view('admin.visit.edit', compact(['visit']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, visit $visit)
    {
      $data = $request->validate([
            "region_id" => "required|max:30",
            "unit_Name_educational" => "required|max:30",
            "location" => "required|max:30",
            "gender" => "required|max:30",
            "preiod" => "required|max:30",
            "unit_type" => "required|max:30",
            "manager_name" => "required|max:30",
            "manager_course" => "required|max:30",
            "manager_year_service" => "required|max:30",
            "manager_tell" => "required|max:30",
            "manager_adress" => "required|max:500",
            "educational_background_one_girl" => "required|max:5",
            "educational_background_one_boy" => "required|max:5",
            // "educational_background_one_sum" => "required|max:5",
            "educational_background_one_class_count" => "required|max:5",
            "educational_background_one_density" => "required|max:5",
            "educational_background_tow_girl" => "required|max:5",
            "educational_background_tow_boy" => "required|max:5",
            // "educational_background_tow_sum" => "required|max:5",
            "educational_background_tow_class_count" => "required|max:5",
            "educational_background_tow_density" => "required|max:5",
            "educational_background_three_girl" => "required|max:5",
            "educational_background_three_boy" => "required|max:5",
            // "educational_background_three_sum" => "required|max:5",
            "educational_background_three_class_count" => "required|max:5",
            "educational_background_three_density" =>"required|max:5",
            "educational_background_four_girl" => "required|max:5",
            "educational_background_four_boy" => "required|max:5",
            // "educational_background_four_sum" => "required|max:5",
            "educational_background_four_class_count" => "required|max:5",
            "educational_background_four_density" => "required|max:5",
            "educational_background_five_girl" => "required|max:5",
            "educational_background_five_boy" => "required|max:5",
            // "educational_background_five_sum" => "required|max:5",
            "educational_background_five_class_count" => "required|max:5",
            "educational_background_five_density" => "required|max:5",
            "educational_background_six_girl" => "required|max:5",
            "educational_background_six_boy" => "required|max:5",
            // "educational_background_six_sum" => "required|max:5",
            "educational_background_six_class_count" => "required|max:5",
            "educational_background_six_density" => "required|max:5",


            "total_teachers_count" => "nullable|max:5",
            "total_teachers_hour" => "nullable|max:5",
            "educational_assistant_count" => "nullable|max:5",
            "educational_assistant_hour" => "nullable|max:5",
            "deputy_assistant_count" => "nullable|max:5",
            "deputy_assistant_hour" => "nullable|max:5",
            "breeding_assistant_count" => "nullable|max:5",
            "breeding_assistant_hour" => "nullable|max:5",
            "consultant_working_count" => "nullable|max:5",
            "consultant_working_hour" => "nullable|max:5",
            "hygiene_coach_count" => "nullable|max:5",
            "hygiene_coach_hour" => "nullable|max:5",
            "breeding_coach_count" => "nullable|max:5",
            "breeding_coach_hour" => "nullable|max:5",
            "servicer_coach_count" => "nullable|max:5",
            "servicer_coach_hour" => "nullable|max:5",
            "janitor_coach_count" => "nullable|max:5",
            "janitor_coach_hour" => "nullable|max:5",
            "visitors" => "nullable|max:100",
            "visit_date" => "required",
            // "performance_percentage" => "required|max:5",
            "q1_val" => "required|max:5",
            "q1_more" => "required|max:5",
            "q2_val" => "required|max:5",
            "q2_more" => "required|max:5",
            "q3_val" => "required|max:5",
            "q3_more" => "required|max:5",
            "q4_val" => "required|max:5",
            "q4_more" => "required|max:5",
            "q5_val" => "required|max:5",
            "q6_val" => "required|max:5",
            "q7_val" => "required|max:5",
            "q7_more" => "required|max:5",
            "q8_val" => "required|max:5",
            "q9_val" => "required|max:5",
            "q10_val" => "required|max:5",
            // "q10_more" => "required|max:5",
            "unit_q1_val" => "required|max:5",

            "unit_q2_val" => "required|max:5",

            "unit_q3_val" => "required|max:5",

            "unit_q4_val" => "required|max:5",

            "unit_q5_val" => "required|max:5",

            "unit_q6_val" => "required|max:5",

            "unit_q7_val" => "required|max:5",

            "unit_q8_val" => "required|max:5",

            "unit_q9_val" => "required|max:5",

            "unit_q10_val" => "required|max:5",

            "unit_q11_val" => "required|max:5",

            "unit_q12_val" => "required|max:5",

            "unit_q13_val" => "required|max:5",

            "unit_q14_val" => "required|max:5",

            "unit_q15_val" => "required|max:5",

            "unit_q16_val" => "required|max:5",

            "unit_q17_val" => "required|max:5",

            "unit_q18_val" => "required|max:5",

            "unit_q19_val" => "required|max:5",

            "unit_q20_val" => "required|max:5",

            "unit_q21_val" => "required|max:5",

            "unit_q22_val" => "required|max:5",

            "unit_q23_val" => "required|max:5",

            "unit_q24_val" => "required|max:5",

            "unit_q25_val" => "required|max:5",

            "unit_q26_val" => "required|max:5",

            "unit_q27_val" => "required|max:5",

            "unit_q28_val" => "required|max:5",

            "unit_q29_val" => "required|max:5",

            "unit_q30_val" => "required|max:5",

            "unit_q31_val" => "required|max:5",

            "unit_q32_val" => "required|max:5",

            "unit_q33_val" => "required|max:5",

            "unit_q34_val" => "required|max:5",

            "unit_q35_val" => "required|max:5",

            "unit_q36_val" => "required|max:5",

            "creative" => "required|max:4500",
        ]);
        // dd( $data);
        $user=auth()->user();
        $data['status']="created";
        $data['visit_date']=$user->convert_date(   $data['visit_date']);


        $data['educational_background_one_sum']=$data['educational_background_one_girl']+$data['educational_background_one_boy'];
        $data['educational_background_tow_sum']=$data['educational_background_tow_girl']+$data['educational_background_tow_boy'];
        $data['educational_background_three_sum']=$data['educational_background_three_girl']+$data['educational_background_three_boy'];
        $data['educational_background_four_sum']=$data['educational_background_four_girl']+$data['educational_background_four_boy'];
        $data['educational_background_five_sum']=$data['educational_background_five_girl']+$data['educational_background_five_boy'];
        $data['educational_background_six_sum']=$data['educational_background_six_girl']+$data['educational_background_six_boy'];


        $data['educational_background_total_girl']=
        $data['educational_background_one_girl']+ $data['educational_background_tow_girl']+ $data['educational_background_three_girl']+
        $data['educational_background_four_girl']+ $data['educational_background_five_girl']+ $data['educational_background_six_girl'];

        $data['educational_background_total_boy']=
        $data['educational_background_one_boy']+ $data['educational_background_tow_boy']+ $data['educational_background_three_boy']+
        $data['educational_background_four_boy']+ $data['educational_background_five_boy']+ $data['educational_background_six_boy'];

        $data['educational_background_total_sum']=
        $data['educational_background_one_sum']+ $data['educational_background_tow_sum']+ $data['educational_background_three_sum']+
        $data['educational_background_four_sum']+ $data['educational_background_five_sum']+ $data['educational_background_six_sum'];

        $data['educational_background_total_class_count']=
        $data['educational_background_one_class_count']+ $data['educational_background_tow_class_count']+ $data['educational_background_three_class_count']+
        $data['educational_background_four_class_count']+ $data['educational_background_five_class_count']+ $data['educational_background_six_class_count'];


        $data['educational_background_total_density']=
        $data['educational_background_one_density']+ $data['educational_background_tow_density']+ $data['educational_background_three_density']+
        $data['educational_background_four_density']+ $data['educational_background_five_density']+ $data['educational_background_six_density'];
        $data['total_score']=$data['q1_val']+$data['q2_val']+$data['q3_val']+$data['q4_val']+$data['q5_val']+
        $data['q6_val']+$data['q7_val']+$data['q8_val']+$data['q9_val'];
        for($i=1;$i<37;$i++){
            $data["unit_q".$i."_score"]=$user->check_score_axis("unit_q".$i)*(int)$data["unit_q".$i."_val" ];
            $data['total_score']+=$data["unit_q".$i."_score"];
        }
        $data['performance_percentage']=floor(($data['total_score']*100)/340);
       $visit= $user->visits()->create($data);
        if($request->file('attaches')){
            foreach ($request->file('attaches') as $file) {
                $name_img = 'attach_' . $visit->id . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/media/visit/'), $name_img);
             $gg= $visit->attaches()->create(['user_id'=>$user->id,"name"=>$name_img]);
            }
        }

        $visit->update($data);
        alert()->success('بازدید با موفقیت به روز  شد ');
        return redirect()->route('visit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(visit $visit)
    {
        $visit->delete();
        alert()->success('بازدید با موفقیت حذف شد ');
        return redirect()->route('visit.index');
    }
    public function visit_note(Visit $visit,Request $request)
    {
        if($request->isMethod('post')){
            $data=$request->validate([
                'note'=>"required"
            ]);
            $data['status']="noted";
            $visit->update($data);
            alert()->success('یادداشت با موفقیت ثبت شد ');
            return redirect()->route('visit.index');
        }
        return view('admin.visit.visit_note', compact(['visit']));
    }
  public function active_visit(visit $visit)
    {

        // dd($visit);
        // $visit->update(['deleted_at'=>"required",]);
        $visit->restore();
        // visit::onlyTrashed()->where('id', $visit->id)->restore();

        alert()->success('بازدید با موفقیت فعال شد ');
        return redirect()->route('visit.index');
    }

}
