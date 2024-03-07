@extends('master.site')
@section('content')
<div class="row">

    <div class="col-lg-12">
        <div class="cart">
            <div class="portlet-heading">
                <div class="portlet-title">
                    <h3 class="title">
                        <i class="icon-frane"></i>
                        {{$advertise->title}}
                    </h3>
                </div><!-- /.portlet-title -->
                <div class="buttons-box">

                </div><!-- /.buttons-box -->
            </div><!-- /.portlet-heading -->
            <div class="portlet-body">
                <div class="portlet-title">

                    <div class="text-center">
                        <img src="{{$advertise->banner1()}}" alt="">
                    </div>

                    <div class="">
                        <div class="row">

                            <div class="col-lg-4 mb-3">
                                <span>
                                لینک:
                                </span>
                                <span class="text-center">
                                    <a href="{{ $advertise->login_link_page }}">مشاهده</a>
                                </span>
                            </div>


                            <div class="col-lg-4 mb-3">
                                <span>
                                    نوع:
                                </span>
                                <span class="text-center">
                                    {{__("advertise_type.".$advertise->type)}}
                                </span>
                            </div>

                            <div class="col-lg-4 mb-3">
                                <span>
                                    نوع شمارش آگهی:
                                </span>
                                <span class="text-center">
                                    {{__("arr.".$advertise->count_type)}}
                                </span>
                            </div>


                            <div class="col-lg-4 mb-3">
                                <span>
                                    محدودیت نمایش روزانه:
                                </span>
                                <span class="text-center">
                                    {{$advertise->limit_daily_view}}
                                </span>
                            </div>

                            <div class="col-lg-4 mb-3">
                                <span>
                                    محدودیت کلیک روزانه:
                                </span>
                                <span class="text-center">
                                    {{$advertise->limit_daily_click}}
                                </span>

                            </div>


                            <div class="col-lg-4 mb-3">
                                <span>
                                    ابزار نمایش:
                                </span>
                                <span class="text-center">
                                    {{__("arr.".$advertise->device)}}

                                </span>

                            </div>


                            <div class="col-lg-4 mb-3">
                                <span>
                                    کلیک درخواستی:
                                </span>
                                <span class="text-center">
                                    {{$advertise->click_count}}
                                </span>
                            </div>


                            <div class="col-lg-4 mb-3">
                                <span>
                                    نمایش درخواستی:
                                </span>
                                <span class="text-center">
                                    {{$advertise->view_count}}
                                </span>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <span>
                                    قیمت:
                                </span>
                                <span class="text-center">
                                    {{number_format($advertise->price)}}
                                    تومان
                                </span>
                            </div>

                            <div class="col-lg-4 mb-3">
                                <span>
                                    وضعیت پرداخت:
                                </span>
                                <span class="text-center">
                                    <span class="text text-{{$advertise->payed?"success":"danger"}}">
                                        {{$advertise->payed?"پرداخت شده":"پرداخت نشده"}}
                                    </span>
                                </span>
                            </div>
                            <div class="col-lg-12">
                                <a href="{{ route("advertise.index") }}" class="btn btn-danger">برگشت</a>
                            </div>
                        </div>



                    </div>
                </div>


            </div><!-- /.portlet-body -->
        </div><!-- /.portlet -->
    </div>

</div>

@endsection
