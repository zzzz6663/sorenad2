@extends('main.manager')

@section('content')


<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">سایت ها</h3>
            <div class="nk-block-des text-soft">
                <p>شما در مجموع

                    {{ $sites->total() }}
                    سایت دارید.</p>
            </div>
        </div>
        <!-- .nk-block-head-content -->


        {{-- <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                        <li>
                            <a href="#" class="btn btn-white btn-outline-light"><em class="icon ni ni-download-cloud"></em><span>خروجی گرفتن</span></a>
                        </li>
                        <li class="nk-block-tools-opt">
                            <div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        <li>
                                            <a href="#"><span>افزودن کاربر</span></a>
                                        </li>
                                        <li>
                                            <a href="#"><span>افزودن تیم</span></a>
                                        </li>
                                        <li>
                                            <a href="#"><span>وارد کردن کاربر</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- .toggle-wrap -->
        </div>  --}}
        <!-- .nk-block-head-content -->
    </div>
    <!-- .nk-block-between -->
</div>
<div class="nk-block">
    <div class="card card-stretch">
        <div class="card-inner-group">

            <form action="{{ route('site.index') }}" method="get" autocomplete="off">
                @csrf
                @method('get')
                <div class="card-inner position-relative card-tools-toggle">
                    <div class="card-title-group">
                        <div class="card-tools">
                            <div class="form-inline flex-nowrap gx-3">
                                <div class="form-wrap w-150px">
                                    <label for="search">جستجو</label>
                                    <input type="text" name="search" value="{{ request('search') }}" class="form-control ">
                                </div>
                                <div class="form-wrap w-150px">
                                    <label for="from">از</label>
                                    <input type="text" name="from" value="{{ request('from') }}" class="form-control date-picker">
                                </div>
                                <div class="form-wrap w-150px">
                                    <label for="to">تا </label>
                                    <input type="text" name="to" value="{{ request('to') }}" class="form-control date-picker">
                                </div>
                                <div class="form-wrap w-150px">
                                    <label for="status">وضعیت </label>
                                    <select class="form-control" name="status" id="status">
                                        <option value=""> انتخاب کنید </option>
                                        @foreach (__("site_status") as $key=>$val )
                                        <option {{ request("status")==$key?"selected":"" }} value="{{ $key }}"> {{ $val }}  </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-wrap w-150px">
                                    <label for="site_id">مشتری  </label>
                                    <select class="form-control select2" name="site_id" id="site_id"  >
                                        <option value=""> انتخاب کنید </option>
                                        @foreach ($customers as $customer )
                                            <option  {{ request("site_id")?"selected":"0" }} value="{{ $customer->id }}">
                                                {{ $customer->name }}
                                                {{ $customer->family }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-wrap w-150px">
                                    <span class="">
                                        <br>
                                        <button class="btn btn-dim btn-outline-light ">
                                            اعمال
                                        </button>
                                    </span>
                                    @if(request()->has("search"))
                                    <a href="{{ route("site.index") }}" class="btn btn-danger"><i class="fas fa-window-close"></i></a>
                                    @endif
                                </div>
                            </div>
                            <!-- .form-inline -->
                        </div>

                    </div>
                    <!-- .card-title-group -->
                    <div class="card-search search-wrap" data-search="search">
                        <div class="card-body">
                            <div class="search-content">
                                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                <input type="text" class="form-control border-transparent form-focus-none" placeholder="جستجو بر اساس کاربر یا ایمیل">
                                <button class="search-submit btn btn-icon">
                                    <em class="icon ni ni-search"></em>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- .card-search -->
                </div>
                <!-- .card-inner -->
                <div class="card-inner p-0">
                    <div class="nk-tb-list nk-tb-ulist is-compact">
>


                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col nk-tb-col-check">
                                id
                            </div>

                            <div class="nk-tb-col tb-col-md">
                                <span class="sub-text">مالک</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="sub-text">نام</span>
                            </div>

                            <div class="nk-tb-col tb-col-sm">
                                <span class="sub-text">دامنه</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="sub-text">وضعیت</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="sub-text">توضیحات</span>
                            </div>


                            <div class="nk-tb-col tb-col-lg">
                                <span class="sub-text">تاریخ</span>
                            </div>

                            <div class="nk-tb-col">
                                <span class="sub-text">عملیات</span>
                            </div>

                        </div>
                        @foreach ($sites as $site )
                        <div class="nk-tb-item">
                            {{-- <div class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="uid1">
                                    <label class="custom-control-label" for="uid1"></label>
                                </div>
                            </div>  --}}
                            <div class="nk-tb-col">
                                {{ $loop->iteration }}
                            </div>

                            <div class="nk-tb-col">
                                <div class="site-card">
                                    <div class="site-name">
                                        <span class="tb-lead">
                                            {{ $site->user->name }}
                                            {{ $site->user->family }}

                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col">
                                <div class="site-card">
                                    <div class="site-name">
                                        <span class="tb-lead">
                                            {{ $site->name }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col">
                                <div class="site-card">
                                    <div class="site-name">
                                        <span class="tb-lead">
                                            {{ $site->site }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                {{ __("site_status.".$site->status) }}

                                @if($site->status=="created")
                                بررسی نشده
                                    @else
                                    <span class="text tooltiper text-{{ $site->status=="confirmed"?"success":"danger" }} " title="{{ $site->status=="confirmed"?"فعال":"غیر فعال" }}">
                                        <i class="fa-solid tooltiper
                                             {{ $site->status=="confirmed"?"fa-badge-check":"fa-circle-xmark" }} ">
                                            </i>
                                    </span>
                                @endif
                            </div>
                            <div class="nk-tb-col tb-col-sm">

                                {{ $site->reason }}
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span>
                                    {{ jdate($site->created_at)->format("Y-m-d") }}
                                </span>
                            </div>



                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-2">

                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="btn no_link btn-sm btn-icon btn-trigger dropdown-toggle" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">




                                                    <li>

                                                        @if($site->confirm)
                                                        <span>
                                                            بررسی شده در
                                                            {{ jdate($site->confirm)->format("Y-m-d") }}
                                                        </span>
                                                        @else
                                                       <a href="{{ route("site.confirm",$site->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="بررسی  " class="  ">
                                                        <i class="fas fa-search"></i>
                                                        بررسی

                                                       </a>

                                                        @endif
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <!-- .nk-tb-list -->
                </div>

                <div class="card-inner">
                    {{ $sites->appends(Request::all())->links('admin.section.pagination') }}
                </div>
                {{-- <!-- .card-inner -->
            <div class="card-inner">
                <ul class="pagination justify-content-center justify-content-md-start">
                    <li class="page-item">
                        <a class="page-link" href="#">قبلی</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <span class="page-link"><em class="icon ni ni-more-h"></em></span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">6</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">7</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">بعدی</a>
                    </li>
                </ul>
                <!-- .pagination -->
            </div>
            <!-- .card-inner -->  --}}
            </form>
        </div>
        <!-- .card-inner-group -->
    </div>
    <!-- .card -->
</div>














{{--  <div class="card-header ">
    <h2 class="title_right">مدیریت سایت کاربران</h2>

    <form action="{{ route('site.index') }}" method="get" autocomplete="off">
        @csrf
        @method('get')
        <div class="row">
            <div class="col-lg-2">
                <label for="search">جستجو</label>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control ">
            </div>
            <div class="col-lg-2">
                <label for="from">از</label>
                <input type="text" name="from" value="{{ request('from') }}" class="form-control persian_date">
            </div>
            <div class="col-lg-2">
                <label for="to">تا </label>
                <input type="text" name="to" value="{{ request('to') }}" class="form-control persian_date">
            </div>
            <div class="col-lg-2">
                <label for="status">وضعیت </label>
                <select class="form-control" name="status" id="status">
                    <option value=""> انتخاب کنید </option>
                    @foreach (__("site_status") as $key=>$val )
                    <option {{ request("status")==$key?"selected":"" }} value="{{ $key }}"> {{ $val }}  </option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2">
                <label for="site_id">مشتری  </label>
                <select class="form-control select2" name="site_id" id="site_id"  >
                    <option value=""> انتخاب کنید </option>
                    @foreach ($customers as $customer )
                        <option  {{ request("site_id")?"selected":"0" }} value="{{ $customer->id }}">
                            {{ $customer->name }}
                            {{ $customer->family }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2">
                <br>
                <button class="btn btn-success">
                    جست جو
                </button>
                @if(request()->has("search"))
                <a href="{{ route("site.index") }}" class="btn btn-danger"><i class="fas fa-window-close"></i></a>
                @endif
            </div>
            <div class="col-lg-2">
                <br>
              <h5>
                {{ $sites->total() }}
                رکورد
              </h5>
            </div>
        </div>

    </form>

</div>
<br>
<div id="">
    <div class="flex dashbord_table admin_dashboard_table_xs">
        <table>
            <thead>
                <tr>
                    <th>نام</th>
                    <th>مالک </th>
                    <th>نام </th>
                    <th>سایت </th>
                    <th>وضعیت  </th>
                    <th>توضیحات  </th>
                    <th>تاریخ</th>

                    <th>عملیات</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($sites as $site )
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $site->site->name }}
                        {{ $site->site->family }}
                    </td>
                    <td>
                        {{ $site->name }}
                    </td>
                    <td>{{ $site->site }}</td>
                    <td>{{ __("site_status.".$site->status) }}

                        @if($site->status=="created")
                        بررسی نشده
                            @else
                            <span class="text tooltiper text-{{ $site->status=="confirmed"?"success":"danger" }} " title="{{ $site->status=="confirmed"?"فعال":"غیر فعال" }}">
                                <i class="fa-solid tooltiper
                                     {{ $site->status=="confirmed"?"fa-badge-check":"fa-circle-xmark" }} ">
                                    </i>
                            </span>
                        @endif
                    </td>
                    <td>{{ $site->reason }}</td>


                    <td>{{ jdate($site->created_at)->format("Y-m-d") }}</td>
                    <td>
                        @if($site->confirm)
                        <span>
                            بررسی شده در
                            {{ jdate($site->confirm)->format("Y-m-d") }}
                        </span>
                        @else
                       <a href="{{ route("site.confirm",$site->id) }}" class="btn btn-success">بررسی</a>

                        @endif

                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>







    </div>



    <!-- delete site -->
    <div class="popup_c_bg1">
        <div class="popuup_c_box1">
            <div class="pop_title_c_box">
                <h5>حذف کاربر</h5>
            </div>
            <div class="btn_close_c_top close_c_box1"> <span>+</span> </div>
            <div class="modal-body">
                <p>مطمعن هستید که میخواهید کاربر را حذف کنید ؟</p>
                <p><a class="btn_links green_urlx" href="">بله</a> <a class="btn_links red_urlx" href="">خیر</a></p>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- delete site -->

    <!-- deactive site -->
    <div class="popup_c_bg2">
        <div class="popuup_c_box2">
            <div class="pop_title_c_box">
                <h5>غیرفعال کردن کاربر</h5>
            </div>
            <div class="btn_close_c_top close_c_box2"> <span>+</span> </div>
            <div class="modal-body">
                <p>مطمعن هستید که میخواهید کاربر را غیرفعال کنید ؟</p>
                <p><a class="btn_links green_urlx" href="">بله</a> <a class="btn_links red_urlx" href="">خیر</a></p>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- deactive site -->

    <!-- increase money site -->
    <div class="popup_c_bg3">
        <div class="popuup_c_box3">
            <div class="pop_title_c_box">
                <h5>افزایش موجودی</h5>
            </div>
            <div class="btn_close_c_top close_c_box3"> <span>+</span> </div>
            <div class="modal-body">
                <p>میزان افزایش موجودی را وارد کنید.</p>
                <div class="flex increase_form">
                    <input type="text" name="" placeholder="مبلغ را وارد کنید">
                    <input type="submit" value="ثبت">
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- increase money site -->

    <!-- dencrease money site -->
    <div class="popup_c_bg4">
        <div class="popuup_c_box4">
            <div class="pop_title_c_box">
                <h5>کاهش موجودی</h5>
            </div>
            <div class="btn_close_c_top close_c_box4"> <span>+</span> </div>
            <div class="modal-body">
                <p>میزان کاهش موجودی را وارد کنید.</p>
                <div class="flex increase_form">
                    <input type="text" name="" placeholder="مبلغ را وارد کنید">
                    <input type="submit" value="ثبت">
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- dencrease money site -->


    <!-- dencrease money site -->
    <div class="popup_c_bg5">
        <div class="popuup_c_box5">
            <div class="pop_title_c_box">
                <h5>ارسال پیام</h5>
            </div>
            <div class="btn_close_c_top close_c_box5"> <span>+</span> </div>
            <div class="modal-body">

                <div class="flex adx_form">
                    <input type="text" name="" placeholder="عنوان">
                    <textarea placeholder="متن پیام"></textarea>
                    <input type="submit" value="ارسال">
                </div>

                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- dencrease money site -->


    <!-- edite site -->
    <div class="popup_c_bg6">
        <div class="popuup_c_box6">
            <div class="pop_title_c_box">
                <h5>ویرایش اطلاعات</h5>
            </div>
            <div class="btn_close_c_top close_c_box6"> <span>+</span> </div>
            <div class="modal-body">

                <div class="flex adx_form">
                    <input type="text" name="" placeholder="نام">
                    <input type="text" name="" placeholder="نام خانوادگی">
                    <input type="text" name="" placeholder="سمت">
                    <input type="text" name="" placeholder="تلفن همراه">
                    <input type="text" name="" placeholder="رمز عبور">
                    <input type="submit" value="ارسال">
                </div>

                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- edite site -->

    <!-- vip site -->
    <div class="popup_c_bg7">
        <div class="popuup_c_box7">
            <div class="pop_title_c_box">
                <h5>ارتقاء به کاربر vip</h5>
            </div>
            <div class="btn_close_c_top close_c_box7"> <span>+</span> </div>
            <div class="modal-body">
                <p>مطمعن هستید که میخواهید کاربر را vip کنید ؟</p>
                <p><a class="btn_links green_urlx" href="">بله</a> <a class="btn_links red_urlx" href="">خیر</a></p>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- vip site -->

    <!-- normal site -->
    <div class="popup_c_bg8">
        <div class="popuup_c_box8">
            <div class="pop_title_c_box">
                <h5>بازگشت به کاربر معمولی</h5>
            </div>
            <div class="btn_close_c_top close_c_box8"> <span>+</span> </div>
            <div class="modal-body">
                <p>مطمعن هستید که میخواهید کاربر را معمولی کنید ؟</p>
                <p><a class="btn_links green_urlx" href="">بله</a> <a class="btn_links red_urlx" href="">خیر</a></p>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- normal site -->


    <div class="clear"></div>
</div>  --}}
@endsection
