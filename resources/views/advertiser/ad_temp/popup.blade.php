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
            <input type="text" name="title" class="form-control  form-control-outlined"  value="{{ old("title",$advertise->title) }}" id="title">
            <label class="form-label-outlined" for="title">عنوان تبلیغ</label>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-control-wrap">
            <input type="text" name="landing_link1" class="form-control  form-control-outlined"  value="{{ old("landing_link1",$advertise->landing_link1) }}" id="landing_link1">
            <label class="form-label-outlined" for="landing_link1">لینک صفحه فرود</label>
        </div>
    </div>

</div>
@if($price)

<div class="row mb-3">

    <div class="col-lg-6">
        <input type="text"   id="price" value="{{ $price }}" hidden>
        <div class="form-control-wrap">
            <input type="number" name="order_count" class="form-control  form-control-outlined" id="order_count" data-price="{{ $price }}"  value="{{ old("order_count") }}" placeholder="">
            <label class="form-label-outlined" for="order_count">
                تعداد سفارش
                ( حداقل سفارش 10000 عدد)
            </label>
            <span class="input-group-text totoal_price">
                {{number_format( old("order_count")*$price)." تومان" }}
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
@endif

<div class="row mb-3">
    @include('advertiser.device_temp')
    <div class="col-lg-6"></div>
</div>
