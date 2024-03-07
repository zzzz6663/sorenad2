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
                    <input type="radio" id="bank_pay" name="pay_type" class="custom-control-input"  {{ old("pay_type")=="bank_pay"?"checked":"" }} value="bank_pay">

                    <label class="custom-control-label" for="bank_pay"> <em class="icon text text-primary icon-lg ni ni-cc-mc"></em><span>درگاه بانک</span> </label>
                </div>
            </li>

        </ul>
    </div>
</div>
