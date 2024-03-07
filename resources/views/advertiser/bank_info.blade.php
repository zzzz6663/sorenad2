@extends('main.manager')
@section('content')

@include("master.error")
<form action="{{ route("advertiser.bank.info") }}" method="post">
    @csrf
    @method('post')

    <div class="components-preview wide-md mx-auto">

        <div class="card">
            <div class="card-inner">
                <h2 class="title_right">
                    اطلاعات مالی
                </h2>
                @if(!$user->confirm_bank_account && $user->cart)
                <div class="alert_box">
                    <i class="fa fa-info-circle"></i>
                    <p>اطلاعات مالی در انتظار تائید می باشد.</p>
                </div>
                @else
                <span class="text text-success">
                    اطلاعات مالی شما تایید شده است
                </span>
                @endif

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="site">شماره شبا</label>
                                <div class="form-control-wrap">
                                    <input type="number" class=" form-control" id="shaba" name="shaba" value="{{ old("shaba",$user->shaba) }}">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="site">شماره کارت</label>
                                <div class="form-control-wrap">
                                    <input type="number" value="{{ old("cart",$user->cart) }}" id="cart" name="cart" class=" form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="site">نام صاحب حساب</label>
                                <div class="form-control-wrap">
                                    <input type="text" value="{{ old("account",$user->account) }}" id="account" name="account" class=" form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="site">نام بانک</label>
                                <div class="form-control-wrap">
                                    <input type="text" value="{{ old("bank",$user->bank) }}" id="bank" name="bank" class=" form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="site">کد ملی </label>
                                <div class="form-control-wrap">
                                    <input type="text" value="{{ old("a_mellicode",$user->a_mellicode) }}" id="a_mellicode" name="a_mellicode" class=" form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button class="btn btn-success">
                                <i class="fas fa-save"></i>
                                ذخیره
                            </button>
                        </div>
                    </div>

            </div>


        </div>


    </div>

    {{--  <h2 class="title_right"><i class="fa fa-credit-card"></i> اطلاعات مالی</h2>
    @if(!$user->confirm_bank_account && $user->cart)
    <div class="alert_box">
        <i class="fa fa-info-circle"></i>
        <p>اطلاعات مالی در انتظار تائید می باشد.</p>
    </div>
    @else
    <span class="alert alert-success">
        تایید شده
    </span>
    @endif
    <br>
    <br>


    <div class="dashboard_site_form">
        <form>

            <p>
                <label for="shaba">شماره شبا</label>
                <div class="sheba_field"><input type="text" id="shaba" name="shaba" value="{{ old("shaba",$user->shaba) }}"><span class="sheba_ir">IR</span></div>
            </p>

            <p>
                <label for="cart">شماره کارت</label>
                <input type="text" value="{{ old("cart",$user->cart) }}" id="cart" name="cart">
            </p>

            <div class="flex_tworow">

                <p>
                    <label for="account">نام صاحب حساب</label>
                    <input type="text" value="{{ old("account",$user->account) }}" id="account" name="account">
                </p>

                <p>
                    <label for="bank">نام بانک</label>
                    <input type="text" value="{{ old("bank",$user->bank) }}" id="bank" name="bank">

                </p>

            </div>

            <p>
                <label for="a_mellicode">کد ملی</label>
                <input type="text" id="a_mellicode" value="{{ old("a_mellicode",$user->a_mellicode) }}" name="a_mellicode">
            </p>

            <div class="clear2"></div>
            <p><button id="submit_form">ثبت </button></p>
        </form>

        <div class="clear"></div>
    </div>


    <!-- nemoodar_box -->
    <script type="text/javascript">
        (function($) {
            $(document).ready(function() {
                $(".select_banks").select2();
            });
        }(jQuery));

    </script>


    <div class="clear"></div>
    </div>
    <!-- sidebar_left -->


    <div class="clear"></div>  --}}
</form>

@endsection
