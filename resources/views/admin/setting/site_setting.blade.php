@extends('main.manager')

@section('content')
@include('main.error')
<form action="{{ route("site.setting") }}" method="post">
    @csrf
    @method('post')
    <div class="components-preview wide-md mx-auto">
        <br>

        <h2 class="nk-block-title fw-normal">تنظیمات  سایت   </h2>
        <br>
        <div class="card">
            <div class="card-inner">
                <div class="row">
                    <div class="col mb-3-md-6">
                        <div class="form-group">
                            <label for="">{{ __("setting.tax_percent_page_ad") }}</label>
                            <div class="form-control-wrap">
                                <input type="text" id="tax_percent_page_ad" value="{{ old("tax_percent_page_ad",$tax_percent_page_ad->val) }}" class="  form-control" name="tax_percent_page_ad">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">{{ __("setting.min_val_checkout") }}</label>
                            <div class="form-control-wrap">
                                <input type="text" id="min_val_checkout" value="{{ old("min_val_checkout",$min_val_checkout->val) }}" class="number_format form-control" name="min_val_checkout">
                                <div class="amount_total">{{  number_format(old("min_val_checkout",$min_val_checkout->val)) }} تومان</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">{{ __("setting.change_pass_admin") }}</label>
                            <div class="form-control-wrap">
                                <input type="text"  class="form-control" id="change_pass_admin" value="" name="change_pass_admin">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">{{ __("setting.repeat_pass_admin") }}</label>
                            <div class="form-control-wrap">
                                <input type="text"  class="form-control" id="repeat_pass_admin" value="" name="repeat_pass_admin">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                     
                        <div class="form-group">
                            <button type="submit"  class="btn btn-lg btn-primary">ذخیره اطلاعات</button>
                        </div>
                    </div>
                </div>
            </div>



        </div>


    </div>




</form>

@endsection
