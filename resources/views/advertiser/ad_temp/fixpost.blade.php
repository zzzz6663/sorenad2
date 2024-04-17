

<div class="row mb-4">
    <div class="col-lg-6 mb-4">
        {{-- <p class="bg bg-outline-danger">
            <i class="fa fa-info-circle"></i>
            این نوع تبلیغ تنها در پشت پنجره کاربر نمایش داده میشود و وارد کردن لینک کانال روبیکا، تلگرام و پیج اینستاگرام ممنوع است.
          </p>  --}}
        <p class="bg bg-outline-success">
            <i class="fa fa-info-circle"></i>
            این نوع تبلیغ فقط در موبایل نمایش داده میشود و برای افزایش نصب اپلیکیشن اندروید مناسب است.
        </p>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="form-control-wrap">
            <label class="form-label-outlined" for="title">عنوان </label>

            <input type="text" name="title" class="form-control  form-control-outlined" value="{{ old("title",$advertise->title) }}" id="title">
            {{-- <span class="info_txt">در حد سه کلمه (مثال : نصب اپ اسنپ)</span>  --}}
        </div>
    </div>
    <div class="col-lg-12 mb-4">
        <div class="form-control-wrap">
            <h54>
                متن کوتاه توضیحات
            </h54>
            <label class="form-label-outlined" for="info">متن کوتاه توضیحات</label>
            <textarea name="info" id="tiny" cols="5" rows="5">{!!  old("info",$advertise->info) !!}</textarea>
        </div>
    </div>
</div>


<div class="row mb-4">
    @include('advertiser.device_temp')

    <div class="col-lg-4">
        <div class="form-group">
            <label class="form-label" for="default-06">رنگ پس زمینه تبلیغ</label>
            <div class="form-control-wrap">
                <div class="form-file">
                    <input type="color" id="bg_color" name="bg_color" value="{{ old("bg_color",$advertise->bg_color) }}" class="form-control  form-control-outlined" >
                    <label class="file-label" for="customFile"></label>
                </div>
            </div>
        </div>
    </div>
    {{--  <div class="col-lg-4">
        <div class="form-group">
            <label class="form-label" for="default-06">آپلود فایل بنر</label>
            <div class="form-control-wrap">
                <div class="form-file">
                    <input type="file" id="banner1" name="banner1" class="form-file-input" accept="image/png, image/jpeg">
                    <label class="form-file-label" for="customFile"></label>
                    <span class="info_txt">ابعاد بنر برنامه 554 در 276 پیکسل باشد.</span>
                </div>
            </div>
        </div>
    </div>  --}}
    <div class="col-lg-4">
        <br>
        <div class="form-control-wrap">
            <input type="text" name="landing_title1" class="form-control  form-control-outlined" value="{{ old("landing_title1",$advertise->landing_title1) }}" id="landing_title1">
            <label class="form-label-outlined" for="landing_title1">متن دکمه اقدام</label>
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
        <div class="form-control-wrap">
            <input type="text" name="call_to_action" class="form-control  form-control-outlined" value="{{ old("call_to_action",$advertise->call_to_action) }}" id="call_to_action">
            <label class="form-label-outlined" for="call_to_action">پیام اقدام به دعوت</label>
        </div>
    </div>
</div>
