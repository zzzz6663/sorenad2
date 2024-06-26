<?php

namespace App\Http\Controllers\admin;
use Carbon\Carbon;
use App\Models\User;
// use App\Notifications\SendKaveCode;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user=auth()->user();
        $transactions = Transaction::query();
        if ($request->search) {
            $search = $request->search;
            $transactions->where('name', 'LIKE', "%{$search}%")
                ->orWhere('family', 'LIKE', "%{$search}%")
                ->orWhere('mobile', 'LIKE', "%{$search}%");
        }
        if ($request->status) {
            $transactions->where('status', $request->status);
        }
        if ($request->user_id) {
            $transactions->where('user_id', $request->user_id);
        }
        if ($request->from) {
            $request->from = $user->convert_date($request->from);
            $transactions->where('created_at', '>', $request->from);
        }
        if ($request->to) {
            $request->to = $user->convert_date($request->to);
            $transactions->where('created_at', '<', $request->to);
        }
        $transactions =$transactions
        // ->whereRole("customer")
        ->latest()->paginate(10);
        $customers=User::whereRole("customer")->get();
        return view('admin.transaction.all', compact(['transactions',"customers"]));
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
        toast()->success('کاربر با موفقیت ساخته شد ');
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
    public function edit(Request $request, User $user)
    {
        return view('admin.user.edit', compact(['user']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|max:256',
            'family' => 'required|max:256',
            'mobile' => 'required|max:11|unique:users,mobile,'.$user->id,
            'password' => 'nullable|min:6|max:20',
            // 'region_id' => 'required',
            'avatar' => 'nullable|max:2024',
            'vip' => 'nullable|max:2024',
            'active' => 'nullable|max:2024',
        ]);
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $name_img = 'avatar_' . $user->id . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('/media/users/avatar/'), $name_img);
            $data['avatar']=$name_img;
        }
        $data['password']=bcrypt($data['password']);

        $user->update($data);
        toast()->success('کاربر با موفقیت به روز  شد ');
        return redirect()->route('user.index');
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
    public function user_bank_info(User $user,Request $request)
    {
        if($request->isMethod('post')){
            $user->update(['confirm_bank_account'=>Carbon::now()]);
            toast()->success("اطلاعات حساب باموفقبت تایید شد ");
            return redirect()->route("user.index");
        }
        return view('admin.user.user_bank_info', compact(['user']));
    }

}
