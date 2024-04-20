
<div class="row mb-4">
    <div class="ol-lg-12 mb-4">

        <p class="bg bg-outline-success">
            <i class="fa fa-info-circle"></i>
            این نوع تبلیغ فقط در موبایل نمایش داده میشود و برای افزایش نصب اپلیکیشن اندروید مناسب است.
        </p>
    </div>
    <div class="col-lg-4">
        <div class="form-control-wrap">
            <input type="text" name="title" class="form-control  form-control-outlined" value="{{ old("title",$advertise->title) }}" id="title">
            <label class="form-label-outlined" for="title">عنوان برنامه</label>
            <span class="info_txt">در حد سه کلمه (مثال : نصب اپ اسنپ)</span>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="form-control-wrap">
            <input type="text" name="info" class="form-control  form-control-outlined" value="{{ old("info",$advertise->info) }}" id="info">
            <label class="form-label-outlined" for="info">متن کوتاه توضیحات</label>
            <span class="info_txt">در حد 5 کلمه برای کاربر توضیح دهید چرا باید این اپ را نصب کند. (مثلا : دانلود فیلم و سریال رایگان)</span>
        </div>
    </div>

</div>


<div class="row mb-4">
    <div class="col-lg-6">
        <div class="form-control-wrap">
            <input type="text" name="landing_link1" class="form-control  landing_title  form-control-outlined" value="{{ old("landing_link1",$advertise->landing_link1) }}" id="landing_link1">
            <label class="form-label-outlined" for="landing_link1">
                لینک دانلود برنامه 1
            </label>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-control-wrap">
            <input type="text" name="landing_title1" class="form-control landing_title  form-control-outlined" value="{{ old("landing_title1",$advertise->landing_title1) }}" id="landing_title1">
            <label class="form-label-outlined" for="landing_title1">
                متن دکمه دانلود1
            </label>
            <span class="info_txt">در حد دو کلمه (مانند : دانلود رایگان / دانلود بازار)</span>
        </div>
    </div>
</div>
<div class="row mb-4">
    <div class="col-lg-6">
        <div class="form-control-wrap">
            <input type="text" name="landing_link2" class="form-control  landing_title  form-control-outlined" value="{{ old("landing_link2",$advertise->landing_link2) }}" id="landing_link2">
            <label class="form-label-outlined" for="landing_link2">
                لینک دانلود برنامه 2
            </label>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-control-wrap">
            <input type="text" name="landing_title2" class="form-control  landing_title form-control-outlined" value="{{ old("landing_title2",$advertise->landing_title2) }}" id="landing_title2">
            <label class="form-label-outlined" for="landing_title2">
                متن دکمه دانلود2
            </label>
            <span class="info_txt">در حد دو کلمه (مانند : دانلود رایگان / دانلود بازار)</span>
        </div>
    </div>
</div>


<div class="row mb-4">
    <div class="col-lg-6">
        <div class="form-control-wrap">
            <input type="text" name="landing_link3" class="form-control landing_title  form-control-outlined" value="{{ old("landing_link3",$advertise->landing_link3) }}" id="landing_link3">
            <label class="form-label-outlined" for="landing_link3">
                لینک دانلود برنامه 3
            </label>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-control-wrap">
            <input type="text" name="landing_title3" class="form-control landing_title  form-control-outlined" value="{{ old("landing_title3",$advertise->landing_title3) }}" id="landing_title3">
            <label class="form-label-outlined" for="landing_title3">
                متن دکمه دانلود3
            </label>
            <span class="info_txt">در حد دو کلمه (مانند : دانلود رایگان / دانلود بازار)</span>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg-6">
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
    </div>

</div>
