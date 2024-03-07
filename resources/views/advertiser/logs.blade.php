@extends('main.manager')

@section('content')

<div class="content-page wide-sm m-auto">
    <div class="nk-block-head nk-block-head-lg wide-xs mx-auto">
        <div class="nk-block-head-content text-center">
            <div class="nk-block-head-sub"><span>گزارشات</span></div>
        </div>
    </div>
    <!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card">
            <div id="faqs" class="accordion">
                <ul id="logs">
                    @foreach ($logs as $log )
                    @include('advertiser.log_temp')
                    @endforeach
                </ul>
            </div>
            <!-- .accordion -->
        </div>
        <!-- .card -->
    </div>
</div>


@php
    $user->logs()->whereNull("seen")->update(['seen'=>Carbon\Carbon::now()]);
@endphp



@endsection
