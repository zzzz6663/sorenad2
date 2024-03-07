@extends('main.manager')

@section('content')

<div class="row g-gs">
    <div class="col-sm-6 col-xxl-3">
        <div class="card card-full bg-primary">
            <div class="card-inner">
                <div class="d-flex align-items-center justify-content-between mb-1">
                    <div class="fs-6 text-white text-opacity-75 mb-0">ثبت نام های امروز</div>
                    <a href="html/copywriter/history.html" class="link link-white">مشاهده تاریخچه</a>
                </div>
                <h5 class="fs-1 text-white">{{ $current_register->count() }} <small class="fs-3">نفر</small></h5>
                <div class="fs-7 text-white text-opacity-75 mt-1">
                    همه افراد:
                    {{ $all_user->count() }}
                    نفر
                </div>
            </div>
        </div>
        <!-- .card -->
    </div>
    <!-- .col -->
    <div class="col-sm-6 col-xxl-3">
        <div class="card card-full bg-warning is-dark">
            <div class="card-inner">
                <div class="d-flex align-items-center justify-content-between mb-1">
                    <div class="fs-6 text-white text-opacity-75 mb-0">تبلیغات در انتظار تائید</div>
                    <a href="html/copywriter/document-drafts.html" class="link link-white">مشاهده همه</a>
                </div>
                <h5 class="fs-1 text-white">{{ $advertise_ready_to_confirm->count() }} <small class="fs-3">عدد</small></h5>
                <div class="fs-7 text-white text-opacity-75 mt-1">
                    همه تبلیغات:
                    {{ $all_ad->count() }}
                    عدد
                </div>
            </div>
        </div>
        <!-- .card -->
    </div>
    <!-- .col -->
    <div class="col-sm-6 col-xxl-3">
        <div class="card card-full bg-info is-dark">
            <div class="card-inner">
                <div class="d-flex align-items-center justify-content-between mb-1">
                    <div class="fs-6 text-white text-opacity-75 mb-0">تبلیغات فعال سرویس</div>
                    <a href="html/copywriter/document-saved.html" class="link link-white">مشاهده همه</a>
                </div>
                <h5 class="fs-1 text-white">{{ $ready_to_show->count() }}  <small class="fs-3">سند</small></h5>
                <div class="fs-7 text-white text-opacity-75 mt-1">
                    همه تبلیغات:
                    {{ $all_ad->count() }}
                    عدد
                </div>
            </div>
        </div>
        <!-- .card -->
    </div>
    <!-- .col -->
    <div class="col-sm-6 col-xxl-3">
        <div class="card card-full bg-danger is-dark">
            <div class="card-inner">
                <div class="d-flex align-items-center justify-content-between mb-1">
                    <div class="fs-6 text-white text-opacity-75 mb-0">درخواست های تسویه حساب</div>
                    <a href="html/copywriter/templates.html" class="link link-white">همه ابزارها</a>
                </div>
                <h5 class="fs-1 text-white">12 <small class="fs-3">ابزار</small></h5>

                <div class="fs-7 text-white text-opacity-75 mt-1">
                    همه تبلیغات:
                    {{ $withdrawal_wait_for_admin_confirm->count() }}
                    عدد
                </div>
            </div>
        </div>
        <!-- .card -->
    </div>
    <!-- .col -->
</div>

@endsection
