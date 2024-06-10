@extends('main.manager')
@php
$navbar=true;
$sidebar=true;
@endphp
@section('empty')
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main">
        <!-- wrap @s -->
        <div class="nk-wrap nk-wrap-nosidebar">
            <!-- content @s -->
            <div class="nk-content">
                <div class="nk-block nk-block-middle wide-xs mx-auto">
                    <div class="nk-block-content nk-error-ld text-center">
                        <h1 class="nk-error-head">4044</h1>
                        {{ Request::url() }}
                    {!! Request::url() !!}
                        <h3 class="nk-error-title">اوه! چرا اینجا هستید؟</h3>
                        <p class="nk-error-text">ما برای ناراحتی شما بسیار متاسفیم. به نظر می رسد سعی می کنید به صفحه ای دسترسی پیدا کنید که یا حذف شده یا هرگز وجود نداشته است.</p>
                        <a href="{{ route("customer.log") }}" class="btn btn-lg btn-primary mt-2">بازگشت به صفحه اصلی</a>
                    </div>
                </div>
                <!-- .nk-block -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- content @e -->
    </div>
    <!-- main @e -->
</div>
@endsection
