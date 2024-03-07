<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Advertise;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use TimeHunter\LaravelGoogleReCaptchaV2\Validations\GoogleReCaptchaV2ValidationRule;

class AdminController extends Controller
{

    public function users()
    {
        return view('admin.users.all');
    }
    public function provinces()
    {
        return view('admin.provinces.all');
    }
    public function login()
    {
        $user = auth()->user();
        return view('admin.auth.login');
    }

    public function admin_dashoard()
    {
        $user = auth()->user();
        $all_user=User::whereRole("customer");
        $all_ad=Advertise::whereIn("status",["ready_to_confirm","ready_to_show"]);
        $current_register=User::whereRole("customer")->whereDate('created_at', Carbon::today());
        $advertise_ready_to_confirm=Advertise::whereStatus("ready_to_confirm");
        $ready_to_show=Advertise::whereStatus("ready_to_show");
        $withdrawal_wait_for_admin_confirm=Withdrawal::whereStatus("wait_for_admin_confirm");
        $all_withdrawal=Withdrawal::where("wait_for_admin_confirm");
        return view('admin.dashboard.admin_dashoard',compact([
            'current_register',"advertise_ready_to_confirm",
            "ready_to_show","withdrawal_wait_for_admin_confirm",
            "all_user","all_ad",
        ]));
    }

}
