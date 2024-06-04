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
    </div>

</div>
</div>


@endsection