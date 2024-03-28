@extends('main.manager')
@section('content')

@include("master.error")


<div class="components-preview wide-md mx-auto">
    <br>

    <h2 class="nk-block-title fw-normal">ثبت اطلاعات سایت</h2>
    <br>
    <form action="{{ route("advertiser.site.script") }}" method="post">
        @csrf
        @method('post')
        <div class="card">
            <div class="card-inner">
                <div class="row">

                    <div class="col-lg-12 mb-2">
                        <span class="pl-4">
                            کد اسکریپت
                        </span>
                        <div class="nk-reply-from">
                            {{ route("home")."/js/js_add.js" }}
                            <span data-url="{{ route("home")."/js/js_add.js" }}" class="btn btn-success copy">کپی </span>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-4">
                        <p class="alert alert-warning">
                            این کد را در هدر یا فوتر سایت خود قرار دهید.
                        </p>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="preview-block">
                            <span class="preview-title overline-title">توضیحات

                            </span>
                            <div class="custom-control custom-switch checked">
                                <input type="text" hidden name="back_popup" value="0">
                                <input type="checkbox" class="custom-control-input" name="back_popup" {{ $user->back_popup?"checked":"" }} id="customSwitch2" value="1">
                                <label class="custom-control-label" for="customSwitch2">پاپ آپ پشت پنجره</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="preview-block">
                            <span class="preview-title overline-title">
                                توضیحات
                            </span>
                            <div class="custom-control custom-switch checked">
                                <input type="text" hidden name="float_app" value="0">
                                <input type="checkbox" class="custom-control-input"    name="float_app" {{ $user->float_app?"checked":"" }}  id="float_app" value="1">
                                <label class="custom-control-label" for="float_app">تبلیغات شناور نصب اپلیکیشن</label>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="default-06">دفعات نمایش پاپ آپ برای هر ip در 24 ساعت</label>
                            <div class="form-control-wrap">
                                <div class="form-control-select">
                                    <select class="form-control" name="show_display_times" id="default-06">
                                        <option value="">انتخاب کنید </option>
                                        <option {{ $user->show_display_times=="1"?"selected":"" }} value="1">1 </option>
                                        <option {{ $user->show_display_times=="2"?"selected":"" }} value="2">2 </option>
                                        <option {{ $user->show_display_times=="3"?"selected":"" }} value="3">3 </option>
                                        <option {{ $user->show_display_times=="4"?"selected":"" }} value="4">4 </option>
                                        <option {{ $user->show_display_times=="5"?"selected":"" }} value="5">5 </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-4">
                        <p class="alert alert-warning mt-4">

                            در صورتیکه این تبلیغ را در سایت قرار میدهید، هیچ تبلیغ شناور دیگری نمیتوانید روی آن داشته باشید.
                            <br>

                            در صورت تخلف، حساب کاربری شما مسدود خواهد شد.
                            <br>
                            در واقع تبلیغات باید به درستی نمایش داده شوند و روی یکدیگر قرار نگیرند.

                        </p>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">ذخیره اطلاعات</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>


</div>
<div class="components-preview wide-md mx-auto">
    <br>

    <h2 class="nk-block-title fw-normal">اسکریت</h2>

    <div class="card">
        <div class="card-inner">
            <div class="row">

                <div class="col-lg-6 mb-5">
                    <span class="pl-4">
                        کد تبلیغات پست ثابت (مناسب برای باتدا یا انتهای مطالب)
                    </span>
                    <div class="nk-reply-from">
                        {{ route("home")."/js_add.js" }}
                        <span data-url="{{ route("home")."/js_add.js" }}" class="btn btn-success copy">کپی </span>
                    </div>
                </div>
                <div class="col-lg-6 mb-5">
                    <span class="pl-4">
                        کد تبلیغات بنری سایز (275*180) مناسب ستون کناری
                    </span>
                    <div class="nk-reply-from">
                        {{ route("home")."/js_add.js" }}
                        <span data-url="{{ route("home")."/js_add.js" }}" class="btn btn-success copy">کپی </span>
                    </div>
                </div>
                <div class="col-lg-6 mb-5">
                    <span class="pl-4">
                        کد باکس تبلیغات متنی مناسب برای ابتدا یا انتهای مطالب یا ستون کناری
                    </span>
                    <div class="nk-reply-from">
                        {{ route("home")."/js_add.js" }}
                        <span data-url="{{ route("home")."/js_add.js" }}" class="btn btn-success copy">کپی </span>
                    </div>
                </div>

                <div class="col-lg-6 mb-5">
                    <span class="pl-4">
                        کد تبلیغات پست ثابت (مناسب برای باتدا یا انتهای مطالب)
                    </span>
                    <div class="nk-reply-from">
                        {{ route("home")."/js_add.js" }}
                        <span data-url="{{ route("home")."/js_add.js" }}" class="btn btn-success copy">کپی </span>
                    </div>
                </div>
                <div class="col-lg-6 mb-5">
                    <span class="pl-4">
                        کد تبلیغات بنری سایز (275*180) مناسب ستون کناری
                    </span>
                    <div class="nk-reply-from">
                        {{ route("home")."/js_add.js" }}
                        <span data-url="{{ route("home")."/js_add.js" }}" class="btn btn-success copy">کپی </span>
                    </div>
                </div>
                <div class="col-lg-6 mb-5">
                    <span class="pl-4">
                        کد باکس تبلیغات متنی مناسب برای ابتدا یا انتهای مطالب یا ستون کناری
                    </span>
                    <div class="nk-reply-from">
                        {{ route("home")."/js_add.js" }}
                        <span data-url="{{ route("home")."/js_add.js" }}" class="btn btn-success copy">کپی </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>








{{-- <div class="dashbord_box_table">
    <h2 class="title_right">سایتهای من</h2>
    <div class="flex dashbord_table">

        <div class="dashbord_table_title">
            <ul class="flex">
                <td>نام</td>
                <li> سایت</li>
                <li> وضعیت </li>
                <li> توضیحات</li>
                <li>میزان درامد</li>
                <li>تاریخ ایجاد</li>
                <li>وضعیت </li>
            </ul>
        </div>
        @foreach ($sites as $site )

        <div class="dashbord_table_row">
            <ul class="flex">
                <li>{{ $site->name }}</li>
<li>{{ $site->site }}</li>
<li>
    {{ __("site_status.$site->status")}}
</li>
<li>
    @if($site->status=="rejected")
    {{ $site->reason }}
    @endif
</li>
<li>
    {{ $site->income() }}
    <span class="price_format">تومان</span>
</li>
<li>
    {{ jdate($site->created_at) }}
</li>


<li>
    @if($site->status=="rejected")
    <a href="{{ route("advertiser.update.site",$site->id) }}" class="btn btn-success">
        ویرایش مجدد
    </a>
    @endif
</li>
</ul>
</div>

@endforeach



</div>

</div> --}}

@endsection
