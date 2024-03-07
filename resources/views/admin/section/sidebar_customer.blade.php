<div id="sidebar_right">
    @if(session()->get("advertiser"))
    <h1>
        پنل نمایش دهنده
    </h1>
    <div class="bodydeactive"><i class="fa fa-close"></i></div>

    <a class="ads_send_panel" href="{{ route("change.panel") }}">ورود به پنل تبلیغ دهنده</a>

    @else

    <h1>
        پنل تبلیغ دهنده
    </h1>
    <a class="ads_send_panel" href="{{ route("change.panel") }}">ورود به پنل نمایش دهنده</a>
    <div class="bodydeactive"><i class="fa fa-close"></i></div>

    @endif

    <div class="accordionWrapper box_shdow">

        @if(session()->get("advertiser"))

        <div class="accordionItem ">
            <a href="{{ route("logs") }}" class="{{(Route::currentRouteName()=='logs')?'mactive':''}}">
                <i class="fa-solid fa-quote-left"></i>
                گزارشات
                @if(auth()->user()->unread_logs()->count())
                <span class="num_circle">{{ auth()->user()->unread_logs()->count() }}</span>
                @endif
            </a>
        </div>


        <div class="accordionItem ">
            <a href="{{ route("advertiser.sites") }}" class="{{(Route::currentRouteName()=='advertiser.sites')?'mactive':''}}">
                <i class="fa-solid fa-globe"></i>
                دامنه های من
            </a>
        </div>


        <div class="accordionItem {{in_array(Route::currentRouteName(),[
            'advertiser.withdrawal.request',
            'advertiser.withdrawal.list',
            ])?"open":"close"}}">
            <div class="accordionItemHeading">
                <span><i class="fa-solid fa-money-bill-wave"></i>
                    امور مالی </span>
                <div class="left_arrow"><svg width="10px" height="10px" viewBox="0 -19.04 75.804 75.804" xmlns="http://www.w3.org/2000/svg">
                        <g id="Group_67" data-name="Group 67" transform="translate(-798.203 -587.815)">
                            <path id="Path_59" data-name="Path 59" d="M798.2,589.314a1.5,1.5,0,0,1,2.561-1.06l33.56,33.556a2.528,2.528,0,0,0,3.564,0l33.558-33.556a1.5,1.5,0,1,1,2.121,2.121l-33.558,33.557a5.53,5.53,0,0,1-7.807,0l-33.56-33.557A1.5,1.5,0,0,1,798.2,589.314Z" stroke="#000000" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                    </svg></div>
            </div>
            <div class="accordionItemContent">
                <ul>

                    <li class="subitem {{ Route::currentRouteName()=="advertiser.withdrawal.request"?"active":"" }}"><a href="{{ route("advertiser.withdrawal.request") }}">درخواست تسویه حساب</a></li>
                    {{-- <li class="subitem {{ Route::currentRouteName()=="advertiser.withdrawal.list"?"active":"" }}"><a href="{{ route("advertiser.withdrawal.list") }}">لیست درخواست ها</a></li> --}}

                </ul>
            </div>
        </div>




        {{-- <a href="{{ route("advertiser.bank.info") }}" class="{{(Route::currentRouteName()=='advertiser.bank.info')?'mactive':''}}">
        <svg fill="#000000" stroke-width="2" width="30px" height="30px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
            <path d="M512 277.333c-58.974 0-106.667 47.693-106.667 106.667 0 11.782-9.551 21.333-21.333 21.333s-21.333-9.551-21.333-21.333c0-82.538 66.795-149.333 149.333-149.333S661.333 301.463 661.333 384c0 75.294-55.586 137.489-128 147.823V640c0 11.78-9.553 21.333-21.333 21.333S490.667 651.78 490.667 640V512c0-11.78 9.553-21.333 21.333-21.333 58.974 0 106.667-47.693 106.667-106.667S570.974 277.333 512 277.333zm0 506.454c23.565 0 42.667-19.102 42.667-42.667S535.565 698.453 512 698.453s-42.667 19.102-42.667 42.667 19.102 42.667 42.667 42.667z"></path>
            <path d="M512 85.333C276.358 85.333 85.333 276.358 85.333 512c0 235.639 191.025 426.667 426.667 426.667 235.639 0 426.667-191.027 426.667-426.667C938.667 276.358 747.64 85.333 512 85.333zM128 512c0-212.077 171.923-384 384-384 212.079 0 384 171.923 384 384 0 212.079-171.921 384-384 384-212.077 0-384-171.921-384-384z"></path>
        </svg>
        اطلاعات حساب بانکی
        </a> --}}



        @else
        <div class="accordionItem ">
            <a href="{{ route("customer.money.charge") }}" class="{{(Route::currentRouteName()=='customer.money.charge')?'mactive':''}}">
                <i class="fa-solid fa-money-check-dollar"></i>

                شارژ حساب</a>
        </div>
        <div class="accordionItem ">
            <a href="">
                <i class="fa-solid fa-rectangle-ad"></i>
                مدیریت تبلیغات </a>
        </div>
        <div class="accordionItem ">
            <a href="">
                <i class="fa-solid fa-chart-line"></i>

                گزارش نمایش تبلیغات </a>
        </div>

        <div class="accordionItem {{in_array(Route::currentRouteName(),[
            'advertiser.list',
            'advertiser.new.ad.popup',
            'advertiser.new.ad.app',
            'advertiser.new.ad.banner',
            'advertiser.new.ad.fixpost',
            'advertiser.new.ad.text',
            'advertiser.new.ad.video',
            ])?"open":"close"}}">
            <div class="accordionItemHeading">

                <span>

                    <i class="fa-solid fa-cart-plus"></i>

                    سفارش تبلیغات</span>

                <div class="left_arrow"><svg width="10px" height="10px" viewBox="0 -19.04 75.804 75.804" xmlns="http://www.w3.org/2000/svg">
                        <g id="Group_67" data-name="Group 67" transform="translate(-798.203 -587.815)">
                            <path id="Path_59" data-name="Path 59" d="M798.2,589.314a1.5,1.5,0,0,1,2.561-1.06l33.56,33.556a2.528,2.528,0,0,0,3.564,0l33.558-33.556a1.5,1.5,0,1,1,2.121,2.121l-33.558,33.557a5.53,5.53,0,0,1-7.807,0l-33.56-33.557A1.5,1.5,0,0,1,798.2,589.314Z" stroke="#000000" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                    </svg></div>

            </div>
            <div class="accordionItemContent">
                <ul>

                    <li class="subitem {{ Route::currentRouteName()=="advertiser.list"?"active":"" }}"><a href="{{ route("advertiser.list") }}"> لیست تبلیغات</a></li>
                    <li class="subitem {{ Route::currentRouteName()=="advertiser.new.ad.popup"?"active":"" }}"><a href="{{ route("advertiser.new.ad.popup") }}">تبلیغات پاپ آپ</a></li>
                    <li class="subitem {{ Route::currentRouteName()=="advertiser.new.ad.app"?"active":"" }}"><a href="{{ route("advertiser.new.ad.app") }}">تبلیغات نصب اپلیکیشن</a></li>
                    <li class="subitem {{ Route::currentRouteName()=="advertiser.new.ad.banner"?"active":"" }}"><a href="{{ route("advertiser.new.ad.banner") }}">تبلیغات بنر </a></li>
                    <li class="subitem {{ Route::currentRouteName()=="advertiser.new.ad.fixpost"?"active":"" }}"><a href="{{ route("advertiser.new.ad.fixpost") }}">تبلیغات پست ثابت </a></li>
                    <li class="subitem {{ Route::currentRouteName()=="advertiser.new.ad.text"?"active":"" }}"><a href="{{ route("advertiser.new.ad.text") }}">تبلیغات متنی </a></li>
                    <li class="subitem {{ Route::currentRouteName()=="advertiser.new.ad.video"?"active":"" }}"><a href="{{ route("advertiser.new.ad.video") }}">تبلیغات ویدئویی </a></li>

                    {{-- <li><a href="">تبلیغات نصب اپلیکیشن</a></li>
                    <li><a href="">تبلیغات پست ثابت</a></li>
                    <li><a href="">تبلیغات ویدیویی</a></li>
                    <li><a href="">تبلیغات متنی</a></li>
                    <li><a href="">تبلیغات بنری</a></li>  --}}
                </ul>
            </div>
        </div>







        @endif

        <div class="accordionItem {{in_array(Route::currentRouteName(),[
        'advertiser.bank.info',
        'advertiser.change.password',
        'advertiser.profile',
        ])?"open":"close"}}">
            <div class="accordionItemHeading">

                <span>
                    <i class="fa-solid fa-gears"></i>
                    تنظیمات</span>

                <div class="left_arrow"><svg width="10px" height="10px" viewBox="0 -19.04 75.804 75.804" xmlns="http://www.w3.org/2000/svg">
                        <g id="Group_67" data-name="Group 67" transform="translate(-798.203 -587.815)">
                            <path id="Path_59" data-name="Path 59" d="M798.2,589.314a1.5,1.5,0,0,1,2.561-1.06l33.56,33.556a2.528,2.528,0,0,0,3.564,0l33.558-33.556a1.5,1.5,0,1,1,2.121,2.121l-33.558,33.557a5.53,5.53,0,0,1-7.807,0l-33.56-33.557A1.5,1.5,0,0,1,798.2,589.314Z" stroke="#000000" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                    </svg></div>

            </div>
            <div class="accordionItemContent">
                <ul>
                    <li class="subitem {{ Route::currentRouteName()=="advertiser.profile"?"active":"" }}"><a href="{{ route("advertiser.profile") }}">اطلاعات کلی</a></li>
                    <li class="subitem {{ Route::currentRouteName()=="advertiser.bank.info"?"active":"" }}"><a href="{{ route("advertiser.bank.info") }}"> اطلاعات مالی</a></li>
                    <li class="subitem {{ Route::currentRouteName()=="advertiser.change.password"?"active":"" }}"><a href="{{ route("advertiser.change.password") }}"> تغییر رمز عبور</a></li>
                </ul>
            </div>
        </div>
        <div class="accordionItem {{in_array(Route::currentRouteName(),[
        'userticket.create',
        'userticket.index',
        'userticket.show',
        ])?"open":"close"}}">
            <div class="accordionItemHeading">
                <span><i class="fa-solid fa-comments"></i>
                    پشتیبانی
                    @if(auth()->user()->unread_message())
                    <span class="num_circle">{{ auth()->user()->unread_message() }}</span>
                    @endif
                </span>
                <div class="left_arrow"><svg width="10px" height="10px" viewBox="0 -19.04 75.804 75.804" xmlns="http://www.w3.org/2000/svg">
                        <g id="Group_67" data-name="Group 67" transform="translate(-798.203 -587.815)">
                            <path id="Path_59" data-name="Path 59" d="M798.2,589.314a1.5,1.5,0,0,1,2.561-1.06l33.56,33.556a2.528,2.528,0,0,0,3.564,0l33.558-33.556a1.5,1.5,0,1,1,2.121,2.121l-33.558,33.557a5.53,5.53,0,0,1-7.807,0l-33.56-33.557A1.5,1.5,0,0,1,798.2,589.314Z" stroke="#000000" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                    </svg></div>
            </div>
            <div class=" accordionItemContent ">
                <ul>
                    <li class="subitem {{ Route::currentRouteName()=="userticket.create"?"active":"" }}"><a href="{{ route("userticket.create") }}">ارسال تیکت جدید</a></li>
                    <li class="subitem {{ Route::currentRouteName()=="userticket.index"?"active":"" }}"><a href="{{ route("userticket.index") }}">لیست تیکت ها</a></li>
                    {{-- <li class="subitem {{ Route::currentRouteName()=="userticket.show."?"active":"" }}"><a href="{{ route("userticket.show") }}"> پیام های دریافتی</a></li> --}}
                </ul>
            </div>
        </div>

        <div class="accordionItem ">
            <a href="">

                <i class="fa-solid fa-phone"></i>
                تماس با پشتیبانی</a>

        </div>
        <div class="accordionItem ">
            <a href="{{ route("advertiser.faqs") }}" class="{{(Route::currentRouteName()=='advertiser.faqs')?'mactive':''}}">
                <i class="fa-solid fa-circle-question"></i>
                سوالات متداول
            </a>
        </div>
        <div class="accordionItem ">
            <a href="{{ route("logout") }}">
                <i class="fa-solid fa-right-from-bracket"></i>

                خروج از حساب</a>
        </div>
    </div>
    <div class="clear"></div>
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
</div>
