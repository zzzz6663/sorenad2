@extends('main.manager')

@section('content')


<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">تیکیت ها</h3>
            <div class="nk-block-des text-soft">
                <p>شما در مجموع

                    {{ $tickets->total() }}
                    تیکت دارید.</p>
            </div>
        </div>
        <!-- .nk-block-head-content -->


        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                        <li>
                            @role('customer')
                            <a href="{{ route("userticket.create") }}" class="btn btn-white btn-outline-light">
                                تیکت جدید
                            </a>
                            @endrole
                            @role('admin')
                            <a href="{{ route("ticket.create") }}" class="btn btn-white btn-outline-light">
                                تیکت جدید
                            </a>
                            @endrole
                        </li>
                    </ul>
                </div>
            </div>
            <!-- .toggle-wrap -->
        </div>
        <!-- .nk-block-head-content -->
    </div>
    <!-- .nk-block-between -->
</div>
<div class="nk-block">
    <div class="card card-stretch">
        <div class="card-inner-group">

            <form action="{{ route('ticket.index') }}" method="get" autocomplete="off">
                @csrf
                @method('get')
                @role('admin')
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
                                        @foreach (__("ticket_status") as $key  =>$val)
                                        <option {{ request("status")==$key?"selected":"1" }} value="{{ $key }}"> {{ $val }} </option>
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
                @endrole

                <div class="card-inner p-0">
                    <div class="nk-tb-list nk-tb-ulist is-compact">
                        <div class="nk-tb-item nk-tb-head">

                            <div class="nk-tb-col">
                                <span class="sub-text">شماره تیکت</span>
                            </div>
                            @role('admin')
                            <div class="nk-tb-col ">
                                <span class="sub-text">ثبت کننده</span>
                            </div>
                            @endrole
                            <div class="nk-tb-col ">
                                <span class="sub-text">موضوع</span>
                            </div>
                            <div class="nk-tb-col ">
                                <span class="sub-text">وضعیت تیکت</span>
                            </div>
                            <div class="nk-tb-col ">
                                <span class="sub-text">تاریخ</span>
                            </div>
                            <div class="nk-tb-col ">
                                <span class="sub-text">اقدام</span>
                            </div>
                        </div>




                        @foreach ($tickets as $ticket )
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                @role('admin')
                                    @if($ticket->status=="wait_for_admin")
                                    <span class="red_cirscle"></span>
                                    @endif
                                    @endrole

                                    @role('customer')

                                    @if($ticket->status=="wait_for_customer")
                                    <span class="red_cirscle"></span>
                                    @endif
                                    @endrole
                                    {{ $ticket->number }}
                            </div>

                            @role('admin')


                            <div class="nk-tb-col">
                                <div class="">
                                    <div class="user-name">
                                        <span class="tb-lead">
                                            {{ $ticket->customer->name}}
                                            {{ $ticket->customer->family}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endrole

                            <div class="nk-tb-col">
                                <div class="">
                                    <div class="user-name">
                                        <span class="tb-lead">
                                            {{ $ticket->title }}

                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <span class="ticket_answered">
                                    {{ __("ticket_status.".$ticket->status) }}
                                </span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span>
                                    {{ jdate($ticket->created_at)->format("Y-m-d") }}
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
                                                        <a class="show_ticket" href="{{ route("userticket.show",$ticket->id) }}">
                                                        {{--  <a href="{{ route("user.edit",$user->id) }}" class="" data-bs-toggle="tooltip" data-bs-placement="top" title="ویرایش کاربر">  --}}
                                                            <i class="fas fa-edit "></i>
                                                            <span class="ml-right">
                                                                مشاهده تیکت
                                                            </span>
                                                        </a>
                                                    </li>
                                                    @role('admin')
                                                    @if($ticket->status!="close")
                                                    <li>
                                                        <form action="{{ route("advertiser.close.ticket",$ticket->id) }}" method="post">
                                                            @csrf
                                                            @method('post')
                                                            <span class="form_close">
                                                                <i class="fas fa-window-close"></i>
                                                                بستن تیکت
                                                            </span>
                                                        </form>
                                                    </li>
                                                    @endif
                                                    @endrole
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
                    {{ $tickets->appends(Request::all())->links('admin.section.pagination') }}
                </div>
            </form>
        </div>
        <!-- .card-inner-group -->
    </div>
    <!-- .card -->
</div>
















@endsection
