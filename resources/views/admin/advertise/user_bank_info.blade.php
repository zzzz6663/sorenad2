@extends('master.site')
@section('content')


 <div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">
                  اطلاعات حساب بانکی   کاربر
        <span class="alert  alert-success">
             {{ $user->name }}
             {{ $user->family }}
        </span>
        <i class="ti ti-edit"></i>
            </h5>
            <div class="card-body">
                <di class="row">
                    <div class="col-lg-4">
                        <div class="d-flex justify-content-between">
                            <h5 class="title">
                                شبا:
                            </h5>
                            <h5 class="content">{{ $user->shaba }}</h5>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="d-flex justify-content-between">
                            <h5 class="title">
                                کارت:
                            </h5>
                            <h5 class="content">{{ $user->cart }}</h5>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="d-flex justify-content-between">
                            <h5 class="title">
                                بانک:
                            </h5>
                            <h5 class="content">{{ $user->bank }}</h5>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="d-flex justify-content-between">
                            <h5 class="title">
                                کد ملی:
                            </h5>
                            <h5 class="content">{{ $user->a_mellicode }}</h5>
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="d-flex justify-content-between">
                            <h5 class="title">
                                نام صاحب حساب:
                            </h5>
                            <h5 class="content">{{ $user->account }}</h5>
                        </div>
                    </div>


                </di>
            </div>
            <div class="card-body">
                @include('master.error')
                <form action="{{ route("user.bank.info" ,$user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <a href="{{ route("user.index") }}" class="btn btn-warning">
                            برگشت
                            <i class="ti ti-arrow-narrow-left"></i>
                        </a>
                        <button class="btn btn-success">
                            تایید اطلاعات حساب
                            <i class="ti ti-plus"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 </div>
@endsection
