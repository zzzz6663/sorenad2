@extends('main.manager')

@section('content')
<div class="row">
    <div class="col-xxl-12">
        <div class="card card-full">
            <div class="card-inner">
                <div class="card-title-group">
                    <div class="card-title">
                        <h6 class="title">پرداخت آگهی


                        {{ $advertise->title }}

                        </h6>

                    </div>
                </div>
                <br>
                @include('main.error')
                  <form action="{{ route("send.pay",$advertise->id) }}">
                    @include('advertiser.price_temp')
                    <input type="text" name="agin" value="1" hidden>
                    <button class="btn btn-success">
                        پرداخت
                    </button>
                  </form>

            </div>

        </div>
        <!-- .card -->
    </div>
</div>


@endsection
