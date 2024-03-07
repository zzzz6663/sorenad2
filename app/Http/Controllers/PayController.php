<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Serial;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use App\Http\Controllers\Controller;
use App\Models\Advertise;
use Shetabit\Payment\Facade\Payment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

class PayController extends Controller
{
    public function  send_pay(Request  $request)
    {
        $user = auth()->user();
        $via = 'zarinpal';
        $type = $request->type;
        $amount = $request->amount;
        $pay_type = $request->pay_type;
        $data = $request->data;
        $advertise_id = null;
        // dd($request->all());


        switch ($type) {
            case "charge":
                if ($amount < 100000) {
                    alert()->warning(' حداقل مبلغ صد هزار  تومان میباشد  ');
                    return back();
                }
                if ($amount % 100000 != 0) {
                    alert()->warning('  مبلغ باید مضربی از  صد هزار  تومان میباشد  ');
                    return back();
                }
                break;
            case "popup":
                $price = $user->view_price() * $data['view_count'];
                $amount = floor($price + (($price * $user->tax_percent()) / 100));

                $pay_type = $data["pay_type"];
                // $data['status'] = "created";
                // $data['price'] = $amount;
                // $data['remian'] = $amount;
                // $data['payed'] = 0;
                $advertise = Advertise::find($data['advertise_id']);
                $advertise->update(['price'=>$amount]);
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
                        $advertise->update(['payed' => 1, "status" => "ready_to_confirm"]);
                        alert()->success("پرداخت با موفیت از کیف پول انجام شد  ");
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
                $advertise = Advertise::find($data['advertise_id']);
                if ($advertise->count_type == "click") {
                    $price = $user->click_price() * $data['click_count'];
                    $amount = floor($price + (($price * $user->tax_percent()) / 100));
                }

                if ($advertise->count_type == "view") {
                    $price = $user->view_price() * $data['view_count'];
                    $amount = floor($price + (($price * $user->tax_percent()) / 100));
                }


                $pay_type = $data["pay_type"];
                // $data['status'] = "created";
                // $data['price'] = $amount;
                // $data['remian'] = $amount;
                // $data['payed'] = 0;
                $advertise_id = $advertise->id;
                $advertise->update(['price'=>$amount]);
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
                        $advertise->update(['payed' => 1, "status" => "ready_to_confirm"]);
                        alert()->success("پرداخت با موفیت از کیف پول انجام شد  ");
                        return redirect()->route("advertiser.list");
                    } else {

                        $amount -= $user->balance();
                    }
                }
                break;
        }
        $invoice = (new Invoice);

        $invoice->amount($amount);
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
        // $amount = 10000;
        if (!$transaction) {
            alert()->error('پرداخت با مشکل مواجه شد');
            return redirect()->route('client', ['route' => route("serial.result")]);
        }

        try {

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
                        'amount' => -1 * ($transaction->amount ),
                        'transactionId' => $transaction->advertise_id . "777",
                        'type' => "withdraw_wallet_for_ad",
                        'pay_type' => $transaction->pay_type,
                        'advertise_id' =>  $transaction->advertise_id,
                        'status' => "payed",
                    ]);
                }

                if($transaction->advertise){
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
                    }
                }

                $transaction->update([
                    'status' => 'payed',
                    'payed' => '1',
                ]);
            }
        } catch (InvalidPaymentException $exception) {
            /**
                when payment is not verified, it will throw an exception.
                We can catch the exception to handle invalid payments.
                getMessage method, returns a suitable message that can be used in user interface.
             **/
            alert()->warning('پرداخت با مشکل موجه شد ');
            return redirect()->route("result.pay", $transaction->id);
            // echo $exception->getMessage();
        }
        if ($transaction->status == 'payed') {
            alert()->success('پرداخت با موفقیت انجام  شد ');
        } else {
            alert()->warning('پرداخت انجام نشد ');
        }
        return redirect()->route("result.pay", $transaction->id);
    }
}
