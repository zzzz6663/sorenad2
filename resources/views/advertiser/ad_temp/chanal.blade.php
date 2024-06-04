






<div class="nk-wizard-head">
    <h5>هدفمندسازی تبلیغ</h5>
</div>
<div class="nk-wizard-content">
    <div class="row gy-3">
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="title">عنوان</label>
                <div class="form-control-wrap">
                    <input type="text" data-msg="الزامی" class="form-control required" id="title" name="title" required  value="{{ old("title",$advertise->title) }}"/>
                </div>
            </div>
        </div>
        <br>
        @include('advertiser.group_temp')
        <div class="col-lg-4">
            <div class="form-group">
                <label for="site_category">شبکه اجتماعی</label>
                <div class="form-control-wrap">
                    <select name="socials[]" id="social" required multiple class="form-control  select2">
                        <option value="">همه </option>
                        <option {{ in_array("telegram",request("socials",[]))?"selected":"" }} value="telegram"> تلگرام </option>
                        <option {{  in_array("ita",request("socials",[]))?"selected":"" }} value="ita"> ایتا </option>
                        <option {{  in_array("rubika",request("socials",[]))?"selected":"" }} value="rubika"> روبیکا </option>
                        <option {{  in_array("instagram",request("socials",[]))?"selected":"" }} value="instagram"> اینستاگرام </option>
                        <option {{ in_array("bale",request("socials",[]))?"selected":"" }} value="bale"> بله </option>
                    </select>
                </div>
            </div>
        </div>
        {{--  <di class="col-lg-4">
            <h6 class="title mb-3 mt-4">مناسب برای کانال های </h6>
            <ul class="custom-control-group">
                <li>
                    <div class="custom-control custom-control-sm custom-checkbox custom-control-pro">
                        <input type="checkbox" class="custom-control-input" {{ old("telegram",$advertise->telegram)?"checked":"" }} name="telegram" id="telegram" />
                        <label class="custom-control-label" for="telegram">تلگرام</label>
                    </div>
                </li>
                <li>
                    <div class="custom-control custom-control-sm custom-checkbox custom-control-pro">
                        <input type="checkbox" class="custom-control-input" {{ old("ita",$advertise->ita)?"checked":"" }} name="ita" id="ita" />
                        <label class="custom-control-label" for="ita">ایتا</label>
                    </div>
                </li>
                <li>
                    <div class="custom-control custom-control-sm custom-checkbox custom-control-pro">
                        <input type="checkbox" class="custom-control-input" {{ old("rubika",$advertise->rubika)?"checked":"" }} name="rubika" id="rubika" />
                        <label class="custom-control-label" for="rubika">روبیکا</label>
                    </div>
                </li>
                <li>
                    <div class="custom-control custom-control-sm custom-checkbox custom-control-pro">
                        <input type="checkbox" class="custom-control-input" {{ old("bale",$advertise->bale)?"checked":"" }} name="bale" id="bale" />
                        <label class="custom-control-label" for="bale">بله</label>
                    </div>
                </li>

                <li>
                    <div class="custom-control custom-control-sm custom-checkbox custom-control-pro">
                        <input type="checkbox" class="custom-control-input" {{ old("instagram",$advertise->instagram)?"checked":"" }} name="instagram" id="instagram" />
                        <label class="custom-control-label" for="instagram">اینستاگرام</label>
                    </div>
                </li>
            </ul>
        </di>  --}}
    </div>
</div>


<div class="nk-wizard-head">
    <h5>طراحی تبلیغ</h5>
</div>
<div class="nk-wizard-content">
    <div class="row gy-3 mb-4">
        <div class="col-md-12 mb-4">
            <ul class="alert alert-warning alert-icon mb-4">
               {!! $chanal_setting1 !!}
            </ul>
        </div>
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="form-control-wrap focused">
                    <input type="text" name="landing_link1" required class="form-control  landing_title  form-control-outlined" value="{{ old("landing_link1" ,$advertise->landing_link1) }}" id="landing_link1">
                    <label class="form-label-outlined" for="landing_link1">
                        لینک   1
                    </label>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-control-wrap focused">
                    <input type="text" name="landing_title1" required class="form-control landing_title  form-control-outlined" value="{{ old("landing_title1" ,$advertise->landing_title1) }}" id="landing_title1">
                    <label class="form-label-outlined" for="landing_title1">
                        متن لینک 1
                    </label>
                    <span class="info_txt">در حد دو کلمه (مانند : دانلود رایگان / دانلود بازار)</span>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="form-control-wrap focused">
                    <input type="text" name="landing_link2" class="form-control  landing_title  form-control-outlined" value="{{ old("landing_link2" ,$advertise->landing_link2) }}" id="landing_link2">
                    <label class="form-label-outlined" for="landing_link2">
                        لینک   2
                    </label>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-control-wrap focused">
                    <input type="text" name="landing_title2" class="form-control landing_title  form-control-outlined" value="{{ old("landing_title2" ,$advertise->landing_title2) }}" id="landing_title2">
                    <label class="form-label-outlined" for="landing_title2">
                        متن لینک 2
                    </label>
                    <span class="info_txt">در حد دو کلمه (مانند : دانلود رایگان / دانلود بازار)</span>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="form-group ">
                <label class="form-label" for="default-06">آپلود فایل ویدئو یا عکس</label>
                <div class="form-control-wrap">
                    <div class="form-file">
                        <input type="file" id="attach" name="attach" class="form-file-input" >
                        <label class="form-file-label" for="customFile"></label>
                        <p class="text text-danger">
                            تنها مجاز به وارد کردن یک عکس یا یک ویدئو می باشید
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="title">محتوا</label>
                <div class="form-control-wrap" id="tiny_text_w">
                    <textarea class="form-control no-resize" required name="info" required id="tiny_text">{{ old("info" ,$advertise->info) }}</textarea>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <br>
                <br>
            <div class="form-group borde1">
                <h5 class="form-label text-center" for=" ">پیش نمایش </h5>
                <div  id="per_ch_video"   >
                  </div>
                  <p id="s_info">
                    @if($advertise->id)
                    <img src="{{ $advertise->attach() }}" alt="">
                    <video width="320" height="240" controls>
                        <source src="{{ $advertise->attach() }}" type="video/mp4">
                      </video>
                      <p>
                        {!! $advertise->info !!}
                      </p>


                    @endif
                  </p>

                  <div>
                    <h5 id="landing_title1_p">
                        @if($advertise->id)
                        {{ $advertise->landing_title1 }}
                        @endif
                    </h5>
                    <p id="landing_link1_p">
                        @if($advertise->id)
                        {{ $advertise->landing_link1 }}
                        @endif
                    </p>


                 </div>

                 <div>
                    <h5 id="landing_title2_p">
                        @if($advertise->id)
                        {{ $advertise->landing_title2 }}
                        @endif
                    </h5>
                    <p id="landing_link2_p">
                        @if($advertise->id)
                        {{ $advertise->landing_link2 }}
                        @endif
                    </p>
                 </div>
            </div>
        </div>
    </div>
</div>



<div class="nk-wizard-head">
    <h5>  بودجه بندی</h5>
</div>
<div class="nk-wizard-content">
    <div class="row gy-3">
        <div class="col-md-12">
            <ul class="alert alert-warning alert-icon">
                {!! $chanal_setting2 !!}
            </ul>
        </div>
    </div>
    <br>
    <br>
    @if(auth()->user()->role=="customer")
    @include('advertiser.price_temp')
    @endif
</div>
