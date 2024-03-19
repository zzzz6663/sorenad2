{{--
<div class="login_box">
    <form action="{{ route("register") }}" method="post">
<div class="login_forms_box box_shdow">
    @csrf
    @method('post')
    @include('master.error')
    <div class="logo_box">
        <figure><img src="/site/images/logo.png"></figure>
    </div>
    <p>حساب کاربری دارید ؟ <a class="register_url" href="{{ route("login") }}">ورود</a></p>
    <input type="text" class="form-control" name="name" value="{{ old("name") }}" placeholder="نام">
    <input type="text" class="form-control" name="family" value="{{ old("mobile") }}" placeholder="نام خانوادگی">
    <input type="text" class="form-control" name="mobile" value="{{ old("mobile") }}" placeholder="تلفن همراه">
    <input type="text" class="form-control" name="password" value="" placeholder="رمز ورود">
    <input type="text" class="form-control" name="password_confirmation" value="" placeholder="تکرار رمز ورود">
    <input type="submit" value="ثبت نام">
</div>
</form> --}}
</div>


@extends('main.manager')
@php
$navbar=true;
$sidebar=true;
@endphp
@section('empty')

<div class="nk-block nk-block-middle nk-auth-body wide-xs">
    <div class="brand-logo pb-4 text-center">
        <a href="{{ route("login") }}" class="logo-link">
            <img class=" logo-img logo-img-lg" src="/site/images/plogo.png">
        </a>
    </div>
    <div class="card">
        <div class="card-inner card-inner-lg">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">ثبت نام  </h5>
                    <div class="nk-block-des">
                        <p>
                            با یک بار  ثبت نام میتوانید آگهی دهنده و نمایش  دهنده باشید
                        </p>
                    </div>
                </div>
            </div>
                <div id="">

                    <form action="{{ route("register") }}" method="post">
                        <div class="login_forms_box box_shdow">
                            @csrf
                            @method('post')
                            @include('master.error')

                            <p>حساب کاربری دارید ؟ <a class="register_url" href="{{ route("login") }}">ورود</a></p>

                            <div class="form-group">
                                <label for="name">
                                </label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old("name") }}" placeholder="نام">
                            </div>
                            <div class="form-group">
                                <label for="name">
                                </label>
                                <input type="text" class="form-control" name="family" value="{{ old("family") }}" placeholder="نام خانوادگی">

                            </div>
                            <div class="form-group">
                                <label for="name">
                                </label>
                                <input type="text" class="form-control" name="mobile" value="{{ old("mobile") }}" placeholder="تلفن همراه">

                            </div>
                            <div class="form-group">
                                <label for="name">
                                </label>
                                <input type="text" class="form-control" name="password" value="" placeholder="رمز ورود">

                            </div>
                            <div class="form-group">
                                <label for="name">
                                </label>
                                <input type="text" class="form-control" name="password_confirmation" value="" placeholder="تکرار رمز ورود">

                            </div>

                            <div class="form-group">
                                <button i class="btn btn-lg btn-primary btn-block">ثبت نام </button>
                            </div>
                        </div>




                    </form>
                    <div class="form-note-s2 text-center pt-4">
                        <a href="{{ route("login") }}"><strong>بازگشت به ورود</strong></a>
                    </div>
                </div>
        </div>
    </div>
    @endsection
