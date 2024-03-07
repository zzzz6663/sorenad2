<?php

namespace App\Http\Controllers\customer;

use PDF;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use PHPUnit\Framework\Constraint\Count;

class CustomerController extends Controller
{

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
