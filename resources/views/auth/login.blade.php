@extends('main.manager')
@php
$navbar=true;
$sidebar=true;
@endphp
@section('empty')
<div class="nk-block nk-block-middle nk-auth-body wide-xs">
    <div class="brand-logo pb-4 text-center">
        <a href="{{ route("login") }}" class="logo-link">
            <img class=" logo-img logo-img-lg"  src="/site/images/logo.png">
        </a>
    </div>
    <form action="{{ route("check.login") }}" method="post">
        @csrf
        @method('post')
        <div class="card">
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">ورود</h4>
                        <div class="nk-block-des">
                            <p>با استفاده از ایمیل و رمز عبور خود به پنل دش‌لایت دسترسی پیدا کنید.</p>
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="mobile">همراه</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-lg" id="mobile" name="mobile" placeholder=" همراه خود را وارد کنید">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="password">رمز عبور</label>
                            <a class="link link-primary link-sm" href="{{ route("mobile.login") }}">رمز عبور را فراموش کردید؟</a>
                        </div>
                        <div class="form-control-wrap">
                            <a href="#" class="form-icon form-icon-right passcode-switch lg no_link " data-target="password">
                                <em class="passcode-icon icon-show icon ni ni-eye no_link"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off no_link"></em>
                            </a>
                            <input type="password" class="form-control form-control-lg"  name="password" id="password" placeholder="رمز عبور خود را وارد کنید">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block">ورود</button>
                    </div>
                <div class="form-note-s2 text-center pt-4">در پلتفرم ما جدید هستید؟ <a href="{{ route("register") }}">یک حساب کاربری ایجاد کنید</a></div>
                <div class="text-center pt-4 pb-3">
                    {{-- <h6 class="overline-title overline-title-sap"><span>یا</span></h6>  --}}
                </div>
                <ul class="nav justify-center gx-4">
                    <li class="nav-item"><a class="nav-link" href="#">فیس بوک</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">گوگل</a></li>
                </ul>
            </div>
        </div>
    </form>
</div>

{{-- <div class="login_box">
    <form action="{{ route("check.login") }}" method="post">
@csrf
@method('post')
<div class="login_forms_box box_shdow">
    <div class="logo_box">
        <figure><img src="/site/images/logo.png"></figure>
    </div>
    <p>حساب کاربری ندارید ؟ <a class="register_url" href="{{ route("register") }}">ثبت نام </a></p>
    <input type="text" name="mobile" placeholder="تلفن همراه">
    <input type="text" name="password" value="" placeholder="رمز ورود">
    <a class="login_ads_panels" href=""> 🎯ورود به پنل تبلیغ دهنده</a>
    <input type="submit" value="ورود">
    <div class="flex bt_form_txt">
        <p><a href="{{ route("mobile.login") }}"> 🔑ورود بدون رمز</a></p>
        <p class="rember_me_box">
            <input type="radio" id="remeber_me" name="remeber_me">
            <label for="remeber_me">مرا به خاطر بسپار</label></p>
    </div>
</div>
</form>
</div> --}}
@endsection
