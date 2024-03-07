@extends('main.manager')
@section('content')

@include("master.error")
<form action="{{ route("advertiser.change.password") }}" method="post">
    @csrf
    @method('post')

    <div class="components-preview wide-md mx-auto">

        <div class="card">
            <div class="card-inner">
                <h2 class="title_right">
                    رمز عبور
                </h2>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="site">رمز عبور</label>
                                <div class="form-control-wrap">
                                    <input type="text" class=" form-control" id="password" name="password"  >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="site">تکرار رمز عبور</label>
                                <div class="form-control-wrap">
                                    <input type="text"   id="password_confirmation" name="password_confirmation" class=" form-control" placeholder="">
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







    {{--  <h2 class="title_right"><i class="fa fa-user-o"></i>اطلاعات کلی</h2>
    <div class="dashboard_site_form">

        <div class="flex_tworow">

        <p>
        <label for="password">رمز عبور </label>
        <input type="text" id="password" name="password">
        </p>

        <p>
        <label for="password">تکرار رمز عبور</label>
        <input type="text" id="password" name="password_confirmation">
        </p>

        </div>

        <div class="clear"></div>
        </div>
    <button class="btn btn-success">

        به روز سانی
    </button>  --}}
</form>

@endsection
