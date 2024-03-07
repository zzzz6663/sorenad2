@extends('main.manager')
@php
$navbar=true;
$sidebar=true;
@endphp
@section('empty')

{{--
<div class="login_box">



    <div class="login_forms_box box_shdow">

        <div class="logo_box">
            <figure><img src="/site/images/logo.png"></figure>
        </div>
        <p>شماره موبایل خود را وارد کنید</p>
        <div id="first">
            <input type="text" name="" id="mobile" placeholder="شماره موبایل">
            <span id="send_code" class="btn1">
                ارسال کد موقت
            </span>

        </div>
        <div id="second" style="display: none">
            <h5>
                شماره وارد شده
                <span class="mobile"></span>
            </h5>
            <input type="text" name="" id="code" placeholder="کد پیامک شده">
            <h5>
                شماره اشتباهه؟
                <span class="" id="wrong">کلیک کنید</span>
            </h5>

            <span id="check_code" class="btn1">
                ورود
            </span>

        </div>
        <a href="{{ route("login") }}" class="btn btn-success">
            برگشت
        </a>


    </div>



</div>  --}}
<div class="nk-block nk-block-middle nk-auth-body wide-xs">
<div class="brand-logo pb-4 text-center">
    <a href="{{ route("login") }}" class="logo-link">
        <img class=" logo-img logo-img-lg"  src="/site/images/logo.png">
    </a>
</div>
<div class="card">
    <div class="card-inner card-inner-lg">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">ورود بدون رمز </h5>
                <div class="nk-block-des">
                    <p>
                        برای رورد شماره همراه خود را وراد کنید و در انتها دکمه ارسال کد را بزنید
                    </p>
                </div>
            </div>
        </div>
        <form action="html/pages/auths/auth-success-v2.html">
             <div id="first">
            <div class="form-group">
                <div class="form-label-group">
                    <label class="form-label" for="default-01">همراه </label>
                </div>
                <div class="form-control-wrap">
                    <input type="text" class="form-control form-control-lg" id="mobile" placeholder="شماره موبایل" >
                </div>
            </div>
            <div class="form-group">
                <span  id="send_code" class="btn btn-lg btn-primary btn-block">ارسال کد </span>
            </div>
            </div>


            <div id="second" style="display: none">
                <h5>
                    شماره وارد شده
                    <span class="mobile"></span>
                </h5>
                <input type="text" name="" class="form-control form-control-lg"  id="code" placeholder="کد پیامک شده">
                <br>
                <h6>
                    شماره اشتباهه؟
                    <span class="text text-danger" id="wrong">کلیک کنید</span>
                </h6>

                <span id="check_code" class="btn btn-lg btn-success btn-block">
                    ورود
                </span>

            </div>

        </form>
        <div class="form-note-s2 text-center pt-4">
            <a href="{{ route("login") }}"><strong>بازگشت به ورود</strong></a>
        </div>
    </div>
</div>
</div>
@endsection
