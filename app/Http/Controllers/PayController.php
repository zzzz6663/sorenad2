<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Serial;
use App\Models\Setting;
use App\Models\Advertise;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use App\Http\Controllers\Controller;
use Shetabit\Payment\Facade\Payment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

class PayController extends Controller
{
    public function  send_pay(Request  $request,Advertise $advertise)
    {
        $user = auth()->user();
        $via = 'sep';
        $type = $request->type;
        $amount = $request->amount;
        $pay_type = $request->pay_type;
        // dd( $pay_type);
        // dd( $pay_type);
        $data = $request->data;
        $advertise_id = null;
        if( $advertise->id){
            if($request->agin){
                $info= $request->validate([
                    'count_type' => "required",
                    'limit_daily_click' => "nullable",
                    'order_count' => "required",
                    'limit_daily_view' => "nullable",
                    'pay_type' => "required",
                ]);
            }
            $type = $advertise->type;
            $info['limit_daily'] = $request->limit_daily_view;
            if ($request->limit_daily_click) {
                $info['limit_daily'] = $request->limit_daily_click;
            }
            $advertise->update( $info);
            $data['limit_daily'] = $request->limit_daily_view;
            if ($request->limit_daily_click) {
                $data['limit_daily'] = $request->limit_daily_click;
            }
            $data["unit_show"] = $user->setting_cache($type . "_advertiser_show");
            $data["unit_click"] = $user->setting_cache($type . "_advertiser_click");
            $data["unit_vip_click"] = $user->setting_cache($type . "_user_vip_click");
            $data["unit_vip_show"] = $user->setting_cache($type . "_user_vip_show");
            $data["unit_normal_click"] = $user->setting_cache($type . "_user_normal_click");
            $data["unit_normal_show"] = $user->setting_cache($type . "_user_normal_show");
            $data['order_count'] =  $advertise->order_count;
            $data['pay_type'] =  $request->pay_type;
            $advertise_id = $advertise->id;
            $data['advertise_id'] = $advertise->id;
        }
        // dd($request->all());

        $min_val_charge = Setting::whereName("min_val_charge")->first();
        switch ($type) {
            case "charge":
                $min=number_format( $min_val_charge->val);
                if ($amount < $min_val_charge->val) {
                    toast()->warning("حداقل مبلغ $min  تومان میباشد  ");
                    return back();
                }
                if ($amount % 100000 != 0) {
                    toast()->warning('  مبلغ باید مضربی از  صد هزار  تومان میباشد  ');
                    return back();
                }
                break;
            case "popup":
                $price = $user->view_price($type) * $data['order_count'];
                $amount = floor($price + (($price * $user->tax_percent()) / 100));
                $pay_type = $data["pay_type"];
                // $data['status'] = "created";
                // $data['price'] = $amount;
                // $data['remian'] = $amount;
                // $data['payed'] = 0;
                $advertise = Advertise::find($data['advertise_id']);
                $advertise->update(['tax' => $amount, 'price' => $price, 'active' => 1]);
                $advertise_id = $advertise->id;
                if ($data['pay_type'] == "acc_money") {
                    if ($user->balance() > $amount) {
                        $transaction = $user->transactions()->create([
                            'amount' => -1 * $amount,
                            'transactionId' => $advertise_id . "888",
                            'type' => "withdraw_wallet_for_ad",
                            'pay_type' => $pay_type,
                            'advertise_id' => $advertise_id,
                            'status' => "payed",
                        ]);
                        $advertise->update(['payed' => 1, "status" => "ready_to_confirm",     'active' => "1",]);
                        toast()->success("پرداخت با موفیت از کیف پول انجام شد  ");
                        return redirect()->route("advertiser.list");
                    } else {
                        $amount -= $user->balance();
                    }
                }

                break;
            case "app":
            case "banner":
            case "fixpost":
            case "text":
            case "video":
            case "hamsan":

                $advertise = Advertise::find($data['advertise_id']);
                if ($advertise->count_type == "click") {
                    $price = $user->click_price($type) * $data['order_count'];
                    $amount = floor($price + (($price * $user->tax_percent()) / 100));
                }

                if ($advertise->count_type == "view") {
                    $price = $user->view_price($type) * $data['order_count'];
                    $amount = floor($price + (($price * $user->tax_percent()) / 100));
                }
                $pay_type = $data["pay_type"];
                // $data['status'] = "created";
                // $data['price'] = $amount;
                // $data['remian'] = $amount;
                // $data['payed'] = 0;
                $advertise_id = $advertise->id;

                $advertise->update(['price' => $amount, 'active' => 1]);
                if ($data['pay_type'] == "acc_money") {
                    if ($user->balance() > $amount) {
                        $transaction = $user->transactions()->create([
                            'amount' => -1 * $amount,
                            'transactionId' => $advertise_id . "777",
                            'type' => "withdraw_wallet_for_ad",
                            'pay_type' => $pay_type,
                            'advertise_id' => $advertise_id,
                            'status' => "payed",
                        ]);
                        $advertise->update(['payed' => 1, "status" => "ready_to_confirm",   'active' => "1"]);
                        toast()->success("پرداخت با موفیت از کیف پول انجام شد  ");
                        return redirect()->route("advertiser.list");
                    } else {
                        $amount -= $user->balance();
                    }
                }
                break;
            case "chanal":
                $advertise = Advertise::find($data['advertise_id']);
                $data['unit_click']=$advertise->price_suggestion;
                $price = $data['unit_click']* $data['order_count'];
                // dd( $data);
                $amount = floor($price + (($price * $user->tax_percent()) / 100));
                $pay_type = $data["pay_type"];
                $advertise_id = $advertise->id;
                $advertise->update(['price' => $amount, 'active' => 1]);
                if ($data['pay_type'] == "acc_money") {
                    if ($user->balance() > $amount) {
                        $transaction = $user->transactions()->create([
                            'amount' => -1 * $amount,
                            'transactionId' => $advertise_id . "777",
                            'type' => "withdraw_wallet_for_ad",
                            'pay_type' => $pay_type,
                            'advertise_id' => $advertise_id,
                            'status' => "payed",
                        ]);
                        $advertise->update(['payed' => 1, "status" => "ready_to_confirm",   'active' => "1"]);
                        toast()->success("پرداخت با موفیت از کیف پول انجام شد  ");
                        return redirect()->route("advertiser.list");
                    } else {
                        $amount -= $user->balance();
                    }
                }

                break;
        }
        $invoice = (new Invoice);
        $amount=10000;
        $invoice->amount($amount);
        // $invoice->amount(10000);
        return   Payment::via($via)->callbackUrl(route('pay.verify'))->purchase(
            $invoice,
            function ($driver, $transactionId) use ($user, $type, $invoice, $amount, $pay_type, $advertise_id) {
                $transaction = $user->transactions()->create([
                    'amount' => $amount,
                    'transactionId' => $transactionId,
                    'type' => "charge",
                    'pay_type' => $pay_type,
                    'advertise_id' => $advertise_id,
                ]);
            }
        )->pay()->render();
    }



    public function result_pay(Transaction $transaction)
    {
        $user = $transaction->user;
        return view('pay.result_pay', compact(["transaction"]));
    }







    public function bill_verify(Request $request)
    {
        // dd($request->all());
        $tid = ($request->Authority);
        $transaction = Transaction::where('transactionId', ($tid))->first();
        $user = $transaction->user;

        $amount = (int)$transaction->amount;
        // $amount= 10000;
        // $amount= 10000;
        // $amount= 10000;
        $amount=10000;
        if (!$transaction) {
            toast()->error('پرداخت با مشکل مواجه شد');
            return redirect()->route('client', ['route' => route("serial.result")]);
        }

        try {
// $amount=1000;
            $receipt = Payment::amount(abs((int)$amount))->transactionId($request->Authority)->verify();
            if ($request->Status == 'OK') {
                if ($transaction->pay_type == "acc_money") {
                    $user->transactions()->create([
                        'amount' => -1 * ($transaction->amount + $user->balance()),
                        'transactionId' => $transaction->advertise_id . "777",
                        'type' => "withdraw_wallet_for_ad",
                        'pay_type' => $transaction->pay_type,
                        'advertise_id' =>  $transaction->advertise_id,
                        'status' => "payed",
                    ]);
                }

                if ($transaction->pay_type == "bank_pay") {
                    $user->transactions()->create([
                        'amount' => -1 * ($transaction->amount),
                        'transactionId' => $transaction->advertise_id . "777",
                        'type' => "withdraw_wallet_for_ad",
                        'pay_type' => $transaction->pay_type,
                        'advertise_id' =>  $transaction->advertise_id,
                        'status' => "payed",
                    ]);
                }

                if ($transaction->advertise) {
                    switch ($transaction->advertise->type) {
                        case "charge":
                            break;
                        case "app":
                            $transaction->advertise->update(['payed' => 1, "status" => "ready_to_confirm"]);
                            break;
                        case "popup":
                            $transaction->advertise->update(['payed' => 1, "status" => "ready_to_confirm"]);
                            break;
                        case "banner":
                            $transaction->advertise->update(['payed' => 1, "status" => "ready_to_confirm"]);
                            break;
                        case "fixpost":
                            $transaction->advertise->update(['payed' => 1, "status" => "ready_to_confirm"]);
                            break;
                        case "text":
                            $transaction->advertise->update(['payed' => 1, "status" => "ready_to_confirm"]);
                            break;
                        case "video":
                            $transaction->advertise->update(['payed' => 1, "status" => "ready_to_confirm"]);
                            break;
                        case "chanal":
                            $transaction->advertise->update(['payed' => 1, "status" => "ready_to_confirm"]);
                            break;

                        case "hamsan":
                            $transaction->advertise->update(['payed' => 1, "status" => "ready_to_confirm"]);
                            break;
                    }
                }

                $transaction->update([
                    'status' => 'payed',
                    'payed' => '1',
                ]);
            }else{
                dd(33);
            }
        } catch (InvalidPaymentException $exception) {
            /**
                when payment is not verified, it will throw an exception.
                We can catch the exception to handle invalid payments.
                getMessage method, returns a suitable message that can be used in user interface.
             **/
            dd($exception->getMessage());
            toast()->warning('پرداخت با مشکل موجه شد ');
            return redirect()->route("result.pay", $transaction->id);
            // echo $exception->getMessage();
        }
        if ($transaction->status == 'payed') {
            toast()->success('پرداخت با موفقیت انجام  شد ');
        } else {
            toast()->warning('پرداخت انجام نشد ');
        }
        return redirect()->route("result.pay", $transaction->id);
    }
}
