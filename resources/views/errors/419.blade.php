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
                        <h1 class="nk-w-head text-warning">419</h1>
                        <h3 class="nk-error-title">به نظر میاد
خیلی از زمان گذشته
                        </h3>
                        <a href="{{ route("customer.log") }}" class="btn btn-lg btn-warning mt-2">بازگشت به صفحه اصلی</a>
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
