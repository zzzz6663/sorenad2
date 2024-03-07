@extends('main.manager')


@section('content')

<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">لیست تراکنش</h3>
            <div class="nk-block-des text-soft">
                <p>شما در مجموع

                    {{ $transactions->total() }}
                    تراکنش دارید.</p>
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

            <form action="{{ route('user.index') }}" method="get" autocomplete="off">
                @csrf
                @method('get')
                <div class="card-inner position-relative card-tools-toggle">
                    <div class="card-title-group">
                        <div class="card-tools">
                            <div class="form-inline  gx-3">
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
                                    <select class="form-control select2" name="user_id" id="user_id">
                                        <option value=""> انتخاب کنید </option>
                                        @foreach ($customers as $customer )
                                        <option {{ request("user_id")?"selected":"0" }} value="{{ $customer->id }}">
                                            {{ $customer->name }}
                                            {{ $customer->family }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-wrap w-150px">
                                    <label for="status">وضعیت </label>
                                    <select class="form-control" name="status" id="status">
                                        <option value=""> انتخاب کنید </option>
                                        @foreach (__("t_status") as $key=>$val )
                                        <option {{ request("status" )==$key ?"selected":"1" }} value="{{ $key }}"> {{ __("t_status.".$key) }} </option>
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
                                    <a href="{{ route("user.index") }}" class="btn btn-danger"><i class="fas fa-window-close"></i></a>
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

                            <div class="nk-tb-col ">
                                <span class="sub-text">مقدار</span>
                            </div>

                            <div class="nk-tb-col ">
                                <span class="sub-text">وضعیت</span>
                            </div>
                            <div class="nk-tb-col ">
                                <span class="sub-text">نوع</span>
                            </div>
                            <div class="nk-tb-col ">
                                <span class="sub-text">تاریخ</span>
                            </div>

                            <div class="nk-tb-col">
                                <span class="sub-text">عملیات</span>
                            </div>

                        </div>
                        @foreach ($transactions as $transaction )
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
                                <div class="">
                                    <div class="user-name">
                                        <span class="tb-lead">
                                            {{ $transaction->user->name }}
                                            {{ $transaction->user->family }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col">
                                <div class="">
                                    <div class="user-name">
                                        <span class="text text-{{( $transaction->amount>0?"success":"danger") }} ">
                                            {{number_format( $transaction->amount) }}
                                            <span class="price_format">تومان</span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col ">
                                <span class="alert alert-{{ $transaction->status=="before_pay"?"danger":"" }}{{ $transaction->status=="payed"?"success":"" }}{{ $transaction->status==""?"":"" }}">
                                    {{ __("t_status.".$transaction->status) }}
                                </span>
                            </div>
                            <div class="nk-tb-col ">
                                <span>
                                    {{ __("arr.".$transaction->type) }}
                                </span>
                            </div>



                            <div class="nk-tb-col ">
                                <span>
                                    {{ jdate($transaction->created_at)->format("Y-m-d") }}
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
                                                        <a href="{{ route("user.edit",$transaction->id) }}" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="ویرایش کاربر">
                                                            <i class="fas fa-edit "></i>
                                                            <span class="ml-right">
                                                                ویرایش کاربر
                                                            </span>
                                                        </a>
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
                <!-- .card-inner -->
                <div class="card-inner">
                    {{ $transactions->appends(Request::all())->links('admin.section.pagination') }}
                </div>

                <!-- .card-inner -->
            </form>
        </div>
        <!-- .card-inner-group -->
    </div>
    <!-- .card -->
</div>









@endsection
