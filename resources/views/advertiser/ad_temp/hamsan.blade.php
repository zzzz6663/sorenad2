<div class="row mb-4">
    <div class="ol-lg-12 mb-4">

        <p class="bg bg-outline-success">
            <i class="fa fa-info-circle"></i>
            تذکز
        </p>
    </div>





</div>


<div class="row mb-4">
    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="form-control-wrap">
                    <textarea name="title" id="title" cols="30" data-m="70" class="form-control countable  form-control-outlined" rows="1">{{ old("title",$advertise->title) }}</textarea>
                    <label class="form-label-outlined" for="title">عنوان برنامه</label>
                    <span class="info_txt">در حد سه کلمه (مثال : نصب اپ اسنپ)</span>
                    <span class="count">
                        0
                    </span>
                </div>
            </div>
            <div class="col-lg-12 mb-4">
                <div class="form-control-wrap">
                    <input type="color" name="bt_color" class="form-control  form-control-outlined" value="{{ old("bt_color",$advertise->bt_color) }}" id="bt_color">
                    <label class="form-label-outlined" for="bt_color">رنگ برند شما</label>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="form-control-wrap">
                    <input type="text" name="landing_link1" class="form-control  landing_title  form-control-outlined" value="{{ old("landing_link1",$advertise->landing_link1) }}" id="landing_link1">
                    <label class="form-label-outlined" for="landing_link1">
                        لینک دانلود
                    </label>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="form-control-wrap">
                    <input type="text" name="landing_title1" data-m="30" class="form-control landing_title countable  form-control-outlined" value="{{ old("landing_title1",$advertise->landing_title1) }}" id="landing_title1">
                    <label class="form-label-outlined" for="landing_title1" >
                        متن دکمه
                    </label>
                    <span class="info_txt"></span>
                    <span class="count">
                        0
                    </span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label" for="default-06">آپلود تصویر </label>
                    <div class="form-control-wrap">
                        <div class="form-file">
                            <input type="file" id="banner1" name="banner1" class="form-file-input" accept="image/png, image/jpeg">
                            <label class="form-file-label" for="banner1"></label>
                            <span class="info_txt"></span>
                        </div>
                    </div>
                </div>
            </div>
        @include('advertiser.cat_temp')

        </div>

    </div>
    <div class="col-lg-6">
        <div class="borde1">
            <h4 class="text-center">
                پیش نمایش
            </h4>
            <br>
            <div class="box_p">
                <img src="{{ $advertise->banner1() }}" id="banner1_p" alt="" style="width:100%; object-fit: cover">
                <br>
                <br>
                <h5 id="title_p">
                    {{ old("title",$advertise->title) }}
                </h5>
                <br>
                <a href="" class="btn_full" id="landing_title1_p" style="background: {{ old("bt_color",$advertise->bt_color) }}">
                    {{ old("landing_title1",$advertise->landing_title1) }}

                </a>
            </div>

        </div>
    </div>
</div>
