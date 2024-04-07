<?php

namespace App\Http\Controllers\customer;

use PDF;
use Carbon\Carbon;

use App\Models\Faq;
use App\Models\User;
use App\Models\Action;
use App\Models\Course;
use App\Models\Section;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use PHPUnit\Framework\Constraint\Count;

class CustomerController extends Controller
{

    public function customer_log (Request $request)
    {
        $user = auth()->user();

        $user=auth()->user();
        $actions = Action::query();
        $actions->where("advertiser_id",$user->id);
        // $actions->where('main',1);
        // $actions->where('active',0);
        if ($request->advertise_id) {
            $actions->where('advertise_id', $request->advertise_id);
        }
        if ($request->has("priod")) {
            $actions->whereDate('created_at', '>=', Carbon::now()->subDays($request->priod));
        }

        if ($request->from) {

            // $request->from = $user->convert_date($request->from);
            $actions->where('created_at', '>=', $request->from);

        }
        if ($request->to) {
            // $request->to = $user->convert_date($request->to);
            $actions->where('created_at', '<', $request->to);
        }
        $action_log=clone   $actions;
        $actions =$actions->latest()->get();

        $advertises=$user->advertises;
        $time=[
            'فروردین',
            'اردیبهشت',
            'خرداد',
            'تیر',
            'مرداد',
            'شهریور',
            'مهر',
            'آبان',
            'آذر',
            'دی',
            'بهمن',
            'اسفند',
        ];
        $income=[];
        for($i=12; $i >= 1; $i--){
          $log=  clone   $action_log;

        $year = jdate(date('Y-m-d'))->getYear();
        $month = $i;
        $day = 1;
        $persian_date = $year . '-' . $month . '-' . $day;
        $date_count = (new Jalalian($year, $month, $day))->getMonthDays();
        $first_month =\Morilog\Jalali\CalendarUtils::toGregorian($year, $month, $day);
           $first_month = $first_month[0] . '-' . $first_month[1] . '-' . $first_month[2] ;

           $end_month =\Morilog\Jalali\CalendarUtils::toGregorian($year, $month, $date_count);
           $end_month = $end_month[0] . '-' . $end_month[1] . '-' . $end_month[2] ;
           $log->whereDate('created_at', '>=', $first_month);
           $log->whereDate('created_at', '<=', $end_month);
           $income[]= $log->sum('site_share');

        // $end_month = \Morilog\Jalali\Jalalian::jalaliToGregorian($year, $month, $date_count, '-');
        }
        $income=array_reverse($income);


        // $time=[
        //     1,
        //     2,
        //     3,
        //     4,
        //     4,
        //     5,
        // ];
        // dd(json_encode( $time,JSON_UNESCAPED_UNICODE));
        return view('customer.customer_log', compact(["user","actions","advertises","action_log","time",'income']));
    }

    public function money_charge(Request $request)
    {
        $user = auth()->user();
        $transactions = $user->transactions()->whereStatus("payed")->latest()->get();
        return view('customer.money_charge', compact(["user", "transactions"]));
    }

    public function transaction_factor(Request $request)
    {
        $id = $request->action;
        $transaction = Transaction::where("transactionId", $id)->first();

        if (!$id) {
            alert()->warning('فاکتور این تراکنش موجود نیست ');
            return back();
        }

        // $html = view('customer.transaction_factor', compact(['transaction' ]))->render();
        // $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape');;
        // $number=2;
        // return $pdf->download("warhouse_$number.pdf");


        $pdf = PDF::loadView('customer.transaction_factor', compact(['transaction']));
        return $pdf->stream('document.pdf');
    }
    public function performa_pdf_warehouse(Request $request)
    {
        $company = User::whereRole('company')->first();
        if ($request->print) {
            $html = view('admin.performa.print_performa_pdf_warehouse', compact(['performa', 'company']))->render();
            $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape');;
            $number = 2;
            return $pdf->download("warhouse_$number.pdf");
        }
        return view('admin.performa.performa_pdf_warehouse ', compact(['performa', 'company']));
    }
}
