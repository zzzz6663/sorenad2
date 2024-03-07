@extends('master.site')
@php
$navbar=true;
$sidebar=true;
@endphp
@section('login')
<div class="container">
    <div class="row d-flex justify-content-center">
        <di class="col-lg-6 ">
            <div class=" m-5 text-center box_pay">
                <h1 class=" text-center alert alert-{{ $transaction->status=="payed"?"success":"danger" }}">
                    پرداخت انجام
                    {{ $transaction->status=="payed"?"شد":"نشد" }}
                </h1>
                <br>
                <h2>
                    مبلغ
                    {{ number_format(abs($transaction->amount)) }}
                    تومان
                </h2>

                <h3>

                    شماره پیگیری
                    {{ ($transaction->transactionId) }}
                </h3>

                <br>
                @switch($transaction->type)
                @case("withdraw_wallet_for_ad")
                @case("app")
                @case("popup")
                <a href="{{ route("advertiser.list") }}" class="btn btn-success">بازگشت به پنل </a>
                @break

                @case("charge")
                <a href="{{ route("customer.money.charge") }}" class="btn btn-success">بازگشت به پنل </a>
                @break

                @default

                @endswitch

            </div>
        </di>
    </div>

</div>
@endsection
