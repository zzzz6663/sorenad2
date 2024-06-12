

<div class="row mb-4">
    <div class="col-lg-12 mb-4">
        {{-- <p class="bg bg-outline-danger">
            <i class="fa fa-info-circle"></i>
            این نوع تبلیغ تنها در پشت پنجره کاربر نمایش داده میشود و وارد کردن لینک کانال روبیکا، تلگرام و پیج اینستاگرام ممنوع است.
          </p>  --}}
        {{--  <p class="bg bg-outline-warning">
            <i class="fa fa-info-circle"></i>
            ترکیبی از عکس + متن و دکمه اقدام به عمل را با این سبک تبلیغ ایجاد کنید.        </p>  --}}
    </div>

</div>


<div class="row mb-4">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="form-control-wrap">
                        <h54>
                            متن کوتاه توضیحات
                        </h54>
                        <label class="form-label-outlined" for="info">متن کوتاه توضیحات</label>
                        <textarea name="info" id="tiny" class="info_f" cols="1" rows="1">{!!  old("info",$advertise->info) !!}</textarea>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <br>
                    <div class="form-control-wrap">
                        <input type="text" name="title" class="form-control titl_f form-control-outlined" value="{{ old("title",$advertise->title) }}" id="title">
                        <label class="form-label-outlined" for="title">عنوان </label>

                        {{-- <span class="info_txt">در حد سه کلمه (مثال : نصب اپ اسنپ)</span>  --}}
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                        {{--  <label class="form-label" for="default-06">رنگ پس زمینه تبلیغ</label>  --}}
                        <div class="form-control-wrap">
                            <div class="form-file">
                                <label class="file-label" for="customFile">رنگ پس زمینه تبلیغ</label>
                                <input type="color" id="bg_color" name="bg_color" value="{{ old("bg_color",$advertise->bg_color) }}" class="form-control  form-control-outlined" >

                            </div>
                        </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="form-control-wrap">
                        <input type="text" name="landing_title1" class="form-control  form-control-outlined" value="{{ old("landing_title1",$advertise->landing_title1) }}" id="landing_title12">
                        <label class="form-label-outlined" for="landing_title12">متن دکمه اقدام</label>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="form-control-wrap">
                        <input type="text" name="landing_link1" class="form-control  form-control-outlined" value="{{ old("landing_link1",$advertise->landing_link1) }}" id="landing_link3">
                        <label class="form-label-outlined" for="landing_link3">لینک صفحه فرود</label>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="form-control-wrap">
                        <input type="text" name="call_to_action" class="form-control  form-control-outlined" value="{{ old("call_to_action",$advertise->call_to_action) }}" id="call_to_action1">
                        <label class="form-label-outlined" for="call_to_action1">پیام اقدام به دعوت</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
              <div class="par_ad_d">
                <h6 class="text-center">
                    پیش نمایش
                </h6>
                  @include("admin.add_temp.fixpost",['site'=>null])
              </div>
        </div>

</div>
