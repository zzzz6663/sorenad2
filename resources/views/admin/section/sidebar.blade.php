{{-- <div id="sidebar_right">

    <div class="bodydeactive"><i class="fa fa-close"></i></div>

    <div class="accordionWrapper box_shdow">
        <span>
          {{auth()->user()->role}}
</span>
<a class="{{(Route::currentRouteName()=='admin.dashoard')?'mactive':''}}" href="{{ route("admin.dashoard") }}">

    <i class="fa-solid fa-gauge-high"></i>
    پیشوان</a>

<a href="{{ route("site.index") }}" class="{{(Route::currentRouteName()=='site.index')?'mactive':''}}">
    <i class="fas fa-globe-africa"></i>
    مدیریت سایت
    @if($unread_site=App\Models\Site::whereStatus("created")->count())
    <span class="num_circle">{{ $unread_site }}</span>

    @endif
</a>

<a href="{{ route("user.index") }}" class="{{(Route::currentRouteName()=='user.index')?'mactive':''}}">
    <i class="fas fa-users"></i>

    کابران
</a>

<a href="{{ route("transaction.index") }}" class="{{(Route::currentRouteName()=='transaction.index')?'mactive':''}}">
    <i class="fas fa-users"></i>

    تراکنش ها
</a>



<a href="">
    <i class="fa-solid fa-photo-film"></i>
    مدیریت رسانه ها</a>


<a href="{{ route("withdrawal.index") }}" class="{{(Route::currentRouteName()=='withdrawal.index')?'mactive':''}}">
    <i class="fa-solid fa-money-bill-transfer"></i>

    تسویه حساب ها
    @if(auth()->user()->unread_withdrawal())
    <span class="num_circle">{{ auth()->user()->unread_withdrawal() }}</span>
    @endif
</a>

<a href="{{ route("advertise.index") }}" class="{{(Route::currentRouteName()=='advertise.index')?'mactive':''}}">

    <i class="fa-solid fa-volume-high"></i>


    لیست تبلیغات</a>

<div class="accordionItem {{in_array(Route::currentRouteName(),[
            'setting.ads.app',
            'setting.ads.banner',
            'setting.ads.fixpost',
            'setting.ads.popup',
            'setting.ads.video',
            'setting.ads.text',
            ])?"open":"close"}}">
    <div class="accordionItemHeading">

        <span>
            <i class="fa-solid fa-sliders"></i>
            تنظیمات تبلیغات</span>

        <div class="left_arrow"><svg width="10px" height="10px" viewBox="0 -19.04 75.804 75.804" xmlns="http://www.w3.org/2000/svg">
                <g id="Group_67" data-name="Group 67" transform="translate(-798.203 -587.815)">
                    <path id="Path_59" data-name="Path 59" d="M798.2,589.314a1.5,1.5,0,0,1,2.561-1.06l33.56,33.556a2.528,2.528,0,0,0,3.564,0l33.558-33.556a1.5,1.5,0,1,1,2.121,2.121l-33.558,33.557a5.53,5.53,0,0,1-7.807,0l-33.56-33.557A1.5,1.5,0,0,1,798.2,589.314Z" stroke="#000000" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </svg></div>

    </div>
    <div class="accordionItemContent">
        <ul>
            <li class="subitem {{ Route::currentRouteName()=="setting.ads.app"?"active":"" }}"><a href="{{ route("setting.ads.app") }}">تبلیغات نصب اپلیکیشن</a></li>
            <li class="subitem {{ Route::currentRouteName()=="setting.ads.banner"?"active":"" }}"><a href="{{ route("setting.ads.banner") }}">تبلیغات نصب بنری</a></li>
            <li class="subitem {{ Route::currentRouteName()=="setting.ads.fixpost"?"active":"" }}"><a href="{{ route("setting.ads.fixpost") }}">تبلیغات پست ثابت</a></li>
            <li class="subitem {{ Route::currentRouteName()=="setting.ads.popup"?"active":"" }}"><a href="{{ route("setting.ads.popup") }}">تبلیغات پاپ آپ</a></li>
            <li class="subitem {{ Route::currentRouteName()=="setting.ads.video"?"active":"" }}"><a href="{{ route("setting.ads.video") }}">تبلیغات ویدیویی</a></li>
            <li class="subitem {{ Route::currentRouteName()=="setting.ads.text"?"active":"" }}"><a href="{{ route("setting.ads.text") }}">تبلیغات متنی</a></li>
        </ul>
    </div>
</div>


<a href="{{ route("ticket.index") }}" class="{{(Route::currentRouteName()=='ticket.index')?'mactive':''}}">
    <i class="fa-solid fa-headphones-simple"></i>
    تیکت ها
    @if(auth()->user()->unread_message())
    <span class="num_circle">{{ auth()->user()->unread_message() }}</span>
    @endif
</a>
<a href="{{ route("faq.index") }}" class="{{(Route::currentRouteName()=='faq.index')?'mactive':''}}">
    <i class="fa-solid fa-person-circle-question"></i>
    سوالات متداول
</a>

<a href="{{ route("cat.index") }}" class="{{(Route::currentRouteName()=='cat.index')?'mactive':''}}">
    <i class="fa-solid fa-list"></i>
    دسته بندی ها
</a>



<div class="accordionItem close">
    <div class="accordionItemHeading">

        <span>
            <i class="fa-regular fa-clipboard"></i>
            گزارش ها</span>

        <div class="left_arrow"><svg width="10px" height="10px" viewBox="0 -19.04 75.804 75.804" xmlns="http://www.w3.org/2000/svg">
                <g id="Group_67" data-name="Group 67" transform="translate(-798.203 -587.815)">
                    <path id="Path_59" data-name="Path 59" d="M798.2,589.314a1.5,1.5,0,0,1,2.561-1.06l33.56,33.556a2.528,2.528,0,0,0,3.564,0l33.558-33.556a1.5,1.5,0,1,1,2.121,2.121l-33.558,33.557a5.53,5.53,0,0,1-7.807,0l-33.56-33.557A1.5,1.5,0,0,1,798.2,589.314Z" stroke="#000000" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </svg></div>

    </div>
    <div class="accordionItemContent">
        <ul>
            <li><a href="">گزارش نمایش تبلیغات</a></li>
            <li><a href="">گزارش آخرین تراکنش ها</a></li>
            <li><a href="">گزارش کاربران</a></li>
        </ul>
    </div>
</div>

<a href="{{ route("site.setting") }}">
    <i class="fa-solid fa-screwdriver-wrench"></i>
    تنظیمات سایت
</a>

<a href="{{ route("logout") }}">
    <i class="fa-solid fa-right-from-bracket"></i>
    خروج از

    حساب</a>

</div>

<script type="text/javascript">
    var accItem = document.getElementsByClassName('accordionItem');
    var accHD = document.getElementsByClassName('accordionItemHeading');
    for (i = 0; i < accHD.length; i++) {
        accHD[i].addEventListener('click', toggleItem, false);
    }

    function toggleItem() {
        var itemClass = this.parentNode.className;
        for (i = 0; i < accItem.length; i++) {
            accItem[i].className = 'accordionItem close';
        }
        if (itemClass == 'accordionItem close') {
            this.parentNode.className = 'accordionItem open';
        }
    }

</script>

<div class="clear"></div>
</div> --}}



<div class="nk-sidebar nk-sidebar-fixed is-light" data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ route("login") }}" class="logo-link nk-sidebar-logo ">
                {{-- <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="لوگو">
                <img class="logo-dark logo-img" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="لوگوی تاریک">
                <img class="logo-small logo-img logo-img-small" src="./images/logo-small.png" srcset="./images/logo-small2x.png 2x" alt="لوگوی کوچک">  --}}
                <img class=" logo-small logo-img logo_side" src="/site/images/logo.png">
            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none no_link" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex no_link" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
    </div>
    <!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar="init">
                <div class="simplebar-wrapper" style="margin: -16px 0px -40px;">
                    <div class="simplebar-height-auto-observer-wrapper">
                        <div class="simplebar-height-auto-observer"></div>
                    </div>
                    <div class="simplebar-mask">
                        <div class="simplebar-offset" style="left: 0px; bottom: 0px;">
                            <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                                <div class="simplebar-content" style="padding: 16px 0px 40px;">
                                    <ul class="nk-menu">
                                        {{-- <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">
                            اپلیکیشن ها
                        </h6>
                    </li>  --}}
                                        <!-- .nk-menu-heading -->
                                        @role('admin')
                                        <li class="nk-menu-item has-sub {{in_array(Route::currentRouteName(),[
                        'setting.ads.app',
                        'setting.ads.banner',
                        'setting.ads.fixpost',
                        'setting.ads.popup',
                        'setting.ads.video',
                        'setting.ads.text',
                        ])?"active":""}} ">
                                            <a href="#" class="nk-menu-link nk-menu-toggle no_link ">
                                                <span class="nk-menu-icon">

                                                    <i class="fas fa-cog"></i>
                                                </span>
                                                <span class="nk-menu-text">تنظیمات تبلیغات</span>
                                            </a>
                                            <ul class="nk-menu-sub">


                                                <li class="nk-menu-item {{ Route::currentRouteName()=="setting.ads.app"?"active":"" }}">
                                                    <a class="nk-menu-link" href="{{ route("setting.ads.app") }}">
                                                        <span class="nk-menu-text">
                                                            تبلیغات نصب اپلیکیشن
                                                        </span>

                                                    </a></li>
                                                <li class="nk-menu-item {{ Route::currentRouteName()=="setting.ads.banner"?"active":"" }}">
                                                    <a class="nk-menu-link" href="{{ route("setting.ads.banner") }}">
                                                        <span class="nk-menu-text">
                                                            تبلیغات نصب بنری
                                                        </span>

                                                    </a></li>
                                                <li class="nk-menu-item {{ Route::currentRouteName()=="setting.ads.fixpost"?"active":"" }}">
                                                    <a class="nk-menu-link" href="{{ route("setting.ads.fixpost") }}">
                                                        <span class="nk-menu-text">
                                                            تبلیغات پست ثابت
                                                        </span>

                                                    </a></li>
                                                <li class="nk-menu-item {{ Route::currentRouteName()=="setting.ads.popup"?"active":"" }}">
                                                    <a class="nk-menu-link" href="{{ route("setting.ads.popup") }}">
                                                        <span class="nk-menu-text">
                                                            تبلیغات پاپ آپ
                                                        </span>

                                                    </a></li>
                                                <li class="nk-menu-item {{ Route::currentRouteName()=="setting.ads.video"?"active":"" }}">
                                                    <a class="nk-menu-link" href="{{ route("setting.ads.video") }}">
                                                        <span class="nk-menu-text">
                                                            تبلیغات ویدیویی
                                                        </span>

                                                    </a></li>
                                                <li class="nk-menu-item {{ Route::currentRouteName()=="setting.ads.text"?"active":"" }}">
                                                    <a class="nk-menu-link" href="{{ route("setting.ads.text") }}">
                                                        <span class="nk-menu-text">
                                                            تبلیغات متنی
                                                        </span>

                                                    </a></li>




                                            </ul>
                                            <!-- .nk-menu-sub -->
                                        </li>
                                        <li class="nk-menu-item   {{ Route::currentRouteName()=="user.index"?"active":"" }}">
                                            <a href="{{ route("user.index") }}" class="nk-menu-link  ">
                                                <span class="nk-menu-icon">
                                                    <i class="fas fa-users"></i>
                                                </span>
                                                <span class="nk-menu-text">کاربران </span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item   {{ Route::currentRouteName()=="advertise.index"?"active":"" }}">
                                            <a href="{{ route("advertise.index") }}" class="nk-menu-link  ">
                                                <span class="nk-menu-icon">
                                                    <i class="fas fa-ad"></i>
                                                </span>
                                                <span class="nk-menu-text">تبلیغات </span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item   {{ Route::currentRouteName()=="transaction.index"?"active":"" }}">
                                            <a href="{{ route("transaction.index") }}" class="nk-menu-link  ">
                                                <span class="nk-menu-icon">
                                                    <i class="fas fa-money-check"></i>
                                                </span>
                                                <span class="nk-menu-text">تراکنش </span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item   {{ Route::currentRouteName()=="cat.index"?"active":"" }}">
                                            <a href="{{ route("cat.index") }}" class="nk-menu-link  ">
                                                <span class="nk-menu-icon">
                                                    <i class="fas fa-stream"></i>
                                                </span>
                                                <span class="nk-menu-text">دسته بندی </span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item   {{ Route::currentRouteName()=="faq.index"?"active":"" }}">
                                            <a href="{{ route("faq.index") }}" class="nk-menu-link  ">
                                                <span class="nk-menu-icon">
                                                    <i class="fas fa-question-circle"></i>
                                                </span>
                                                <span class="nk-menu-text">سوالات متداول </span>
                                            </a>
                                        </li>

                                        <li class="nk-menu-item   {{ Route::currentRouteName()=="admin.dashoard"?"active":"" }}">
                                            <a href="{{ route("admin.dashoard") }}" class="nk-menu-link  ">
                                                <span class="nk-menu-icon">
                                                    <i class="fas fa-tachometer-alt"></i>
                                                </span>
                                                <span class="nk-menu-text">داشبورد </span>
                                            </a>
                                        </li>
                                        {{-- @dd( Route::currentRouteName()=="site.index")  --}}

                                        <li class="nk-menu-item   {{ Route::currentRouteName()=="site.setting"?"active":"" }}">
                                            <a href="{{ route("site.setting") }}" class="nk-menu-link  ">
                                                <span class="nk-menu-icon">
                                                    <i class="fas fa-cogs"></i>
                                                </span>
                                                <span class="nk-menu-text">تنظیمات </span>
                                            </a>
                                        </li>

                                        <li class="nk-menu-item   {{ Route::currentRouteName()=="site.index"?"active":"" }}">
                                            <a href="{{ route("site.index") }}" class="nk-menu-link  ">
                                                <span class="nk-menu-icon">
                                                    <i class="fas fa-tasks"></i>
                                                </span>
                                                <span class="nk-menu-text">مدیریت سایت </span>
                                                @if($unread_site=App\Models\Site::whereStatus("created")->count())
                                                <span class="num_circle">{{ $unread_site }}</span>

                                                @endif
                                            </a>
                                        </li>
                                        <li class="nk-menu-item   {{ Route::currentRouteName()=="withdrawal.index"?"active":"" }}">
                                            <a href="{{ route("withdrawal.index") }}" class="nk-menu-link  ">
                                                <span class="nk-menu-icon">
                                                    <i class="fas fa-money-check"></i>
                                                </span>
                                                <span class="nk-menu-text">تسویه حساب </span>
                                                @if(auth()->user()->unread_withdrawal())
                                                <span class="num_circle">{{ $unread_site }}</span>

                                                @endif
                                            </a>
                                        </li>
                                        <li class="nk-menu-item   {{ Route::currentRouteName()=="ticket.index"?"active":"" }}">
                                            <a href="{{ route("ticket.index") }}" class="nk-menu-link  ">
                                                <span class="nk-menu-icon">
                                                    <i class="fas fa-headset"></i>
                                                </span>
                                                <span class="nk-menu-text">تیکت ها </span>
                                                @if(auth()->user()->unread_message())
                                                <span class="num_circle">{{ auth()->user()->unread_message() }}</span>
                                                @endif
                                            </a>
                                        </li>
                                        @endrole
                                        @role('customer')
                                        <li class="nk-menu-item   {{ Route::currentRouteName()=="advertiser.faqs"?"active":"" }}">
                                            <a href="{{ route("advertiser.faqs") }}" class="nk-menu-link  ">
                                                <span class="nk-menu-icon"><i class="fas fa-question-circle"></i></span>
                                                <span class="nk-menu-text">سوالات متداول</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item   {{ Route::currentRouteName()=="advertiser.sites"?"active":"" }}">
                                            <a href="{{ route("advertiser.sites") }}" class="nk-menu-link  ">
                                                <span class="nk-menu-icon"><i class="fas fa-globe"></i></span>
                                                <span class="nk-menu-text">دامنه های من </span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item   {{ Route::currentRouteName()=="advertiser.withdrawal.request"?"active":"" }}">
                                            <a href="{{ route("advertiser.withdrawal.request") }}" class="nk-menu-link  ">
                                                <span class="nk-menu-icon"><i class="fas fa-search-dollar"></i></span>
                                                <span class="nk-menu-text">مالی </span>
                                            </a>
                                        </li>

                                        <li class="nk-menu-item   {{ Route::currentRouteName()=="customer.money.charge"?"active":"" }}">
                                            <a href="{{ route("customer.money.charge") }}" class="nk-menu-link  ">
                                                <span class="nk-menu-icon"><i class="fas fa-wallet"></i></span>
                                                <span class="nk-menu-text">کیف </span>
                                            </a>
                                        </li>

                                        <li class="nk-menu-item   {{ Route::currentRouteName()=="logs"?"active":"" }}">
                                            <a href="{{ route("logs") }}" class="nk-menu-link  ">
                                                <span class="nk-menu-icon"><i class="fas fa-clipboard-list"></i></span>
                                                <span class="nk-menu-text">گزارشات </span>
                                                @if(auth()->user()->unread_logs()->count())
                                                <span class="num_circle">{{ auth()->user()->unread_logs()->count() }}</span>
                                                @endif
                                            </a>

                                        </li>


                                        <li class="nk-menu-item has-sub {{in_array(Route::currentRouteName(),[
                        'advertiser.list',
                        'advertiser.new.ad.popup',
                        'advertiser.new.ad.app',
                        'advertiser.new.ad.banner',
                        'advertiser.new.ad.fixpost',
                        'advertiser.new.ad.text',
                        'advertiser.new.ad.video',
                        ])?"active":""}} ">
                                            <a href="#" class="nk-menu-link nk-menu-toggle no_link ">
                                                <span class="nk-menu-icon">

                                                    <i class="fas fa-cog"></i>
                                                </span>
                                                <span class="nk-menu-text">لیست تبلیغات</span>
                                            </a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item {{ Route::currentRouteName()=="advertiser.list"?"active":"" }}">
                                                    <a class="nk-menu-link" href="{{ route("advertiser.list") }}">
                                                        <span class="nk-menu-text">
                                                            لیست تبلیغات
                                                        </span>

                                                    </a>
                                                </li>


                                                <li class="nk-menu-item {{ Route::currentRouteName()=="advertiser.new.ad.popup"?"active":"" }}">
                                                    <a class="nk-menu-link" href="{{ route("advertiser.new.ad.popup") }}">
                                                        <span class="nk-menu-text">
                                                            تبلیغات پاپ آپ
                                                        </span>

                                                    </a>
                                                </li>

                                                <li class="nk-menu-item {{ Route::currentRouteName()=="advertiser.new.ad.app"?"active":"" }}">
                                                    <a class="nk-menu-link" href="{{ route("advertiser.new.ad.app") }}">
                                                        <span class="nk-menu-text">
                                                            تبلیغات نصب اپلیکیشن
                                                        </span>

                                                    </a>
                                                </li>

                                                <li class="nk-menu-item {{ Route::currentRouteName()=="advertiser.new.ad.banner"?"active":"" }}">
                                                    <a class="nk-menu-link" href="{{ route("advertiser.new.ad.banner") }}">
                                                        <span class="nk-menu-text">
                                                            تبلیغات بنر
                                                        </span>

                                                    </a>
                                                </li>


                                                <li class="nk-menu-item {{ Route::currentRouteName()=="advertiser.new.ad.fixpost"?"active":"" }}">
                                                    <a class="nk-menu-link" href="{{ route("advertiser.new.ad.fixpost") }}">
                                                        <span class="nk-menu-text">
                                                            تبلیغات پست ثابت
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="nk-menu-item {{ Route::currentRouteName()=="advertiser.new.ad.text"?"active":"" }}">
                                                    <a class="nk-menu-link" href="{{ route("advertiser.new.ad.text") }}">
                                                        <span class="nk-menu-text">
                                                            تبلیغات متنی
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="nk-menu-item {{ Route::currentRouteName()=="advertiser.new.ad.video"?"active":"" }}">
                                                    <a class="nk-menu-link" href="{{ route("advertiser.new.ad.video") }}">
                                                        <span class="nk-menu-text">
                                                            تبلیغات ویدوئی
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- .nk-menu-sub -->
                                        </li>



                                        <li class="nk-menu-item has-sub {{in_array(Route::currentRouteName(),[
                                                'advertiser.bank.info',
                                                'advertiser.change.password',
                                                'advertiser.profile',
                                                ])?"active":""}} ">
                                            <a href="#" class="nk-menu-link nk-menu-toggle no_link ">
                                                <span class="nk-menu-icon">

                                                    <i class="fas fa-cog"></i>
                                                </span>
                                                <span class="nk-menu-text">پروفایل</span>
                                            </a>
                                            <ul class="nk-menu-sub">


                                                <li class="nk-menu-item {{ Route::currentRouteName()=="advertiser.bank.info"?"active":"" }}">
                                                    <a class="nk-menu-link" href="{{ route("advertiser.bank.info") }}">
                                                        <span class="nk-menu-text">
                                                            حساب بانکی
                                                        </span>
                                                    </a></li>

                                                <li class="nk-menu-item {{ Route::currentRouteName()=="advertiser.change.password"?"active":"" }}">
                                                    <a class="nk-menu-link" href="{{ route("advertiser.change.password") }}">
                                                        <span class="nk-menu-text">
                                                            رمز عبور
                                                        </span>
                                                    </a></li>


                                                <li class="nk-menu-item {{ Route::currentRouteName()=="advertiser.profile"?"active":"" }}">
                                                    <a class="nk-menu-link" href="{{ route("advertiser.profile") }}">
                                                        <span class="nk-menu-text">
                                                            پروفایل
                                                        </span>
                                                    </a></li>





                                            </ul>
                                            <!-- .nk-menu-sub -->
                                        </li>


                                        <li class="nk-menu-item has-sub {{in_array(Route::currentRouteName(),[
                                            'userticket.create',
                                            'userticket.index',
                                            'userticket.show',
                                            ])?"active":""}} ">
                                        <a href="#" class="nk-menu-link nk-menu-toggle no_link ">
                                            <span class="nk-menu-icon">
                                                <i class="fas fa-cog"></i>
                                            </span>
                                            <span class="nk-menu-text">پشتیبانی </span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item {{ Route::currentRouteName()=="userticket.index"?"active":"" }}">
                                                <a class="nk-menu-link" href="{{ route("userticket.index") }}">
                                                    <span class="nk-menu-text">
                                                        لیست تیکت ها
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item {{ Route::currentRouteName()=="userticket.create"?"active":"" }}">
                                                <a class="nk-menu-link" href="{{ route("userticket.create") }}">
                                                    <span class="nk-menu-text">
                                                        تیکت جدید
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- .nk-menu-sub -->
                                    </li>
                                        @endrole

                                        <li class="nk-menu-item   {{ Route::currentRouteName()=="logout"?"active":"" }}">
                                            <a href="{{ route("logout") }}" class="nk-menu-link  ">
                                                <span class="nk-menu-icon"><i class="fas fa-sign-out-alt"></i></span>
                                                <span class="nk-menu-text">خروج </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- .nk-menu -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="simplebar-placeholder" style="width: auto; height: 1678px;"></div>
                </div>
                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                </div>
                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                    <div class="simplebar-scrollbar" style="height: 131px; transform: translate3d(0px, 58px, 0px); display: block;"></div>
                </div>
            </div>
            <!-- .nk-sidebar-menu -->
        </div>
        <!-- .nk-sidebar-content -->
    </div>
    <!-- .nk-sidebar-element -->
</div>
