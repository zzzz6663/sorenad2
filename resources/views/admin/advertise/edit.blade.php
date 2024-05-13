@extends('main.manager')
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">
                ویرایش اطلاعات آگهی
                <span class="text  text-success">
                    {{ $advertise->title }}
                </span>
                مشتری
                <span class="text  text-success">
                    {{ $advertise->user->name }}
                    {{ $advertise->user->family }}
                </span>
                نوع
                <span class="text  text-success">
                    {{ __("advertise_type.".$advertise->type) }}
                </span>
                <i class="ti ti-edit"></i>
            </h5>
            @include('master.error')
            <form action="{{ route("advertise.update" ,$advertise->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="card-body">
                    {{ $advertise->type }}
                    @include("advertiser.ad_temp.".$advertise->type,['advertise'=>$advertise])
                    <br>
                    <div class="form-control-wrap">
                        <div class="form-control-select">
                            <label for=""></label>
                            <select class="form-control" name="confirm" id="confirm">
                                <option value="">انتخاب کنید </option>
                                <option {{ old("confirm",$advertise->confirm)==null?"selected":"" }} value="">غیر فعال</option>
                                <option {{ old("confirm",$advertise->confirm)!=null?"selected":"" }} value="{{ Carbon\Carbon::now() }}"> فعال</option>
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div class="mb-3">
                    <a href="{{ route("user.index") }}" class="btn btn-warning">
                        برگشت
                        <i class="ti ti-arrow-narrow-left"></i>
                    </a>
                    <button class="btn btn-success"> ذخیره
                        <i class="ti ti-plus"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
