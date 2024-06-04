@extends('main.manager')

@section('content')
<h2 class="title_right">سفارش تبلیغ بنر</h2>
<div class="card">
    <div class="card-inner">

        @include("master.error")
        <form action="{{ route("advertiser.new.ad.banner") }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            @include('advertiser.ad_temp.banner')
            @include('advertiser.cat_temp')
            @include('advertiser.device_temp')
            @include('advertiser.price_temp')
        </form>
    </div>
</div>

@endsection
