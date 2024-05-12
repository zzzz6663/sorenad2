@php
$tax_percent_page_ad=App\Models\Setting::whereName("tax_percent_page_ad")->first()->val;
$tax_percent_page_ad=App\Models\Setting::whereName("tax_percent_page_ad")->first()->val;
$min_chanal_price=2000000;
$final= (old("click_count")* old("price_suggestion"))     +((old("click_count")* old("price_suggestion"))*$tax_percent_page_ad)/100;
@endphp
@if($type=="chanal")
<div class="row mb-4">
    <div class="col-lg-12">
        <h5 class="text text-secondary">
            مدل قیمت گذاری
        </h5>
    </div>
    <br>
    <br>
    {{--  chanal_advertiser_atlist_count

    chanal_advertiser_atlist_price  --}}
    <div class="col-lg-4">
        <div class="form-control-wrap {{  $type=="chanal"?"focused":""}} ">
            <input type="number" name="click_count" id="click_count" min="{{ $min_click }}" required class="form-control click_inp  form-control-outlined cal_p" value="{{ old("click_count") }}" data-price="{{ $chanal_advertiser_atlist_price }}" id="click_count">
            <label class="form-label-outlined" for="click_count">
                تعداد کلیک
            </label>
            {{--  <span class="input-group-text  ">
                {{ number_format(old("click_count") ) }}

            </span>  --}}
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-control-wrap {{  $type=="chanal"?"focused":""}} ">
            <input type="number" name="price_suggestion" id="price_suggestion" min="{{ $min_sugestion_price }}" class="form-control click_inp  form-control-outlined cal_p" value="{{ old("price_suggestion") }}" data-price="{{ $chanal_advertiser_atlist_price }}" id="price_suggestion">
            <label class="form-label-outlined" for="price_suggestion">
                قیمت پیشنهادی برای هر کلیک
            </label>
            {{--  <span class="input-group-text  ">
                {{ number_format(old("price_suggestion") ) }}
                تومان
            </span>  --}}
        </div>
    </div>
</div>
@else
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
                            {{ $user->click_price($type) }}
                            تومان</span>
                    </label>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-control-wrap {{  $type=="chanal"?"focused":""}} ">
                    <input type="number" name="click_count" id="click_count" class="form-control click_inp  form-control-outlined cal_p" {{ old("click_count")?"":"disabled" }} value="{{ old("click_count") }}" data-price="{{ $click }}" id="click_count">
                    <label class="form-label-outlined" for="click_count">
                        تعداد کلیک
                    </label>
                    <span class="input-group-text  ">
                        {{ number_format(old("click_count")*$click ) }}
                        تومان
                    </span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-control-wrap ">
                    <input type="number" name="limit_daily_click" id="limit_daily_click" class="form-control click_inp  form-control-outlined cal_p" {{ old("click_count")?"":"disabled" }} value="{{ old("limit_daily_click") }}" id="limit_daily_click">
                    <label class="form-label-outlined" for="limit_daily_click">
                        محدودیت تعداد کلیک این تبلیغ در روز
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
                            {{ $user->view_price($type) }}
                            تومان</span>
                    </label>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="form-control-wrap">
                    <input type="number" name="view_count" id="view_count" class="form-control view_inp form-control-outlined cal_p" {{ old("view_count")?"":"disabled" }} value="{{ old("view_count") }}" data-price="{{ $view }}" id="view_count">
                    <label class="form-label-outlined" for="view_count">
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
                    <input type="number" name="limit_daily_view" id="limit_daily_view" class="form-control view_inp form-control-outlined cal_p" {{ old("limit_daily_view")?"":"disabled" }} value="{{ old("limit_daily_view") }}" id="limit_daily_view">
                    <label class="form-label-outlined" for="limit_daily_view">

                        محدودیت تعداد نمایش این تبلیغ در روز
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
@endif

<div class="row mb-3  card-inner card-bordered">
    <div class="col-lg-6">
        <h4 class="text ">مجموع هزینه : <span class="totoal_price">

                @if($type=="chanal")
                {{ number_format(old("click_count")* old("price_suggestion")) }}
تومان
                @else



                @if(old("count_type")=="click")
                {{number_format( old("click_count")*$click)." تومان" }}
                @endif
                @if(old("count_type")=="view")
                {{number_format( old("view_count")*$view)." تومان" }}
                @endif



                @endif

            </span></h4>
        <p>
            مالیات بر ارزش افزوده
            {{ $tax_percent_page_ad }}
            درصد
        </p>






        @if( old("count_type"))
        <h4 class="text text text-primary ">
            قیمت نهایی:
            <span class="after_tax_price">
                @if(old("count_type")=="click")
                {{(number_format($p_ch= (old("click_count")*$click)+ (( old("click_count")*$click*$tax_percent_page_ad)/100)))." تومان" }}
                @endif
                @if(old("count_type")=="view")
                {{(number_format( (old("view_count")*$view)+ (( old("view_count")*$view*$tax_percent_page_ad)/100)))." تومان" }}
                @endif
            </span> </h4>
        @else
        <h4 class="text text-primary">
            قیمت نهایی:
            <span class="after_tax_price">
                @if( old("price_suggestion"))
                {{ number_format(    $final) }}
                تومان
                @endif
            </span>
        </h4>
        @endif





        <button class="btn btn-primary" id="{{  $type=="chanal"?"pay_chanal":""}}" data-p="{{$final}}"
        style="display: {{  $type=="chanal"?"none":""}}; ">
            <i class="fas fa-shopping-cart"></i>
            پرداخت
        </button>
    </div>
    <div class="col-lg-6">
        <span>انتخاب روش پرداخت:</span>

        <ul class="custom-control-group custom-control-vertical w-100 ">
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
