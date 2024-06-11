

@if($price)
<div class="row mb-3">
    <div class="col-lg-6">
        <input type="text" name="count_type" value="view" hidden>
        <input type="text"   id="price" value="{{ $price }}" hidden>
        <div class="form-control-wrap">
            <input type="number" name="view_count" class="form-control order_count  form-control-outlined" id="view_count" data-price="{{ $price }}"  value="{{ old("view_count",$advertise->view_count) }}" placeholder="">
            <label class="form-label-outlined" for="view_count">
                تعداد سفارش
                ( حداقل سفارش 10000 عدد)
            </label>
            <span class="input-group-text totoal_price">
                {{number_format( old("view_count",$advertise->view_count)*$price)." تومان" }}
            </span>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-control-wrap">
            <input type="number" name="limit_daily_view" class="form-control  form-control-outlined"  value="{{ old("limit_daily_view",$advertise->limit_daily_view) }}" id="limit_daily_view">
            <label class="form-label-outlined" for="limit_daily_view">محدودیت دفعات نمایش</label>
            <span class="input-group-text ">
                برای نامحدود بودن خالی بگذارید
            </span>
        </div>
    </div>
</div>
@endif
<input type="text" name="order_count" class="order_count"  hidden value="{{ old("order_count",$advertise->order_count) }}">


<div class="row mb-3  card-inner card-bordered">
    <div class="col-lg-6">
        <p>مجموع هزینه : <span class="totoal_price">{{number_format( old("view_count")*$price)." تومان" }}</span></p>
        <p>
            4.5 درصد مالیات بر ارزش افزوده:
        </p>
        <h4 class="text-primary">قیمت نهایی:
            <span class="after_tax_price">
        @if( old("view_count"))
        <h4>
            قیمت نهایی:
            <span class="after_tax_price">{{(number_format( (old("view_count")*$price)+ (( old("view_count")*$price*4.5)/100)))." تومان" }}</span> </h4>
        @endif
        </span> </h4>
        {{--  <button class="btn btn-primary">
            <i class="fas fa-shopping-cart"></i>
            پرداخت
        </button>  --}}
    </div>
    <div class="col-lg-6">
        <span>انتخاب روش پرداخت:</span>

        <ul class="custom-control-group custom-control-vertical w-100">
            <li>
                <div class="custom-control custom-control-sm custom-radio custom-control-pro checked">
                    <input type="radio" id="acc_money{{ $type }}" class="custom-control-input" name="pay_type" {{ old("pay_type")=="acc_money"?"checked":"" }} value="acc_money">
                    <label class="custom-control-label" for="acc_money{{ $type }}"> <em class="icon text text-primary icon-lg ni ni-cc-paypal"></em><span>موجودی شارژ شده</span> </label>
                </div>
            </li>
            <li>
                <div class="custom-control custom-control-sm custom-radio custom-control-pro">
                    <input type="radio" id="bank_pay{{ $type }}" name="pay_type" class="custom-control-input"  {{ old("pay_type")=="bank_pay"?"checked":"" }} value="bank_pay">

                    <label class="custom-control-label" for="bank_pay{{ $type }}"> <em class="icon text text-primary icon-lg ni ni-cc-mc"></em><span>درگاه بانک</span> </label>
                </div>
            </li>

        </ul>
    </div>
</div>
