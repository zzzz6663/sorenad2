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
    <div class="col-lg-4">
        <div class="form-control-wrap">
            <input type="text" name="title" class="form-control  form-control-outlined" value="{{ old("title",$advertise->title) }}" id="title">
            <label class="form-label-outlined" for="title">عنوان </label>
            {{-- <span class="info_txt">در حد سه کلمه (مثال : نصب اپ اسنپ)</span>  --}}
        </div>
    </div>
    <div class="col-lg-8">
        <div class="form-control-wrap">
            <input type="text" name="text" class="form-control  form-control-outlined" value="{{ old("text",$advertise->text) }}" id="text">
            <label class="form-label-outlined" for="text">متن تبلیغ</label>
        </div>
    </div>
</div>
<div class="row mb-4">
    <div class="col-lg-8">
        <div class="form-control-wrap">
            <input type="text" name="landing_link1" class="form-control  form-control-outlined" value="{{ old("landing_link1",$advertise->landing_link1) }}" id="landing_link1">
            <label class="form-label-outlined" for="landing_link1">لینک صفحه فرود</label>
        </div>
    </div>


    <div class="col-lg-4">
        {{--  <div class="form-control-wrap">
            <input type="text" name="call_to_action" class="form-control  form-control-outlined" value="{{ old("call_to_action") }}" id="call_to_action">
            <label class="form-label-outlined" for="call_to_action">پیام اقدام به دعوت</label>
        </div>  --}}
    </div>
</div>
