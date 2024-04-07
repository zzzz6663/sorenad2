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

                    {{--  <div class="nk-tb-col  ">
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

                    {{--  <div class="nk-tb-col  ">
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
                        <span class="tb-sub">{{(__("arr.". $advertise->type)) }} </span>
                    </div>
                    <div class="nk-tb-col">
                        <span class="tb-sub">{{(__("a_status.". $advertise->status)) }} </span>
                    </div>
                    {{--  <div class="nk-tb-col">
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
                    </div>  --}}

                    <div class="nk-tb-col">
                        <span class="tb-sub">
                            {{jdate( $advertise->created_at)->format("Y-m-d") }}
                        </span>
                    </div>

                    <div class="nk-tb-col">

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDefault{{ $advertise->id }}">
                            جزئیات
                        </button>
                        <div class="modal fade" tabindex="-1" id="modalDefault{{ $advertise->id }}" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">جزئیات آگهی
                                            <span class="text text-primary">
                                                {{  $advertise->title }}
                                            </span>

                                        </h5>
                                        <a href="#" class="close no_link" data-bs-dismiss="modal" aria-label="بستن">
                                            <em class="icon ni ni-cross"></em>
                                        </a>
                                    </div>
                                    <div class="modal-body text-align-right">
                                        <div class="row">
                                            <div class="col-lg-3 text-align-right mb-2">
                                                <span class="title fw-bold modal-title">
                                                    عنوان:
                                                </span>
                                                <span class="content">
                                                    {{  $advertise->title }}
                                                </span>
                                            </div>
                                            @if( $advertise->device)
                                            <div class="col-lg-3 text-align-right mb-2">
                                                <span class="title fw-bold modal-title">
                                                    دیوایس:
                                                </span>
                                                <span class="content">
                                                    {{  $advertise->device }}
                                                </span>
                                            </div>
                                            @endif
                                            @if( $advertise->banner1)
                                            <div class="col-lg-3 text-align-right mb-2">
                                                <span class="title fw-bold modal-title">
                                                    بنر اول:
                                                </span>
                                                <span class="content">
                                                    <a target="_blank"  class="no_link" href="{{ $advertise->banner1() }}"></a>
                                                </span>
                                            </div>
                                            @endif
                                            @if( $advertise->banner2)
                                            <div class="col-lg-3 text-align-right mb-2">
                                                <span class="title fw-bold modal-title">
                                                    بنر دوم:
                                                </span>
                                                <span class="content">
                                                    <a target="_blank"  class="no_link" href="{{ $advertise->banner2() }}"></a>
                                                </span>
                                            </div>
                                            @endif

                                            @if( $advertise->banner3)
                                            <div class="col-lg-3 text-align-right mb-2">
                                                <span class="title fw-bold modal-title">
                                                    بنر سوم:
                                                </span>
                                                <span class="content">
                                                    <a target="_blank"  class="no_link" href="{{ $advertise->banner3() }}"></a>
                                                </span>
                                            </div>
                                            @endif

                                            @if( $advertise->icon)
                                            <div class="col-lg-3 text-align-right mb-2">
                                                <span class="title fw-bold modal-title">
                                                    آیکون:
                                                </span>
                                                <span class="content">
                                                    <a target="_blank"  class="no_link" href="{{ $advertise->icon() }}"></a>
                                                </span>
                                            </div>
                                            @endif

                                            <div class="col-lg-3 text-align-right mb-2">
                                                <span class="title fw-bold modal-title">
                                                    نوع آگهی:
                                                </span>
                                                <span class="content">
                                                    {{  __("advertise_type.".$advertise->type) }}
                                                </span>
                                            </div>



                                            <div class="col-lg-3 text-align-right mb-2">
                                                <span class="title fw-bold modal-title">
                                                    مدل قیمت گذاری:
                                                </span>
                                                <span class="content">
                                                    {{  __("arr.".$advertise->count_type) }}
                                                </span>
                                            </div>

                                            @if($advertise->count_type=="click")
                                            <div class="col-lg-3 text-align-right mb-2">
                                                <span class="title fw-bold modal-title">
                                                    تعداد کلیک درخواستی:
                                                </span>
                                                <span class="content">
                                                    {{ $advertise->click_count}}
                                                </span>
                                            </div>
                                            <div class="col-lg-3 text-align-right mb-2">
                                                <span class="title fw-bold modal-title">
                                                    محدودیت تعداد کلیک:
                                                </span>
                                                <span class="content">
                                                    {{ $advertise->limit_daily_click}}
                                                </span>
                                            </div>
                                            @endif
                                            @if($advertise->count_type=="view")
                                            <div class="col-lg-3 text-align-right mb-2">
                                                <span class="title fw-bold modal-title">
                                                    تعداد نمایش:
                                                </span>
                                                <span class="content">
                                                    {{ $advertise->view_count}}
                                                </span>
                                            </div>
                                            <div class="col-lg-3 text-align-right mb-2">
                                                <span class="title fw-bold modal-title">
                                                    محدودیت تعداد نمایش:
                                                </span>
                                                <span class="content">
                                                    {{ $advertise->limit_daily_view}}
                                                </span>
                                            </div>
                                            @endif




                                            <div class="col-lg-12 text-align-right mb-2">
                                                <span class="title fw-bold modal-title">
                                                    لینک های فرود:
                                                </span>
                                                <span class="content">
                                                    @if($advertise->landing_link1)
                                                    <a class="no_link" target="_blank" href="{{ $advertise->landing_link1 }}">{{ $advertise->landing_title1 }}</a>
                                                    @endif
                                                    @if($advertise->landing_link2)
                                                    <a class="no_link" target="_blank" href="{{ $advertise->landing_link2 }}">{{ $advertise->landing_title2 }}</a>
                                                    @endif
                                                    @if($advertise->landing_link3)
                                                    <a class="no_link" target="_blank" href="{{ $advertise->landing_link3 }}">{{ $advertise->landing_title3 }}</a>
                                                    @endif
                                                    @if($advertise->video1)
                                                    <a class="no_link" target="_blank" href="{{ $advertise->video1() }}">ویدئو</a>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="col-lg-12 text-align-right mb-2">
                                                <span class="title fw-bold modal-title">
                                                    توضیحات آگهی:
                                                </span>
                                                <span class="content">
                                                  {{ $advertise->info }}
                                                </span>
                                            </div>
                                            <div class="col-lg-12 text-align-right mb-2">
                                                <span class="title fw-bold modal-title">
                                                    متن تبلیغ:
                                                </span>
                                                <span class="content">
                                                  {{ $advertise->text }}
                                                </span>
                                            </div>
                                            <div class="col-lg-3 text-align-right mb-2">
                                                <span class="title fw-bold modal-title">
                                                    تعداد کلیک:
                                                </span>
                                                <span class="content">
                                                  {{ $advertise->actions()->where("count_type","click")->count() }}
                                                </span>
                                            </div>
                                            <div class="col-lg-3 text-align-right mb-2">
                                                <span class="title fw-bold modal-title">
                                                    تعداد نمایش:
                                                    {{ $advertise->status }}
                                                </span>
                                                <span class="content">
                                                  {{ $advertise->actions()->where("count_type","view")->count() }}
                                                </span>
                                            </div>

                                            <div class="col-lg-12 text-align-right mb-2 mt-2">
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
                                                @else
                                                <div class="custom-control custom-control-lg custom-switch">
                                                    <input type="checkbox" {{ $advertise->active?"checked":" " }} class="custom-control-input add_active" data-id="{{ $advertise->id }}" id="add_active{{ $advertise->id }}" value="1">
                                                    <label class="custom-control-label " for="add_active{{ $advertise->id }}">
                                                        {{ $advertise->active?"فعال":"غیر فعال" }}
                                                    </label>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light">
                                        @if($advertise->status=="ready_to_show")

                                        <span class="sub-text">
                                            <p>
                                                درصورت تمایل میتوانید باقیمانده اعتبار به کیف پول برگردانید
                                            </p>
                                            <form action="{{ route("advertise.reject" ,$advertise->id) }}" method="post">
                                                @csrf
                                                @method('post')
                                                <span class="btn btn-danger confirm_reject">
                                                    بازگشت باقیمانده به کیف
                                                </span>
                                            </form>
                                        </span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>


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
    <a target="_blank" class="tooltipster no_tdnk" title="{{ $advertise->login_tdnk_page }}" href="{{ $advertise->login_tdnk_page }}">مشاهده</a>
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
