@extends('main.manager')

@section('content')
<h2 class="mb-4">سفارش تبلیغ سایت</h2>
@include("master.error")
<div class="card">
    <div class="card-inner">
        {{-- <form action="{{ route("advertiser.new.adertise.chanal") }}" method="post">
        @csrf
        @method('post') --}}
        @if(!request("type"))

        <h6 class="alert alert-success">
            لطفا نوع تبلیفات خود را انتخاب کنید
        </h6>
        @endif

        <ul class="nav nav-tabs t_list">
            @if( $chanal_active_site=App\Models\Setting::whereName("chanal_active_site")->first()->val)

            <li class="nav-item tal">
                <a class="nav-link   {{ request("type")=="chanal"?"active":"" }}" href="{{ route("advertiser.new.adertise.chanal",['type'=>"chanal"]) }}"><i class="fas fa-volume-down"></i></i><span>کانال</span></a>
            </li>

            @endif
            @if( $hamsan_active_site=App\Models\Setting::whereName("hamsan_active_site")->first()->val)

            <li class="nav-item tal">
                <a class="nav-link   {{ request("type")=="hamsan"?"active":"" }}" href="{{ route("advertiser.new.adertise.chanal",['type'=>"hamsan"]) }}"><i class="fas fa-fire"></i></i><span>همسان</span></a>
            </li>
            @endif
        </ul>

        <div class="tab-content">
            @if(request("type")=="chanal")
            <div class="tab-pane  {{ request("type")=="chanal"?"active":"" }}" id="tabItem5">
                <form action="{{ route("advertiser.new.adertise.chanal") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    @php
                    $view = $user->view_price('chanal');

                    $type = "chanal";
                    @endphp
                    <input type="text" name="type" value="chanal" hidden>
                    <input type="text" name="pay" class="should_pay" value="" hidden>
                    @include('advertiser.steps')
                    <div class="f">
                        <div class="step">

                            <div class="row gy-3 mb-4">
                                <div class="col-md-12 mb-4">
                                    <ul class="alert alert-warning alert-icon mb-4">
                                        {!! $chanal_setting1 !!}
                                    </ul>
                                </div>


                                <div class="row mb-4">
                                    <div class="mb-2 col-lg-6">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <label class="form-label" for="title">عنوان</label>

                                                <input type="text" data-msg="الزامی" class="form-control required " id="title" name="title" required value="{{ old("title",$advertise->title) }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2 col-lg-6">
                                        <div class="form-group ">
                                            <label class="form-label" for="default-06">آپلود فایل ویدئو یا عکس</label>
                                            <div class="form-control-wrap">
                                                <div class="form-file">
                                                    <input type="file" id="attach" name="attach" class="form-file-input">
                                                    <label class="form-file-label" for="customFile"></label>
                                                    <p class="text text-danger">
                                                        تنها مجاز به وارد کردن یک عکس یا یک ویدئو می باشید
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2 col-lg-6">
                                        <div class="form-control-wrap ">
                                            <input type="text" name="landing_link1" required class="form-control  landing_title  form-control-outlined" value="{{ old("landing_link1" ,$advertise->landing_link1) }}" id="landing_link1">
                                            <label class="form-label-outlined" for="landing_link1">
                                                لینک 1
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mb-2 col-lg-6">
                                        <div class="form-control-wrap ">
                                            <input type="text" name="landing_title1" required class="form-control landing_title  form-control-outlined" value="{{ old("landing_title1" ,$advertise->landing_title1) }}" id="landing_title1">
                                            <label class="form-label-outlined" for="landing_title1">
                                                متن لینک 1
                                            </label>
                                            <span class="info_txt">در حد دو کلمه (مانند : دانلود رایگان / دانلود بازار)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="mb-2 col-lg-6">
                                        <div class="form-control-wrap focused">
                                            <input type="text" name="landing_link2" class="form-control  landing_title  form-control-outlined" value="{{ old("landing_link2" ,$advertise->landing_link2) }}" id="landing_link2">
                                            <label class="form-label-outlined" for="landing_link2">
                                                لینک 2
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-2 col-lg-6">
                                        <div class="form-control-wrap focused">
                                            <input type="text" name="landing_title2" class="form-control landing_title  form-control-outlined" value="{{ old("landing_title2" ,$advertise->landing_title2) }}" id="landing_title2">
                                            <label class="form-label-outlined" for="landing_title2">
                                                متن لینک 2
                                            </label>
                                            <span class="info_txt">در حد دو کلمه (مانند : دانلود رایگان / دانلود بازار)</span>
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
                                        <div id="per_ch_video">
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
                            {{-- @include('advertiser.ad_temp.chanal')  --}}
                        </div>
                        <div class="step" style="display:none;">
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
                        </div>
                        <div class="step" style="display:none;">
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
                    </div>
                    @include('advertiser.btns')
                </form>
            </div>
            @endif
            @if(request("type")=="hamsan")
            <div class="tab-pane  {{ request("type")=="hamsan"?"active":"" }}" id="tabItem8">
                <form action="{{ route("advertiser.new.adertise.chanal") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    @php
                    $click = $user->click_price('hamsan');
                    $view = $user->view_price('hamsan');
                    $price = $user->view_price("hamsan");
                    $type = "hamsan";
                    @endphp
                    <input type="text" name="type" value="hamsan" hidden>
                    <input type="text" name="pay" class="should_pay" value="" hidden>
                    @include('advertiser.steps')
                    <div class="f">
                        <div class="step">
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <div class="form-control-wrap">
                                                <input name="title" id="title" cols="30" data-m="30" class="form-control countable  form-control-outlined" value="{{ old("title",$advertise->title) }}">
                                                <label class="form-label-outlined" for="title">عنوان برنامه</label>
                                                <span class="info_txt">در حد سه کلمه (مثال : نصب اپ اسنپ)</span>
                                                <span class="count">
                                                    0
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <div class="form-control-wrap">
                                                <textarea name="info" id="info" cols="30" data-m="70" class="form-control countable  form-control-outlined" rows="1">{{ old("info",$advertise->info) }}</textarea>
                                                <label class="form-label-outlined" for="info">توضیحات</label>
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
                                            <h5 id="title_p">
                                                {{ old("title",$advertise->title) }}
                                            </h5>
                                            <p id="sorenad_info">
                                                {{ old("info",$advertise->info) }}
                                            </p>
                                            <a href="" class="btn_full" id="landing_title1_p" style="background: {{ old("bt_color",$advertise->bt_color) }}">
                                                {{ old("landing_title1",$advertise->landing_title1) }}

                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="step" style="display:none;">
                            @include('advertiser.cat_temp')

                        </div>
                        <div class="step" style="display:none;">
                            @include('advertiser.price_temp')
                        </div>
                    </div>
                    @include('advertiser.btns')
                </form>
            </div>
            @endif
        </div>

    </div>
</div>


@endsection
