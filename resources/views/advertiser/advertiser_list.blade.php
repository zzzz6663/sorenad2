@extends('main.manager')

@section('content')
<div class="row">
    <div class="col-xxl-12">
        <div class="card card-full">
            <div class="card-inner">
                <div class="card-title-group">
                    <div class="card-title">
                        <h6 class="title">لیست تبلیغات</h6>
                        <p class="alert alert-warning">
                            برای ویرایش به مدیریت تیکت ارسال کنید
                            <a class="btn btn-primary" href="{{ route("userticket.create") }}">ارسال تیکت </a>
                        </p>
                    </div>
                </div>
            </div>


            <div class="nk-tb-list mt-n2">
                <div class="nk-tb-item nk-tb-head">
                    <div class="nk-tb-col">
                        <span>شماره سفارش</span>
                    </div>
                    <div class="nk-tb-col  ">
                        <span>تایتل</span>
                    </div>
                    <div class="nk-tb-col  ">
                        <span>نوع</span>
                    </div>

                    <div class="nk-tb-col  ">
                        <span>وضعیت</span>
                    </div>

                    {{-- <div class="nk-tb-col  ">
                        <span>تعداد
                            بازدید
                            درخواستی
                        </span>
                    </div>
                    <div class="nk-tb-col  ">
                        <span>تعداد
                            کلیک درخواستی
                        </span>
                    </div>

                    <div class="nk-tb-col  ">
                        <span>محدودیت روزانه</span>
                    </div>

                    <div class="nk-tb-col  ">
                        <span>دستگاه</span>
                    </div>  --}}

                    {{-- <div class="nk-tb-col  ">
                        <span>لینک</span>
                    </div>  --}}



                    <div class="nk-tb-col  ">
                        <span>تاریخ</span>
                    </div>


                    <div class="nk-tb-col  ">
                        <span>اقدام</span>
                    </div>
                </div>

                @foreach ($advertises as $advertise)
                <div class="nk-tb-item">
                    <div class="nk-tb-col tb-col-md">
                        <span class="tb-sub">{{ $loop->iteration }} </span>
                    </div>
                    <div class="nk-tb-col tb-col-md">
                        <span class="tb-sub">{{ $advertise->title }} </span>
                    </div>
                    <div class="nk-tb-col">
                        <span class="tb-sub">{{(__("advertise_type.". $advertise->type)) }} </span>
                    </div>
                    <div class="nk-tb-col">
                        <span class="tb-sub">{{(__("a_status.". $advertise->status)) }} </span>
                    </div>
                    {{-- <div class="nk-tb-col">
                        <span class="tb-sub">{{ $advertise->view_count }} </span>
                </div>
                <div class="nk-tb-col">
                    <span class="tb-sub">{{ $advertise->click_count }} </span>
                </div>
                <div class="nk-tb-col">
                    <span class="tb-sub">{{ $advertise->limit_daily_view }} </span>
                </div>
                <div class="nk-tb-col">
                    <span class="tb-sub">{{(__("arr.". $advertise->device)) }} </span>
                </div>
                <div class="nk-tb-col">
                    <a target="_blank" class="tooltipster no_link" title="{{ $advertise->login_tdnk_page }}" href="{{ $advertise->login_tdnk_page }}">مشاهده</a>
                </div> --}}

                <div class="nk-tb-col">
                    <span class="tb-sub">
                        {{jdate( $advertise->created_at)->format("Y-m-d") }}
                    </span>
                </div>
                <div class="nk-tb-col">
                    @include('advertiser.detail_show')
                    @role("customer")
                    @if($advertise->status =="created")
                    
                    <a href="{{ route("advertiser.advertise.pay",$advertise->id) }}" class="btn btn-success">پرداخت </a>
                    @endif
                    @endrole
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- .card -->
</div>
</div>

@endsection
