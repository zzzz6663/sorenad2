@extends('main.manager')

@section('content')
<h2 class="title_right">سفارش تبلیغ
    نصب اپلیکیشن
</h2>

@include("master.error")
<div class="card">
    <div class="card-inner">
        <form action="{{ route("advertiser.new.ad.hamsan") }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            @include('advertiser.ad_temp.hamsan')
            @include('advertiser.price_temp')
        </form>
    </div>
</div>

@endsection
