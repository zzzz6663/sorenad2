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
            <input type="text" name="title" class="form-control  form-control-outlined titl_f"  value="{{ old("title",$advertise->title) }}" id="title">
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
