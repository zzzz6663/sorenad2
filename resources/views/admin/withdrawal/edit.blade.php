@extends('main.manager')
@section('content')


<div class="card">
    <div class="card-innexr">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">
                          ثبت اطلاعات واریز
                <span class="text  text-success">
                     {{ $withdrawal->user->name }}
                     {{ $withdrawal->user->family }}
                </span>
                <i class="ti ti-edit"></i>
                    </h5>
                    <div class="card-body">
                        @include('master.error')
                        <form action="{{ route("withdrawal.update" ,$withdrawal->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <h5>
                                این درخواست در تاریخ
                                   <span class="text text-bg-primary"> {{ jdate($withdrawal->created_at) }}</span>
                                به مبلغ
                                <span class="text text-bg-success">
                                    {{ number_format($withdrawal->amount) }}
                                </span>
                                تومان

                                ثبت شده است
                            </h5>
                            <h6 class="text text-danger">
                                بعداز ذخیره این عملیات قابل ویرایش نیست
                            </h6>

                            <p>
                                نام صاحب حساب:
                            {{ $withdrawal->user->account }}

                            </p>
                            <p>
                                شماره شبا:
                            {{ $withdrawal->user->shaba }}

                            </p>
                            <p>
                                شماره کارت:
                            {{ $withdrawal->user->cart }}

                            </p>
                            <p>
                                 کدملی:
                            {{ $withdrawal->user->a_mellicode }}

                            </p>

                         <div class="row">
                            <div class="co-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="password">
                                        توضیحات پرداخت
                                    </label>
                                    <textarea name="info" id="" cols="30" class="form-control" rows="5">{{ old("info") }}</textarea>
                                </div>


                            </div>
                            <div class="co-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="password">
                                        فایل پیوست
                                    </label>
                                    <input type="file" class="form-control" accept="image/*" name="attach">
                                </div>
                            </div>
                         </div>



                            <br>
                            <br>
                            <div class="mb-3">
                                <a href="{{ route("withdrawal.index") }}" class="btn btn-warning">
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
@endsection
