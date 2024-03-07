@extends('main.manager')
@section('content')
<h2 class="title_right">سفارش تبلیغ ویدیویی</h2>

@include("master.error")
<div class="card">
    <div class="card-inner">
        <form action="{{ route("advertiser.new.ad.video") }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="row mb-4">
                <div class="ol-lg-12 mb-4">
                    {{-- <p class="bg bg-outline-danger">
                        <i class="fa fa-info-circle"></i>
                        این نوع تبلیغ تنها در پشت پنجره کاربر نمایش داده میشود و وارد کردن لینک کانال روبیکا، تلگرام و پیج اینستاگرام ممنوع است.
                      </p>  --}}
                    <p class="bg bg-outline-success">
                        <i class="fa fa-info-circle"></i>
                        این نوع تبلیغ فقط در موبایل نمایش داده میشود و برای افزایش نصب اپلیکیشن اندروید مناسب است.
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="form-control-wrap">
                        <input type="text" name="title" class="form-control  form-control-outlined" value="{{ old("title") }}" id="title">
                        <label class="form-label-outlined" for="title">عنوان </label>
                        {{-- <span class="info_txt">در حد سه کلمه (مثال : نصب اپ اسنپ)</span>  --}}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-control-wrap">
                        <input type="text" name="call_to_action" class="form-control  form-control-outlined" value="{{ old("call_to_action") }}" id="call_to_action">
                        <label class="form-label-outlined" for="call_to_action">پیام اقدام به دعوت</label>
                    </div>
                </div>

            </div>
            <div class="row mb-4">
                <div class="col-lg-8">
                    <div class="form-control-wrap">
                        <input type="text" name="landing_link1" class="form-control  form-control-outlined" value="{{ old("landing_link1") }}" id="landing_link1">
                        <label class="form-label-outlined" for="landing_link1">لینک صفحه فرود</label>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-control-wrap">
                        <input type="text" name="landing_title1" class="form-control  form-control-outlined" value="{{ old("landing_title1") }}" id="landing_title1">
                        <label class="form-label-outlined" for="landing_title1">متن دکمه اقدام</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="text text-info">
                        تعیین کنید این تبلیغ در چه سایتهایی نمایش داده شود ؟ اگر محصول یا خدمات شما برای تمام اقشار جامعه مناسب است، هیچ دسته بندی را انتخاب نکنید .
                    </h5>
                    <ul class="custom-control-group">
                        @foreach (App\Models\Cat::all() as $cat )
                        <li>
                            <div class="custom-control custom-checkbox custom-control-pro no-control checked">
                                <input type="checkbox" class="custom-control-input" value="{{ $cat->id }}" {{ in_array($cat->id,old("cats",[]))?"checked":"" }} name="cats[]" name="btnCheck" id="btnCheck{{ $cat->id }}">
                                <label class="custom-control-label" for="btnCheck{{ $cat->id }}">{{ $cat->name }}</label>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-4">
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
            </div>

            <br>
            @include('advertiser.price_temp')


{{--
            <div class="dashboard_site_form">
                <div class="flex_tworow">
                    <p>
                        <label for="title">عنوان </label>
                        <input type="text" id="title" name="title" value="{{ old("title") }}">
                    </p>
                </div>


                <p>
                    <label for="video1">آپلود ویدیو</label>
                    <input type="file" id="video1" name="video1" accept=".mp4">
                    <span>فرمت ویدیو mp4 و در ابعاد 720 در 480 باشد. حداکثر حجم ویدیو 20 مگابایت باشد.</span>
                </p>


                <div class="row">
                    <div class="col-lg-6">
                        <p class="span_block">
                            <label for="landing_link1">لینک صفحه ورود

                            </label>
                            <input type="url" id="landing_link1" name="landing_link1" value="{{ old("landing_link1") }}">
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <p>
                            <label for="landing_title1">متن دکمه اقدام </label>
                            <input type="text" id="landing_title1" name="landing_title1" value="{{ old("landing_title1") }}">
                        </p>
                    </div>

                </div>


                <p>
                    <label for="call_to_action">پیام اقدام به دعوت </label>
                    <input type="text" id="call_to_action" name="call_to_action" value="{{ old("call_to_action") }}">
                    <span>
                        بعد از دکمه اقدام نمایش داده میشود. (مانند: ظرفیت محدود)
                    </span>
                </p>

                <h2 class="title_right">هدفمندسازی تبلیغات</h2>

                <p class="span_block">
                    <label for="appads_sites">تعیین کنید این تبلیغ در چه سایتهایی نمایش داده شود ؟</label>
                    <span>اگر محصول یا خدمات شما برای تمام اقشار جامعه مناسب است، هیچ دسته بندی را انتخاب نکنید .</span>
                    @foreach (App\Models\Cat::all() as $cat )
                    <input type="checkbox" id="bnrxads_i2" value="{{ $cat->id }}" {{ in_array($cat->id,old("cats",[]))?"checked":"" }} name="cats[]">
                    <label for="bnrxads_i2">{{ $cat->name }}</label>
                    @endforeach
                </p>

                <h2 class="title_right">مدل قیمت گذاری</h2>

                <div class="flex_threerow">

                    <p>
                        <input type="radio" id="cpc_paymethod" name="count_type" {{ old("count_type")=="click"?"checked":"" }} value="click">
                        <label for="cpc_paymethod">هزینه به ازای هر کلیک (CPC)</label>
                        <span>هزینه هر کلیک 500 تومان</span>
                    </p>

                    <p>
                        <label for="click_count">تعداد کلیک</label>
                        <input type="number" id="click_count" name="click_count" class="cal_p" value="{{ old("click_count") }}" data-price="{{ $click }}">
                        <span>حداقل سفارش : 2000 کلیک</span>
                        <span>هزینه :
                            <span class="totoal_price_click">{{ number_format(old("click_count")*$click ) }}</span>
                            تومان</span>
                    </p>

                    <p>
                        <label for="limit_daily_click">محدودیت کلیک روزانه</label>
                        <input type="number" id="limit_daily_click" name="limit_daily_click" value="{{ old("limit_daily_click") }}">
                        <span>تعداد دفعاتی که میخواهید این تبلیغ در روز کلیک دریافت کند.</span>
                        <span>برای غیرفعال کردن این محدودیت 0 وارد کنید.</span>
                    </p>

                </div>

                <div class="flex_threerow">
                    <p>
                        <input type="radio" id="cpv_paymethod" name="count_type" {{ old("count_type")=="view"?"checked":"" }} value="view">
                        <label for="cpv_paymethod">هزینه به ازای هر بازدید (CPV)</label>
                        <span>هزینه هر نمایش 30 تومان</span>
                    </p>
                    <p>
                        <label for="view_count">تعداد نمایش</label>
                        <input type="number" id="view_count" name="view_count" class="cal_p" value="{{ old("view_count") }}" data-price="{{ $view }}">
                        <span>حداقل سفارش : 2000 نمایش</span>
                        <span>هزینه :
                            <span class="totoal_price_view">{{ number_format(old("view_count")*$view) }}</span>
                            تومان</span>
                    </p>

                    <p>
                        <label for="limit_daily_view">محدودیت نمایش روزانه</label>
                        <input type="number" id="limit_daily_view" name="limit_daily_view" value="{{ old("limit_daily_view") }}">
                        <span>تعداد دفعاتی که میخواهید این تبلیغ در روز کلیک دریافت کند.</span>
                        <span>برای غیرفعال کردن این محدودیت 0 وارد کنید.</span>
                    </p>
                </div>
                <p>
                    <label for="device">تبلیغ در چه دستگاهی نمایش داده شود ؟</label>
                    <select id="site_category" class="form-control" name="device">
                        <option value="">انتخاب کنید </option>
                        <option {{ old("device")=="mobile"?"selected":"" }} value="mobile">موبایل</option>
                        <option {{ old("device")=="computer"?"selected":"" }} value="computer">کامپیوتر</option>
                        <option {{ old("device")=="mobile_computer"?"selected":"" }} value="mobile_computer">موبایل و کامپیوتر</option>
                    </select>
                </p>

                <div class="card_pay_box">
                    <p>مجموع هزینه : <span class="totoal_price">
                            @if(old("count_type")=="click")
                            {{number_format( old("click_count")*$click)." تومان" }}
                            @endif
                            @if(old("count_type")=="view")
                            {{number_format( old("view_count")*$view)." تومان" }}
                            @endif

                        </span></p>
                    <p>4.5 درصد مالیات بر ارزش افزوده</p>
                    @if( old("count_type"))
                    <p>مجموع هزینه <span class="after_tax_price">
                            @if(old("count_type")=="click")
                            {{(number_format( (old("click_count")*$click)+ (( old("click_count")*$click*4.5)/100)))." تومان" }}
                            @endif
                            @if(old("count_type")=="view")
                            {{(number_format( (old("view_count")*$view)+ (( old("view_count")*$view*4.5)/100)))." تومان" }}
                            @endif
                        </span> </p>
                    @else
                    <p>مجموع هزینه <span class="after_tax_price">
                            @endif
                            <p>
                                <span>انتخاب روش پرداخت:</span>
                                <input type="radio" id="acc_money" name="pay_type" {{ old("pay_type")=="acc_money"?"checked":"" }} value="acc_money">
                                <label for="acc_money">موجودی شارژ شده</label>
                                <input type="radio" id="bank_pay" name="pay_type" {{ old("pay_type")=="bank_pay"?"checked":"" }} value="bank_pay">
                                <label for="bank_pay">درگاه بانک ملت</label><br>
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
