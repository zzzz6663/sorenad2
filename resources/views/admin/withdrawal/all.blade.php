@extends('main.manager')
@section('content')

<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">لیست درخواست</h3>
            <div class="nk-block-des text-soft">
                <p>شما در مجموع

                    {{ $withdrawals->total() }}
                    درخواست دارید.</p>
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

            <form action="{{ route('withdrawal.index') }}" method="get" autocomplete="off">
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
                                    <label for="user_id">مشتری </label>
                                    <select class="form-control select2" name="user_id" id="user_id"  >
                                        <option value=""> انتخاب کنید </option>
                                        @foreach ($customers as $customer )
                                            <option  {{ request("user_id")?"selected":"0" }} value="{{ $customer->id }}">
                                                {{ $customer->name }}
                                                {{ $customer->family }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-wrap w-150px">
                                    <label for="active">Vip </label>
                                    <select class="form-control" name="active" id="active">
                                        <option value=""> انتخاب کنید </option>
                                        <option {{ request("active")==1?"selected":"1" }} value="1"> فعال </option>
                                        <option {{ request("active")==0?"selected":"0" }} value="0"> غیر فعال </option>
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
                                    <a href="{{ route("withdrawal.index") }}" class="btn btn-danger"><i class="fas fa-window-close"></i></a>
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
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col nk-tb-col-check">
                                id
                            </div>
                            <div class="nk-tb-col">
                                <span class="sub-text">نام</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="sub-text">مقدار</span>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <span class="sub-text">وضعیت</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="sub-text">تاریخ</span>
                            </div>

                            <div class="nk-tb-col tb-col-xxl">
                                <span class="sub-text">توضیحات</span>
                            </div>
                            <div class="nk-tb-col tb-col-lg">
                                <span class="sub-text">پیوست</span>
                            </div>

                            <div class="nk-tb-col">
                                <span class="sub-text">عملیات</span>
                            </div>

                        </div>
                        @foreach ($withdrawals as $withdrawal )
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
                                <div class="user-card">
                                    <div class="user-name">
                                        <span class="tb-lead">
                                            {{ $withdrawal->user->name }}
                                            {{ $withdrawal->user->family }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-name">
                                        <span class="tb-lead">
                                            {{number_format( $withdrawal->amount) }}
                                            تومان

                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <span class="text text-{{ $withdrawal->status=="before_pay"?"danger":"" }}{{ $withdrawal->status=="admin_confirmed"?"success":"" }}{{ $withdrawal->status==""?"":"" }}">
                                    {{ __("withdrawal.".$withdrawal->status) }}

                                   </span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span>{{ jdate($withdrawal->created_at)->format("Y-m-d") }}
                                </span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                             <span>
                                {{ $withdrawal->info}}
                             </span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                             <span>
                                @if($withdrawal->attach())
                                <a class="no_link" href="{{ route("download",['path'=>$withdrawal->attach()]) }}">
                                    <i class="fas fa-download"></i>
                                </a>
                                @endif
                             </span>
                            </div>




                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-2">

                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="btn no_link btn-sm btn-icon btn-trigger dropdown-toggle" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">

                                                    @if($withdrawal->status!="admin_confirmed")


                                                    <li>
                                                        <a href="{{ route("withdrawal.edit",$withdrawal->id) }}" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="ثبت اطلاعات">
                                                            <i class="fas fa-edit "></i>
                                                            <span class="ml-right">
                                                                ثبت اطلاعات
                                                            </span>
                                                        </a>
                                                    </li>

                                                    @endif
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
                <!-- .card-inner -->
                <div class="card-inner">
                    {{ $withdrawals->appends(Request::all())->links('admin.section.pagination') }}
                </div>
            {{--  <div class="card-inner">
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
            </div>  --}}
            <!-- .card-inner -->
            </form>
        </div>
        <!-- .card-inner-group -->
    </div>
    <!-- .card -->
</div>


@endsection
