


<div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ms-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon no_link" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand d-xl-none">
                <a href="html/index.html" class="logo-link no_link">
                    {{--  <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="لوگو">
                    <img class="logo-dark logo-img" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="لوگوی تاریک">  --}}
                    <img class=" logo-small logo-img logo_side"  src="/site/images/logo.png">
                </a>
            </div>
            <!-- .nk-header-brand -->
            {{--  <div class="nk-header-search ms-3 ms-xl-0">
                <em class="icon ni ni-search"></em>
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="هر چیزی که می خواهید را جستجو کنید">
            </div>  --}}
            <!-- .nk-header-news -->
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    {{--  <li class="dropdown language-dropdown d-none d-sm-block me-n1">
                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                            <div class="quick-icon border border-light">
                                <img class="icon" src="./images/flags/iran-sq.png" alt="">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-s1">
                            <ul class="language-list">
                                <li>
                                    <a href="#" class="language-item">
                                        <img src="./images/flags/iran.png" alt="" class="language-flag">
                                        <span class="language-name">فارسی</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="language-item">
                                        <img src="./images/flags/english.png" alt="" class="language-flag">
                                        <span class="language-name">انگلیسی</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="language-item">
                                        <img src="./images/flags/germany.png" alt="" class="language-flag">
                                        <span class="language-name">آلمانی</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="language-item">
                                        <img src="./images/flags/french.png" alt="" class="language-flag">
                                        <span class="language-name">فرانسوی</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>  --}}
                    <!-- .dropdown -->
                    <li class="dropdown chats-dropdown hide-mb-xs">
                        <a href="#" class="no_link dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                            <div class="icon-status icon-status-na">
                                <em class="icon ni ni-comments"></em>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
                            <div class="dropdown-head">
                                <span class="sub-title nk-dropdown-title">گفتگوهای اخیر</span>
                                <a href="#">تنظیمات</a>
                            </div>
                            <div class="dropdown-body">
                                <ul class="chat-list">
                                    <li class="chat-item">
                                        <a class="chat-link" href="html/apps-chats.html">
                                            <div class="chat-media user-avatar">
                                                <span>م‌م</span>
                                                <span class="status dot dot-lg dot-gray"></span>
                                            </div>
                                            <div class="chat-info">
                                                <div class="chat-from">
                                                    <div class="name">مهرداد موسوی</div>
                                                    <span class="time">الان</span>
                                                </div>
                                                <div class="chat-context">
                                                    <div class="text">
                                                        شما: لطفا اگه آخرین پیام های من رو دریافت کردید، تایید کنید.
                                                    </div>
                                                    <div class="status delivered">
                                                        <em class="icon ni ni-check-circle-fill"></em>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <!-- .chat-item -->
                                </ul>
                                <!-- .chat-list -->
                            </div>
                            <!-- .nk-dropdown-body -->
                            <div class="dropdown-foot center">
                                <a href="html/apps-chats.html">مشاهده همه</a>
                            </div>
                        </div>
                    </li>
                    @role('customer')
                    <li class="dropdown notification-dropdown">
                        <a href="#" class="no_link dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                            <div class="icon-status icon-status-info">
                                <em class="icon ni ni-bell"></em>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
                            <div class="dropdown-head">
                                <span class="sub-title nk-dropdown-title">اطلاع رسانی ها</span>
                            </div>
                            <div class="dropdown-body">
                                <div class="nk-notification">
                                    <ul>
                                        @foreach (auth()->user()->logs()->latest()->take(5) as $log)
                                        @include('advertiser.log_temp')
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- .nk-notification -->
                            </div>
                            <!-- .nk-dropdown-body -->
                            <div class="dropdown-foot center">
                                <a href="{{ route("logs") }}">مشاهده همه</a>
                            </div>
                        </div>
                    </li>
                    @endrole
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle no_link me-n1" data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm">
                                    <img src="{{ auth()->user()->avatar() }}" alt="">
                                                                                                </div>
                                <div class="user-info d-none d-xl-block">
                                    {{--  <div class="user-status user-status-unverified">
                                        تایید نشده
                                    </div>  --}}
                                    <div class="user-name dropdown-indicator">
                                        {{ auth()->user()->name }}
                                        {{ auth()->user()->family }}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <img src="{{ auth()->user()->avatar() }}" alt="">
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">  {{ auth()->user()->name }}
                                            {{ auth()->user()->family }}</span>
                                        <span class="sub-text">

                                            {{ auth()->user()->mobile }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a href="html/user-profile-regular.html"><em class="icon ni ni-user-alt"></em><span>مشاهده پروفایل</span></a>
                                    </li>
                                    <li>
                                        <a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>تنظیمات حساب</span></a>
                                    </li>
                                    <li>
                                        <a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>فعالیت ورود</span></a>
                                    </li>
                                    <li>
                                        <a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>حالت تاریک</span></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a href="#"><em class="icon ni ni-signout"></em><span>خروج</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- .nk-header-wrap -->
    </div>
    <!-- .container-fliud -->
</div>






{{--  <header id="header" class="home_header">
    <div class="tarlanweb_center">
        <div class="top_header">

            <div class="logo">
                <figure><a href="{{ route("home")}}"><img src="/site/images/logo.png" width="150" height="42" alt="تبلیغات"></a></figure>
            </div>

            <div class="left_top_box flex">

                <div class="navicon"><i class="fa fa-bars"></i></div>
                <a class="credit_box flex" href="{{ route("customer.money.charge") }}">
                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 19H6.2C5.07989 19 4.51984 19 4.09202 18.782C3.71569 18.5903 3.40973 18.2843 3.21799 17.908C3 17.4802 3 16.9201 3 15.8V8.2C3 7.0799 3 6.51984 3.21799 6.09202C3.40973 5.71569 3.71569 5.40973 4.09202 5.21799C4.51984 5 5.0799 5 6.2 5H17.8C18.9201 5 19.4802 5 19.908 5.21799C20.2843 5.40973 20.5903 5.71569 20.782 6.09202C21 6.51984 21 7.0799 21 8.2V12M3 9H21M18 21V15M21 18.0008L15 18" stroke="#000000" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg> اعتبار :
                    {{ number_format(auth()->user()->balance()) }}

                    تومان</a>
                <div class="alert_bell">
                    @if($un_read_log=auth()->user()->unread_logs()->count())

                    <div class="notific_item">
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.00195 17H5.60636C4.34793 17 3.71872 17 3.58633 16.9023C3.4376 16.7925 3.40126 16.7277 3.38515 16.5436C3.37082 16.3797 3.75646 15.7486 4.52776 14.4866C5.32411 13.1835 6.00031 11.2862 6.00031 8.6C6.00031 7.11479 6.63245 5.69041 7.75766 4.6402C8.88288 3.59 10.409 3 12.0003 3C13.5916 3 15.1177 3.59 16.2429 4.6402C17.3682 5.69041 18.0003 7.11479 18.0003 8.6C18.0003 11.2862 18.6765 13.1835 19.4729 14.4866C20.2441 15.7486 20.6298 16.3797 20.6155 16.5436C20.5994 16.7277 20.563 16.7925 20.4143 16.9023C20.2819 17 19.6527 17 18.3943 17H15.0003M9.00195 17L9.00031 18C9.00031 19.6569 10.3435 21 12.0003 21C13.6572 21 15.0003 19.6569 15.0003 18V17M9.00195 17H15.0003" stroke="#000000" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                        <a href="{{ route("logs") }}">
                            <span class="alert_num">{{ $un_read_log }}</span>


                        </a>
                        @endif



                </div>
                <div class="profile_me">

                    <div class="account_show flex">
                        <img src="{{ auth()->user()->avatar() }}" class="avatar" alt="avatar">
                        {{auth()->user()->name}}
                        {{auth()->user()->family}}
                        <svg width="10px" height="10px" viewBox="0 -19.04 75.804 75.804" xmlns="http://www.w3.org/2000/svg">
                            <g id="Group_67" data-name="Group 67" transform="translate(-798.203 -587.815)">
                                <path id="Path_59" data-name="Path 59" d="M798.2,589.314a1.5,1.5,0,0,1,2.561-1.06l33.56,33.556a2.528,2.528,0,0,0,3.564,0l33.558-33.556a1.5,1.5,0,1,1,2.121,2.121l-33.558,33.557a5.53,5.53,0,0,1-7.807,0l-33.56-33.557A1.5,1.5,0,0,1,798.2,589.314Z" stroke="#000000" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </svg>
                    </div>

                    <div class="account_info_box box_shdow" style="">
                        <div class="center_c">
                            <img src="{{ auth()->user()->avatar() }}" width="50" height="50" alt="">
                            <p>
                                {{auth()->user()->name}}
                                {{auth()->user()->family}}

                            </p>
                            <p> {{auth()->user()->mobile}}</p>
                            @role('customer')
                            <p> {{number_format(auth()->user()->balance())}}
                                تومان
                            </p>
                            @if(auth()->user()->vip)
                            <div class="user_type vip_user"> <i class="fa fa-user-o"></i>کاربر اختصاصی</div>

                            @else
                            <div class="user_type normal_user"> <i class="fa fa-user-o"></i>کاربر  معمولی</div>

                            @endif
                            @endrole
                        </div>
                        <div class="top_acc_b">
                            <ul>
                                <li><a href="{{ route("logout") }}"><svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="grid_system"></g>
                                            <g id="_icons">
                                                <g>
                                                    <path d="M16.6,4.2c-0.5-0.3-1.1-0.1-1.4,0.4c-0.3,0.5-0.1,1.1,0.4,1.4c2.1,1.3,3.5,3.6,3.5,6c0,3.9-3.1,7-7,7s-7-3.1-7-7    c0-2.5,1.4-4.8,3.5-6.1C9,5.6,9.2,5,8.9,4.6C8.6,4.1,8,3.9,7.5,4.2C4.7,5.8,3,8.8,3,12c0,5,4,9,9,9s9-4,9-9    C21,8.8,19.3,5.9,16.6,4.2z"></path>
                                                    <path d="M12,13c0.6,0,1-0.4,1-1V3c0-0.6-0.4-1-1-1s-1,0.4-1,1v9C11,12.6,11.4,13,12,13z"></path>
                                                </g>
                                            </g>
                                        </svg> خروج</a></li>
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>

            </div>


        </div>
    </div>
    <div class="clear"></div>
</header>  --}}
