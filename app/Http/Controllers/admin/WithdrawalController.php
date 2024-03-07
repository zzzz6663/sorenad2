<?php

namespace App\Http\Controllers\admin;
use Carbon\Carbon;
use App\Models\User;
// use App\Notifications\SendKaveCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Withdrawal;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user=auth()->user();
        $withdrawals = Withdrawal::query();
        if ($request->search) {
            $search = $request->search;
            $withdrawals->where('name', 'LIKE', "%{$search}%")
                ->orWhere('family', 'LIKE', "%{$search}%")
                ->orWhere('mobile', 'LIKE', "%{$search}%");
        }
        if ($request->status) {
            $withdrawals->where('status', $request->status);
        }
        if ($request->user_id) {
            $withdrawals->where('user_id', $request->user_id);
        }
        if ($request->from) {
            $request->from = $user->convert_date($request->from);
            $withdrawals->where('created_at', '>', $request->from);
        }
        if ($request->to) {
            $request->to = $user->convert_date($request->to);
            $withdrawals->where('created_at', '<', $request->to);
        }
        $withdrawals =$withdrawals
        // ->whereRole("customer")
        ->latest()->paginate(10);
        $customers=User::whereRole("customer")->get();
        return view('admin.withdrawal.all', compact(['withdrawals',"customers"]));
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
    public function edit(Request $request, Withdrawal $withdrawal)
    {
        return view('admin.withdrawal.edit', compact(['withdrawal']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Withdrawal $withdrawal)
    {

        // dd($request->all());


        $data = $request->validate([
            'info' => 'required|min:20|max:256',
            'attach' => 'nullable',
        ]);

        if ($request->hasFile('attach')) {
            $attach = $request->file('attach');
            $name_img = 'attach_' . $withdrawal->id . '.' . $attach->getClientOriginalExtension();
            $attach->move(public_path('/media/users/withdrawal/'), $name_img);
            $data['attach']=$name_img;
        }
        $data['status']="admin_confirmed";
        $data['confirm']=Carbon::now();
        $withdrawal->transaction->update(['status'=>"payed"]);

        $withdrawal->update($data);
        $withdrawal->user->logs()->create([
            'type'=>"confirm_withdrawal",
            'withdrawal_id'=> $withdrawal->id,
        ]);
        alert()->success('درخواست  با موفقیت به روز  شد ');
        return redirect()->route('withdrawal.index');
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
    public function user_bank_info(User $user,Request $request)
    {
        if($request->isMethod('post')){
            $user->update(['confirm_bank_account'=>Carbon::now()]);
            alert()->success("اطلاعات حساب باموفقبت تایید شد ");
            return redirect()->route("user.index");
        }
        return view('admin.user.user_bank_info', compact(['user']));
    }

}
