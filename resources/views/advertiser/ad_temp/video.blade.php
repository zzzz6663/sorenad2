<div class="row mb-4">
    <div class="ol-lg-12 mb-4">
        <p class="bg bg-outline-success">
            <i class="fa fa-info-circle"></i>
            تبلیغ ویدئویی </p>
    </div>



    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="form-control-wrap">
                    <input type="text" name="title" class="form-control  form-control-outlined" value="{{ old("title",$advertise->title) }}" id="title_video">
                    <label class="form-label-outlined" for="title">عنوان </label>
                    {{-- <span class="info_txt">در حد سه کلمه (مثال : نصب اپ اسنپ)</span>  --}}
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="form-control-wrap">
                    <input type="text" name="call_to_action" class="form-control  form-control-outlined" value="{{ old("call_to_action",$advertise->call_to_action) }}" id="call_to_action_video">
                    <label class="form-label-outlined" for="call_to_action_video">پیام اقدام به دعوت</label>
                </div>
            </div>
            <div class="col-lg-8 mb-4">
                <div class="form-control-wrap">
                    <input type="text" name="landing_link1" class="form-control  form-control-outlined" value="{{ old("landing_link1",$advertise->landing_link1) }}" id="landing_link1">
                    <label class="form-label-outlined" for="landing_link1">لینک صفحه فرود</label>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="form-control-wrap">
                    <input type="text" name="landing_title1" class="form-control  form-control-outlined" value="{{ old("landing_title1",$advertise->landing_title1) }}" id="landing_title1_video">
                    <label class="form-label-outlined" for="landing_title1_video">متن دکمه اقدام</label>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-label" for="default-06">آپلود فایل ویدئو</label>
                    <div class="form-control-wrap">
                        <div class="form-file">
                            <input type="file" id="attach" name="video1" class="form-file-input" accept="video/*">
                            <label class="form-file-label" id="attach" for="customFile"></label>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-lg-6">
        <div class="par_ad_d">
            <h6 class="text-center">
                پیش نمایش
            </h6>
              @include("admin.add_temp.video",['site'=>null])
          </div>
    </div>



</div>
<div class="row mb-4">


</div>
