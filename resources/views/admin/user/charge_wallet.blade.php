@extends('main.manager')
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">
                شارژ حساب کاربر (هدیه)

                <span class="text  text-success">
                    {{ $user->name }}
                    {{ $user->family }}

                </span>
                <i class="ti ti-edit"></i>
            </h5>
            <div class="card-body">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <h5 class="card-header">
                            موجودی فعلی
                            <span class="text  text-success">
                                {{ number_format($user->balance() )}}
                                تومان
                            </span>
                            <i class="ti ti-edit"></i>
                        </h5>
                        <div class="card-body">
                            @include('main.error')
                            <form action="{{ route("charge.wallet",$user->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="mb-3">
                                    <label class="form-label" for="amount">مقدار
                                    </label>
                                    <input name="amount" class="form-control number_format" id="amount" type="number" value="weر">
                                    <span class="amount_total"></span>
                                </div>


                                <div class="mb-3">
                                    <a href="http://127.0.0.1:8000/admin/user" class="btn btn-warning">
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

        </div>
    </div>
</div>
@endsection
