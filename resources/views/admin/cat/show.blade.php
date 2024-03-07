@extends('main.manager')
@section('content')
{{ Breadcrumbs::render('user.show',$user) }}

<div class="col-lg-6">
    <div class="portlet box border shadow">
        <div class="portlet-heading">
            <div class="portlet-title">
                <h3 class="title">
                    <i class="icon-frane"></i>
                    پروفایل کاربر
                    {{$user->name}}
                    {{$user->family}}
                </h3>
            </div><!-- /.portlet-title -->
            <div class="buttons-box">

            </div><!-- /.buttons-box -->
        </div><!-- /.portlet-heading -->
        <div class="portlet-body">
            <div class="portlet-title">

                <div class="text-center">
                    <img src="{{$user->avatar()}}" alt="">

                </div>
                <div class="text-center">
                    <h1>
                        {{$user->name}}
                        {{$user->family}}
                    </h1>
                </div>
                <div class="">
                    <div class="row">
                        <div class="col-lg-3">
                            همراه
                        </div>
                        <div class="col-lg-9">
                            <span class="text-center">
                                {{$user->mobile}}
                            </span>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            ایمیل
                        </div>
                        <div class="col-lg-9">
                            <span class="text-center">
                                {{$user->email}}
                            </span>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            مکان
                        </div>
                        <div class="col-lg-9">
                            <span class="text-center">
                                {{$user->province?$user->province->name:''}}
                                {{$user->city?$user->city->name:''}}
                            </span>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            جنسیت
                        </div>
                        <div class="col-lg-9">
                            <span class="text-center">
                                {{$user->gender()}}
                            </span>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            کدملی
                        </div>
                        <div class="col-lg-9">
                            <span class="text-center">
                                {{$user->code}}
                            </span>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            ادرس
                        </div>
                        <div class="col-lg-9">
                            <span class="text-center">
                                {{$user->address}}
                            </span>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            تاریخ تولد
                        </div>
                        <div class="col-lg-9">
                            <span class="text-center">
                                {{$user->fdate($user->b_date)}}
                            </span>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            تاریخ ثبت
                        </div>
                        <div class="col-lg-9">
                            <span class="text-center">
                                {{$user->fdate($user->created_at)}}
                            </span>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            وضعیت راهنما
                        </div>
                        <div class="col-lg-9">
                            @if ($user->guid )
                            {{$user->active ? "  فعال":' غیر فعال'}}

                            <a class="btn btn-{{$user->active?'danger':'success'}} curve" href="{{route('user.active.guid',$user->id)}}">
                                {{$user->active ? "غیر فعال":'  فعال'}}
                            </a>
                            @endif

                        </div>
                    </div>
                    <br>
                    @if ($user->guid )
                    <div class="row">
                        <div class="col-lg-3">
                            عکس ها
                        </div>
                        <div class="col-lg-9">
                            <a class="btn btn-default curve" target="_blank" href="{{$user->melli_back()}}">
                                پشت کارت
                            </a>
                            <a class="btn btn-warning curve" target="_blank" href="{{$user->melli_front()}}">
                                جلوی کارت
                            </a>
                            <a class="btn btn-info curve" target="_blank" href="{{$user->tourism()}}">
                                گردشگری
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>


        </div><!-- /.portlet-body -->
    </div><!-- /.portlet -->
</div>


<div class="breadcrumb-box border shadow">
    <ul class="breadcrumb">
        <a href="{{route('user.index')}}" class="btn btn-secondary round">بازگشت به میزکار</a>
    </ul>

</div><!-- /.breadcrumb-left -->
</div>
@endsection
