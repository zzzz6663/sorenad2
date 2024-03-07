@extends('main.manager')

@section('content')
<div class="row">
    <div class="col-xxl-8">
        <div class="card card-full">
            <div class="card-inner">
                <div class="card-title-group">
                    <div class="card-title">
                        <h6 class="title">لیست تبلیغات</h6>
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

                    <div class="nk-tb-col  ">
                        <span>تعداد سفارش</span>
                    </div>


                    <div class="nk-tb-col  ">
                        <span>محدودیت روزانه</span>
                    </div>

                    <div class="nk-tb-col  ">
                        <span>دستگاه</span>
                    </div>

                    <div class="nk-tb-col  ">
                        <span>لینک</span>
                    </div>



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
                        <span class="tb-sub">{{(__("arr.". $advertise->type)) }} </span>
                    </div>
                    <div class="nk-tb-col">
                        <span class="tb-sub">{{(__("a_status.". $advertise->status)) }} </span>
                    </div>
                    <div class="nk-tb-col">
                        <span class="tb-sub">{{ $advertise->order_count }} </span>
                    </div>
                    <div class="nk-tb-col">
                        <span class="tb-sub">{{ $advertise->limit_daily_view }} </span>
                    </div>
                    <div class="nk-tb-col">
                        <span class="tb-sub">{{(__("arr.". $advertise->device)) }} </span>
                    </div>
                    <div class="nk-tb-col">
                        <a target="__blank" class="tooltipster no_tdnk" title="{{ $advertise->login_tdnk_page }}" href="{{ $advertise->login_tdnk_page }}">مشاهده</a>
                    </div>

                    <div class="nk-tb-col">
                        <span class="tb-sub">
                            {{jdate( $advertise->created_at)->format("Y-m-d") }}
                        </span>
                    </div>

                    <div class="nk-tb-col">
                        @if(!$advertise->payed)
                        <form action="{{ route("advertiser.new.ad.".$advertise->type,$advertise->id) }}" method="post">
                            @csrf
                            @method('post')
                            <input type="text" value="acc_money" name="pay_type" hidden>
                            <input type="submit" class="btn btn-primary" value="پرداخت با کیف">
                        </form>
                        <form action="{{ route("advertiser.new.ad.".$advertise->type,$advertise->id) }}" method="post">
                            @csrf
                            @method('post')
                            <input type="text" value="bank_pay" name="pay_type" hidden>

                            <input type="submit" class="btn btn-primary" value="پرداخت مجدد">
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach

            </div>
        </div>
        <!-- .card -->
    </div>
</div>
{{-- <div class=" dashbord_table">
    <div class="dashbord_table_row table-responsive">
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>تایتل </th>
                    <th>نوع </th>
                    <th>وضعیت </th>
                    <th>تعداد سفارش </th>
                    <th>محدودیت روزانه </th>
                    <th>دستگاه </th>
                    <th>لینک </th>
                    <th>تاریخ </th>
                    <th>اقدام</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($advertises as $advertise)
                <tr >
                    <td>{{ $loop->iteration }}</td>
<td>{{ $advertise->title }}</td>
<td>{{(__("arr.". $advertise->type)) }}</td>
<td>{{(__("a_status.". $advertise->status)) }}</td>
<td>{{ $advertise->order_count }}</td>
<td>{{ $advertise->limit_daily_view }}</td>
<td>{{(__("arr.". $advertise->device)) }}</td>
<td>
    <a target="__blank" class="tooltipster no_tdnk" title="{{ $advertise->login_tdnk_page }}" href="{{ $advertise->login_tdnk_page }}">مشاهده</a>
</td>
<td>
    {{jdate( $advertise->created_at)->format("Y-m-d") }}
</td>
<td>
    @if(!$advertise->payed)
    <form action="{{ route("advertiser.new.ad.".$advertise->type,$advertise->id) }}" method="post">
        @csrf
        @method('post')
        <input type="text" value="acc_money" name="pay_type" hidden>
        <input type="submit" class="btn btn-primary" value="پرداخت با کیف">
    </form>
    <form action="{{ route("advertiser.new.ad.".$advertise->type,$advertise->id) }}" method="post">
        @csrf
        @method('post')
        <input type="text" value="bank_pay" name="pay_type" hidden>

        <input type="submit" class="btn btn-primary" value="پرداخت مجدد">
    </form>
    @endif

</td>
</tr>
@endforeach

</tbody>
</table>

</div>

</div>
</div> --}}
@endsection
