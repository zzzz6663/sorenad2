@extends('main.manager')

@section('content')
<h2 class="mb-4">سفارش تبلیغ پاپ آپ</h2>
@include("master.error")
<div class="card">
    <div class="card-inner">
        <form action="{{ route("advertiser.new.ad.popup") }}" method="post">
            @csrf
            @method('post')
            
            <div class="row mb-4">
                <div class="ol-lg-12 mb-4">
                    <p class="bg bg-outline-danger">
                        <i class="fa fa-info-circle"></i>
                        این نوع تبلیغ تنها در پشت پنجره کاربر نمایش داده میشود و وارد کردن لینک کانال روبیکا، تلگرام و پیج اینستاگرام ممنوع است.
                      </p>
                      <p class="bg bg-outline-success">
                        <i class="fa fa-info-circle"></i>
                        این تبلیغ برای افزایش بازدید سایت مناسب است.
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="form-control-wrap">
                        <input type="text" name="title" class="form-control  form-control-outlined"  value="{{ old("title") }}" id="title">
                        <label class="form-label-outlined" for="title">عنوان تبلیغ</label>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-control-wrap">
                        <input type="text" name="login_link_page" class="form-control  form-control-outlined"  value="{{ old("login_link_page") }}" id="login_link_page">
                        <label class="form-label-outlined" for="login_link_page">لینک صفحه فرود</label>
                    </div>
                </div>

            </div>
            <div class="row mb-3">

                <div class="col-lg-6">
                    <input type="text"   id="price" value="{{ $price }}" hidden>
                    <div class="form-control-wrap">
                        <input type="number" name="view_count" class="form-control  form-control-outlined" id="view_count" data-price="{{ $price }}"  value="{{ old("view_count") }}" placeholder="">
                        <label class="form-label-outlined" for="view_count">
                            تعداد سفارش
                            ( حداقل سفارش 10000 عدد)
                        </label>
                        <span class="input-group-text totoal_price">
                            {{number_format( old("view_count")*$price)." تومان" }}
                        </span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-control-wrap">
                        <input type="number" name="limit_daily_view" class="form-control  form-control-outlined"  value="{{ old("limit_daily_view") }}" id="limit_daily_view">
                        <label class="form-label-outlined" for="limit_daily_view">محدودیت دفعات نمایش</label>
                        <span class="input-group-text ">
                            برای نامحدود بودن خالی بگذارید
                        </span>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="device">

                            تبلیغ در چه دستگاهی نمایش داده شود ؟
                        </label>
                        <div class="form-control-wrap">
                            <div class="form-control-select">
                                <select class="form-control" id="device">
                                    <option value="">انتخاب کنید </option>
                                    <option {{ old("device")=="mobile"?"selected":"" }} value="mobile">موبایل</option>
                                    <option {{ old("device")=="computer"?"selected":"" }} value="computer">کامپیوتر</option>
                                    <option {{ old("device")=="mobile_computer"?"selected":"" }} value="mobile_computer">موبایل و کامپیوتر</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6"></div>
            </div>

         @include('advertiser.template_pay')

            {{--  <div class="dashboard_site_form">

                <p class="margin_bt_zero"><label for="view_count">تعداد سفارش</label></p>
                <div class="flex ads_tow_cl">
                    <input type="number" id="view_count" name="view_count" class="form-control" value="{{ old("view_count") }}" data-price="{{ $price }}">
                    <p class="ads_p_price ">هزینه : <span class="totoal_price">{{number_format( old("view_count")*$price)." تومان" }}</span> </p>
                </div>
                <p>حداقل سفارش 10000 عدد</p>
                <p>
                    <label for="login_link_page">لینک صفحه فرود</label>
                    <input type="text" id="login_link_page" name="login_link_page" class="form-control" value="{{ old("login_link_page") }}">
                </p>
                <div class="flex_tworow">
                    <p>
                        <input type="number" id="limit_daily_view"  class="form-control" name="limit_daily_view" value="{{ old("limit_daily_view") }}">
                    </p>
                    <p class="text_left"><span>تعداد دفعاتی که در روز میخواهید تبلیغ نمایش داده شود. برای نامحدود بودن 0 وارد کنید.</span></p>
                </div>
                <div class="flex_tworow">
                    <p>
                        <label for="title">عنوان تبلیغ</label>
                        <input type="text" id="title" class="form-control" name="title" value="{{ old("title") }}">
                    </p>
                    <p>
                        <label for="device">تبلیغ در چه دستگاهی نمایش داده شود ؟</label>
                        <select id="site_category" class="form-control" name="device">
                            <option value="">انتخاب کنید </option>
                            <option {{ old("device")=="mobile"?"selected":"" }} value="mobile">موبایل</option>
                            <option {{ old("device")=="computer"?"selected":"" }} value="computer">کامپیوتر</option>
                            <option {{ old("device")=="mobile_computer"?"selected":"" }} value="mobile_computer">موبایل و کامپیوتر</option>
                        </select>
                    </p>
                </div>



                <div class="card_pay_box">

                    <p>

                    </p>
                    <p>
                        <button id="submit_form" class="button_pays"><svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.94358 3.25H14.0564C15.8942 3.24998 17.3498 3.24997 18.489 3.40314C19.6614 3.56076 20.6104 3.89288 21.3588 4.64124C22.1071 5.38961 22.4392 6.33856 22.5969 7.51098C22.6873 8.18385 22.7244 8.9671 22.7395 9.87428C22.7464 9.91516 22.75 9.95716 22.75 10C22.75 10.0353 22.7476 10.0699 22.7429 10.1039C22.75 10.6696 22.75 11.2818 22.75 11.9436V12.0564C22.75 13.8942 22.75 15.3498 22.5969 16.489C22.4392 17.6614 22.1071 18.6104 21.3588 19.3588C20.6104 20.1071 19.6614 20.4392 18.489 20.5969C17.3498 20.75 15.8942 20.75 14.0564 20.75H9.94359C8.10583 20.75 6.65019 20.75 5.51098 20.5969C4.33856 20.4392 3.38961 20.1071 2.64124 19.3588C1.89288 18.6104 1.56076 17.6614 1.40314 16.489C1.24997 15.3498 1.24998 13.8942 1.25 12.0564V11.9436C1.24999 11.2818 1.24999 10.6696 1.25714 10.1039C1.25243 10.0699 1.25 10.0352 1.25 10C1.25 9.95716 1.25359 9.91517 1.26049 9.87429C1.27564 8.96711 1.31267 8.18385 1.40314 7.51098C1.56076 6.33856 1.89288 5.38961 2.64124 4.64124C3.38961 3.89288 4.33856 3.56076 5.51098 3.40314C6.65019 3.24997 8.10582 3.24998 9.94358 3.25ZM2.75199 10.75C2.75009 11.1384 2.75 11.5541 2.75 12C2.75 13.9068 2.75159 15.2615 2.88976 16.2892C3.02502 17.2952 3.27869 17.8749 3.7019 18.2981C4.12511 18.7213 4.70476 18.975 5.71085 19.1102C6.73851 19.2484 8.09318 19.25 10 19.25H14C15.9068 19.25 17.2615 19.2484 18.2892 19.1102C19.2952 18.975 19.8749 18.7213 20.2981 18.2981C20.7213 17.8749 20.975 17.2952 21.1102 16.2892C21.2484 15.2615 21.25 13.9068 21.25 12C21.25 11.5541 21.2499 11.1384 21.248 10.75H2.75199ZM21.2239 9.25H2.77607C2.79564 8.66327 2.82987 8.15634 2.88976 7.71085C3.02502 6.70476 3.27869 6.12511 3.7019 5.7019C4.12511 5.27869 4.70476 5.02502 5.71085 4.88976C6.73851 4.75159 8.09318 4.75 10 4.75H14C15.9068 4.75 17.2615 4.75159 18.2892 4.88976C19.2952 5.02502 19.8749 5.27869 20.2981 5.7019C20.7213 6.12511 20.975 6.70476 21.1102 7.71085C21.1701 8.15634 21.2044 8.66327 21.2239 9.25ZM5.25 16C5.25 15.5858 5.58579 15.25 6 15.25H10C10.4142 15.25 10.75 15.5858 10.75 16C10.75 16.4142 10.4142 16.75 10 16.75H6C5.58579 16.75 5.25 16.4142 5.25 16ZM11.75 16C11.75 15.5858 12.0858 15.25 12.5 15.25H14C14.4142 15.25 14.75 15.5858 14.75 16C14.75 16.4142 14.4142 16.75 14 16.75H12.5C12.0858 16.75 11.75 16.4142 11.75 16Z" fill="#ffffff"></path>
                            </svg> <span>پرداخت</span></button>
                    </p>
                    <div class="clear"></div>
                </div>



                <div class="clear"></div>
            </div>  --}}



        </form>
    </div>
</div>


@endsection
