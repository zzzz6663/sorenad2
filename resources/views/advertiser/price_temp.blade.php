{{--  
<div class="row mb-4">
    <div class="col-lg-12">
        <h5 class="text text-secondary">
            مدل قیمت گذاری
        </h5>
        <div class="row mb-5">
            <div class="col-lg-4">
                <div class="custom-control custom-checkbox custom-control-pro no-control">
                    <input type="radio" id="cpc_paymethod" class="custom-control-input" name="count_type" {{ old("count_type")=="click"?"checked":"" }} value="click">
                    <label class="custom-control-label " for="cpc_paymethod">
                        <div class="text text-primary">
                            <i class="fas fa-mouse-pointer "></i>
                            <span>
                                هزینه به ازای هر کلیک (CPC)
                            </span>
                        </div>
                        <br>
                        <span>هزینه هر کلیک
                            {{ $user->click_price() }}
                            تومان</span>
                    </label>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="form-control-wrap">
                    <input type="number" name="click_count" id="click_count" class="form-control  form-control-outlined cal_p" value="{{ old("click_count") }}" data-price="{{ $click }}" id="click_count">
                    <label class="form-label-outlined" for="landing_link3">
                        تعداد کلیک
                    </label>
                    <span class="input-group-text totoal_price_click ">
                        {{ number_format(old("click_count")*$click ) }}
                        تومان
                    </span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-control-wrap">
                    <input type="number" name="limit_daily_click" id="limit_daily_click" class="form-control  form-control-outlined cal_p" value="{{ old("limit_daily_click") }}" id="limit_daily_click">
                    <label class="form-label-outlined" for="limit_daily_click">
                        محدودیت تعداد
                        کلیک
                    </label>
                    <span class="input-group-text   ">
                        <span class="info_txt">
                            <span>برای بی نهایت خالی بگذارید </span>
                        </span>
                    </span>
                </div>

            </div>
        </div>

        <div class="row mb-5">
            <div class="col-lg-4">
                <div class="custom-control custom-checkbox custom-control-pro no-control">
                    <input type="radio" id="cpv_paymethod" class="custom-control-input" name="count_type" {{ old("count_type")=="view"?"checked":"" }} value="view">
                    <label class="custom-control-label " for="cpv_paymethod">
                        <div class="text text-primary">
                            <i class="fas fa-mouse-pointer "></i>
                            <span>
                                هزینه به ازای هر بازدید (CPV)
                            </span>
                        </div>
                        <br>
                        <span>هزینه هر نمایش
                            {{ $user->view_price() }}
                            تومان</span>
                    </label>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="form-control-wrap">
                    <input type="number" name="view_count" id="view_count" class="form-control  form-control-outlined cal_p" value="{{ old("view_count") }}" data-price="{{ $view }}" id="view_count">
                    <label class="form-label-outlined" for="landing_link3">
                        تعداد نمایش
                    </label>
                    <span class="input-group-text totoal_price_view ">
                        {{ number_format(old("view_count")*$view ) }}
                        تومان
                    </span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-control-wrap">
                    <input type="number" name="limit_daily_view" id="limit_daily_view" class="form-control  form-control-outlined cal_p" value="{{ old("limit_daily_view") }}" id="limit_daily_view">
                    <label class="form-label-outlined" for="limit_daily_view">
                        محدودیت تعداد
                        نمایش
                    </label>
                    <span class="input-group-text   ">
                        <span class="info_txt">
                            <span>برای بی نهایت خالی بگذارید </span>
                        </span>
                    </span>
                </div>

            </div>
        </div>
    </div>
</div>  --}}

<div class="row mb-4">
    <div class="col-lg-12">
        <h5 class="text text-secondary">
            مدل قیمت گذاری
        </h5>
        <div class="row mb-5">
            <div class="col-lg-4">
                <div class="custom-control custom-checkbox custom-control-pro no-control">
                    <input type="radio" id="cpc_paymethod" class="custom-control-input" name="count_type" {{ old("count_type")=="click"?"checked":"" }} value="click">
                    <label class="custom-control-label " for="cpc_paymethod">
                        <div class="text text-primary">
                            <i class="fas fa-mouse-pointer "></i>
                            <span>
                                هزینه به ازای هر کلیک (CPC)
                            </span>
                        </div>
                        <br>
                        <span>هزینه هر کلیک
                            {{ $user->click_price() }}
                            تومان</span>
                    </label>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="form-control-wrap">
                    <input type="number" name="click_count" id="click_count" class="form-control  form-control-outlined cal_p" value="{{ old("click_count") }}" data-price="{{ $click }}" id="click_count">
                    <label class="form-label-outlined" for="landing_link3">
                        تعداد کلیک
                    </label>
                    <span class="input-group-text totoal_price_click ">
                        {{ number_format(old("click_count")*$click ) }}
                        تومان
                    </span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-control-wrap">
                    <input type="number" name="limit_daily_click" id="limit_daily_click" class="form-control  form-control-outlined cal_p" value="{{ old("limit_daily_click") }}" id="limit_daily_click">
                    <label class="form-label-outlined" for="limit_daily_click">
                        محدودیت تعداد
                        کلیک
                    </label>
                    <span class="input-group-text   ">
                        <span class="info_txt">
                            <span>برای بی نهایت خالی بگذارید </span>
                        </span>
                    </span>
                </div>

            </div>
        </div>

        <div class="row mb-5">
            <div class="col-lg-4">
                <div class="custom-control custom-checkbox custom-control-pro no-control">
                    <input type="radio" id="cpv_paymethod" class="custom-control-input" name="count_type" {{ old("count_type")=="view"?"checked":"" }} value="view">
                    <label class="custom-control-label " for="cpv_paymethod">
                        <div class="text text-primary">
                            <i class="fas fa-mouse-pointer "></i>
                            <span>
                                هزینه به ازای هر بازدید (CPV)
                            </span>
                        </div>
                        <br>
                        <span>هزینه هر نمایش
                            {{ $user->view_price() }}
                            تومان</span>
                    </label>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="form-control-wrap">
                    <input type="number" name="view_count" id="view_count" class="form-control  form-control-outlined cal_p" value="{{ old("view_count") }}" data-price="{{ $view }}" id="view_count">
                    <label class="form-label-outlined" for="landing_link3">
                        تعداد نمایش
                    </label>
                    <span class="input-group-text totoal_price_view ">
                        {{ number_format(old("view_count")*$view ) }}
                        تومان
                    </span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-control-wrap">
                    <input type="number" name="limit_daily_view" id="limit_daily_view" class="form-control  form-control-outlined cal_p" value="{{ old("limit_daily_view") }}" id="limit_daily_view">
                    <label class="form-label-outlined" for="limit_daily_view">
                        محدودیت تعداد
                        نمایش
                    </label>
                    <span class="input-group-text   ">
                        <span class="info_txt">
                            <span>برای بی نهایت خالی بگذارید </span>
                        </span>
                    </span>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="row mb-3  card-inner card-bordered">
    <div class="col-lg-6">
        <h4 class="text ">مجموع هزینه : <span class="totoal_price">
                @if(old("count_type")=="click")
                {{number_format( old("click_count")*$click)." تومان" }}
                @endif
                @if(old("count_type")=="view")
                {{number_format( old("view_count")*$view)." تومان" }}
                @endif

            </span></h4>
        <p>4.5 درصد مالیات بر ارزش افزوده</p>
        @if( old("count_type"))
        <h4 class="text text text-primary ">
            قیمت نهایی:
            <span class="after_tax_price">
                @if(old("count_type")=="click")
                {{(number_format( (old("click_count")*$click)+ (( old("click_count")*$click*4.5)/100)))." تومان" }}
                @endif
                @if(old("count_type")=="view")
                {{(number_format( (old("view_count")*$view)+ (( old("view_count")*$view*4.5)/100)))." تومان" }}
                @endif
            </span> </h4>
        @else
        <h4 class="text text-primary">
            قیمت نهایی:
            <span class="after_tax_price">
            </span>
        </h4>
        @endif
        <button class="btn btn-primary">
            <i class="fas fa-shopping-cart"></i>
            پرداخت
        </button>
    </div>
    <div class="col-lg-6">
        <span>انتخاب روش پرداخت:</span>

        <ul class="custom-control-group custom-control-vertical w-100">
            <li>
                <div class="custom-control custom-control-sm custom-radio custom-control-pro checked">
                    <input type="radio" id="acc_money" class="custom-control-input" name="pay_type" {{ old("pay_type")=="acc_money"?"checked":"" }} value="acc_money">
                    <label class="custom-control-label" for="acc_money"> <em class="icon text text-primary icon-lg ni ni-cc-paypal"></em><span>موجودی شارژ شده</span> </label>
                </div>
            </li>
            <li>
                <div class="custom-control custom-control-sm custom-radio custom-control-pro">
                    <input type="radio" id="bank_pay" name="pay_type" class="custom-control-input" {{ old("pay_type")=="bank_pay"?"checked":"" }} value="bank_pay">

                    <label class="custom-control-label" for="bank_pay"> <em class="icon text text-primary icon-lg ni ni-cc-mc"></em><span>درگاه بانک</span> </label>
                </div>
            </li>

        </ul>
    </div>
</div>
