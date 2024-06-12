<div class="row mb-4">
    <div class="ol-lg-12 mb-4">
        {{-- <p class="bg bg-outline-danger">
            <i class="fa fa-info-circle"></i>
            این نوع تبلیغ تنها در پشت پنجره کاربر نمایش داده میشود و وارد کردن لینک کانال روبیکا، تلگرام و پیج اینستاگرام ممنوع است.
          </p>  --}}
        <p class="bg bg-outline-warning">
            <i class="fa fa-info-circle"></i>
            می توانید در یک یا دو سایز متفاوت تبلیغات بنری خود را ایجاد کنید
        </p>
    </div>
    <div class="col-lg-4">
        <div class="form-control-wrap">
            <input type="text" name="title" class="form-control titl_f form-control-outlined" value="{{ old("title",$advertise->title) }}" id="title">
            <label class="form-label-outlined" for="title">عنوان </label>
            {{--  <span class="info_txt">در حد سه کلمه (مثال : نصب اپ اسنپ)</span>  --}}
        </div>
    </div>

    <div class="col-lg-8">
        <div class="form-control-wrap">
            <input type="text" name="landing_link1" class="form-control  form-control-outlined"  value="{{ old("landing_link1",$advertise->landing_link1) }}" id="landing_link1">
            <label class="form-label-outlined" for="landing_link1">لینک صفحه فرود</label>
        </div>
    </div>

</div>



<div class="row mb-4">
    {{--  <div class="col-lg-6">
        <div class="form-group">
            <label class="form-label" for="default-06">آپلود آیکون</label>
            <div class="form-control-wrap">
                <div class="form-file">
                    <input type="file" id="icon" name="icon" class="form-file-input" accept="image/png, image/jpeg">
                    <label class="form-file-label" for="icon"></label>
                    <span class="info_txt">ابعاد آیکوون 32 در 32 پیکسل باشد.</span>
                </div>
            </div>
        </div>
    </div>  --}}


    <div class="col-lg-6">
        <div class="form-group">
            <label class="form-label" for="default-06">آپلود فایل  بنر</label>
            <div class="form-control-wrap">
                <div class="form-file">
                    <input type="file" id="banner1" name="banner1" class="form-file-input" accept="image/png, image/jpeg">
                    <label class="form-file-label" for="customFile"></label>
                    <span class="info_txt">
                        سایز متناسب ستون کناری سایت ها
                        عرض :۳۰۰
                        ارتفاع: ۱۶۰ و بیشتر حتی
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="form-label" for="default-06">آپلود فایل  بنر</label>
            <div class="form-control-wrap">
                <div class="form-file">
                    <input type="file" id="banner2" name="banner2" class="form-file-input" accept="image/png, image/jpeg">
                    <label class="form-file-label" for="customFile"></label>
                    <span class="info_txt">
                        سایز متناسب قبل یا بعد از نمایش مطالب


                        عرض : ۸۰۰
                        ارتفاع : ۱۳۱
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
