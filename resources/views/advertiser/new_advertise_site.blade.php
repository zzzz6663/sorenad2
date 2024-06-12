@extends('main.manager')

@section('content')
<h2 class="mb-4">سفارش تبلیغ سایت</h2>
@include("master.error")
<div class="card">
    <div class="card-inner">
        {{-- <form action="{{ route("advertiser.new.adertise.site") }}" method="post">
        @csrf
        @method('post') --}}
        @if(!request("type"))

        <h6 class="alert alert-success">
            لطفا نوع تبلیفات خود را انتخاب کنید
        </h6>
        @endif

        <ul class="nav nav-tabs t_list">
            @if( $fixpost_active_site=App\Models\Setting::whereName("app_active_site")->first()->val)
            <li class="nav-item tal ">
                <a class="nav-link  {{ request("type")=="app"?"active":"" }}" href="{{ route("advertiser.new.adertise.site",['type'=>"app"]) }}">
                    <i class="fas fa-mobile-alt"></i>
                    <span>
                        نصب آپلیکیشن
                    </span>
                </a>
            </li>
            @endif
            @if( $fixpost_active_site=App\Models\Setting::whereName("popup_active_site")->first()->val)
            <li class="nav-item tal">
                <a class="nav-link   {{ request("type")=="popup"?"active":"" }}" href="{{ route("advertiser.new.adertise.site",['type'=>"popup"]) }}"><i class="far fa-copy"></i><span>پاپ آپ</span></a>
            </li>
            @endif
            @if( $fixpost_active_site=App\Models\Setting::whereName("banner_active_site")->first()->val)
            <li class="nav-item tal">
                <a class="nav-link  {{ request("type")=="banner"?"active":"" }}" href="{{ route("advertiser.new.adertise.site",['type'=>"banner"]) }}"><i class="fas fa-image"></i><span>بنر </span></a>
            </li>
            @endif
            @if( $fixpost_active_site=App\Models\Setting::whereName("fixpost_active_site")->first()->val)
            <li class="nav-item tal">
                <a class="nav-link  {{ request("type")=="fixpost"?"active":"" }}" href="{{ route("advertiser.new.adertise.site",['type'=>"fixpost"]) }}"><i class="fas fa-thumbtack"></i><span>پست ثابت</span></a>
            </li>
            @endif
            @if( $fixpost_active_site=App\Models\Setting::whereName("video_active_site")->first()->val)
            <li class="nav-item tal">
                <a class="nav-link  {{ request("type")=="video"?"active":"" }}" href="{{ route("advertiser.new.adertise.site",['type'=>"video"]) }}"><i class="fas fa-video"></i><span>ویدئو</span></a>
            </li>
            @endif
            @if( $fixpost_active_site=App\Models\Setting::whereName("text_active_site")->first()->val)
            <li class="nav-item tal">
                <a class="nav-link  {{ request("type")=="text"?"active":"" }}" href="{{ route("advertiser.new.adertise.site",['type'=>"text"]) }}"><i class="fas fa-text-width"></i><span>متنی</span></a>
            </li>
            @endif
            @if( $hamsan_active_site=App\Models\Setting::whereName("hamsan_active_site")->first()->val)

            <li class="nav-item tal">
                <a class="nav-link   {{ request("type")=="hamsan"?"active":"" }}" href="{{ route("advertiser.new.adertise.site",['type'=>"hamsan"]) }}"><i class="fas fa-fire"></i></i><span>همسان</span></a>
            </li>
            @endif
        </ul>


        <div class="tab-content">
            <div class="tab-pane  {{ request("type")=="app"?"active":"" }}" id="tabItem5">
                <form action="{{ route("advertiser.new.adertise.site") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    @php
                    $click = $user->click_price('app');
                    $view = $user->view_price('app');
                    $type = "app";
                    @endphp
                    <input type="text" name="type" value="app" hidden>
                    <input type="text" name="pay" class="should_pay" value="" hidden>
                    @include('advertiser.steps')
                    <div class="f">
                        <div class="step">
                            @include('advertiser.ad_temp.app')
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


            <div class="tab-pane  {{ request("type")=="popup"?"active":"" }}" id="tabItem6">
                <form action="{{ route("advertiser.new.adertise.site") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    @php
                    $click = $user->click_price('popup');
                    $view = $user->view_price('popup');
                    $price = $user->view_price("popup");
                    $type = "popup";
                    @endphp
                    <input type="text" name="type" value="popup" hidden>
                    <input type="text" name="pay" class="should_pay" value="" hidden>
                    @include('advertiser.steps')
                    <div class="f">
                        <div class="step">
                            @include('advertiser.ad_temp.popup')
                        </div>
                        <div class="step" style="display:none;">
                            @include('advertiser.device_temp')

                        </div>
                        <div class="step" style="display:none;">
                            @include('advertiser.template_pay')
                        </div>
                    </div>
                    @include('advertiser.btns')
                </form>
            </div>
            <div class="tab-pane  {{ request("type")=="banner"?"active":"" }}" id="tabItem7">
                <form action="{{ route("advertiser.new.adertise.site") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    @php
                    $click = $user->click_price('banner');
                    $view = $user->view_price('banner');
                    $price = $user->view_price("banner");
                    $type = "banner";
                    @endphp
                    <input type="text" name="type" value="banner" hidden>
                    <input type="text" name="pay" class="should_pay" value="" hidden>
                    @include('advertiser.steps')
                    <div class="f">
                        <div class="step">
                            @include('advertiser.ad_temp.banner')
                        </div>
                        <div class="step" style="display:none;">
                            @include('advertiser.device_temp')
                            @include('advertiser.cat_temp')


                        </div>
                        <div class="step" style="display:none;">
                            @include('advertiser.price_temp')
                        </div>
                    </div>
                    @include('advertiser.btns')
                </form>
            </div>
            <div class="tab-pane  {{ request("type")=="fixpost"?"active":"" }}" id="tabItem8">
                <form action="{{ route("advertiser.new.adertise.site") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    @php
                    $click = $user->click_price('fixpost');
                    $view = $user->view_price('fixpost');
                    $price = $user->view_price("fixpost");
                    $type = "fixpost";
                    @endphp
                    <input type="text" name="type" value="fixpost" hidden>
                    <input type="text" name="pay" class="should_pay" value="" hidden>
                    @include('advertiser.steps')
                    <div class="f">
                        <div class="step">
                            @include('advertiser.ad_temp.fixpost')
                        </div>
                        <div class="step" style="display:none;">
                            @include('advertiser.cat_temp')
                            @include('advertiser.device_temp')

                        </div>
                        <div class="step" style="display:none;">
                            @include('advertiser.price_temp')
                        </div>
                    </div>
                    @include('advertiser.btns')
                </form>
            </div>
            <div class="tab-pane  {{ request("type")=="video"?"active":"" }}" id="tabItem8">
                <form action="{{ route("advertiser.new.adertise.site") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    @php
                    $click = $user->click_price('video');
                    $view = $user->view_price('video');
                    $price = $user->view_price("video");
                    $type = "video";
                    @endphp
                    <input type="text" name="type" value="video" hidden>
                    <input type="text" name="pay" class="should_pay" value="" hidden>
                    @include('advertiser.steps')
                    <div class="f">
                        <div class="step">
                            @include('advertiser.ad_temp.video')
                        </div>
                        <div class="step" style="display:none;">
                            @include('advertiser.cat_temp')
                            @include('advertiser.device_temp')
                        </div>
                        <div class="step" style="display:none;">
                            @include('advertiser.price_temp')
                        </div>
                    </div>
                    @include('advertiser.btns')
                </form>
            </div>
            <div class="tab-pane  {{ request("type")=="text"?"active":"" }}" id="tabItem8">
                <form action="{{ route("advertiser.new.adertise.site") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    @php
                    $click = $user->click_price('text');
                    $view = $user->view_price('text');
                    $price = $user->view_price("text");
                    $type = "text";
                    @endphp
                    <input type="text" name="type" value="text" hidden>
                    <input type="text" name="pay" class="should_pay" value="" hidden>
                    @include('advertiser.steps')
                    <div class="f">
                        <div class="step">
                            @include('advertiser.ad_temp.text')
                        </div>
                        <div class="step" style="display:none;">
                            @include('advertiser.cat_temp')
                            @include('advertiser.device_temp')
                        </div>
                        <div class="step" style="display:none;">
                            @include('advertiser.price_temp')
                        </div>
                    </div>
                    @include('advertiser.btns')
                </form>
            </div>

            @if(request("type")=="hamsan")
            <div class="tab-pane  {{ request("type")=="hamsan"?"active":"" }}" id="tabItem8">
                <form action="{{ route("advertiser.new.adertise.site") }}" method="post" enctype="multipart/form-data">
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
                                                <input name="title" id="title" cols="30" data-m="30" class="titl_f form-control countable  form-control-outlined" value="{{ old("title",$advertise->title) }}">
                                                <label class="form-label-outlined" for="title">عنوان برنامه</label>
                                                <span class="info_txt">در حد سه کلمه (مثال : نصب اپ اسنپ)</span>
                                                <span class="count">
                                                    0
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <div class="form-control-wrap">
                                                <textarea name="info" id="info" cols="30" data-m="70" class="form-control info_f countable  form-control-outlined" rows="1">{{ old("info",$advertise->info) }}</textarea>
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
                            @include('advertiser.device_temp')
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
