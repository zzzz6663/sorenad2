@extends('main.manager')
@section('content')

    <div class="components-preview wide-md mx-auto">
        <br>

        <h2 class="nk-block-title fw-normal">درخواست وجه
        </h2>
        <br>
        <div class="card">
            <div class="card-inner">
                <div class="row">
                    <div class="col-sm-6 col-xxl-3">
                        <div class="card card-full bg-danger is-dark">
                            <div class="card-inner">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <div class="fs-6 text-white text-opacity-75 mb-0">
                                        <h4>
                                            درخواست های تسویه حساب
                                        </h4>
                                    </div>
                                    {{--  <a href="html/copywriter/templates.html" class="link link-white">همه ابزارها</a>  --}}
                                </div>
                                {{--  <h5 class="fs-1 text-white">12 <small class="fs-3">ابزار</small></h5>  --}}

                                <div class="fs-7 text-white text-opacity-75 mt-1">
                                    {{ number_format($user->balance() )}}
                                    تومان
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xxl-3">
                        <div class="card card-full bg-success is-dark">
                            <div class="card-inner">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <div class="fs-6 text-white text-opacity-75 mb-0">
                                        <h4>
                                            جمع کل برداشتی
                                        </h4>
                                    </div>
                                    {{--  <a href="html/copywriter/templates.html" class="link link-white">همه ابزارها</a>  --}}
                                </div>
                                {{--  <h5 class="fs-1 text-white">12 <small class="fs-3">ابزار</small></h5>  --}}

                                <div class="fs-7 text-white text-opacity-75 mt-1">
                                    {{ number_format($user->total_withdrawal() )}}
                                    تومان
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <br>
                <br>
                <h5>
                    مبلغی که قصد دارید از حساب تان خارج کنید را وارد کنید.
                </h5>
                <p>این مبلغ باید کمتر از درامد قابل برداشت شما و بیشتر از
                     {{ number_format($min_val_checkout) }}
                    تومان باشد.</p>

                    @include("master.error")
                    <form action="{{ route("advertiser.withdrawal.request") }}" method="post">
                        @csrf
                        @method('post')
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label" for="site">مبلغ</label>
                            <div class="form-control-wrap">

                                <input type="number" id="money" class="number_format form-control" name="amount" value="{{ old("amount") }}" placeholder="تومان">
                                <p id="amount_total" class="persian_number">
                                </p>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">

                            @if( $user->withdrawals()->whereStatus("wait_for_admin_confirm")->count())
                            <p class="text text-danger">
                                در حال حاضر یک درخواست در دست برسی دارید
                            </p>
                            @else
                            @if($user->balance()>$min_val_checkout)
                            <button type="submit" class="btn btn-lg btn-primary">درخواست برداشت</button>
                            @else
                            <p class="text text-danger">
                                شما موجودی کافی برایدرخواست وجه ندارید
                            </p>
                            @endif

                            @endif
                        </div>
                    </div>
                </div>

            </form>
            </div>


        </div>
        <br>
        <br>

        <div class="table-responsive">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">شماره درخواست</th>
                        <th scope="col">وضعیت درخواست</th>
                        <th scope="col">مبلغ</th>
                        <th scope="col">تاریخ درخواست</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($user->withdrawals()->latest()->get() as  $withrawal)
                    <ul class="flex">
                        <li></li>
                        <li>{{__("withdrawal.".$withrawal->status) }}</li>
                        <li>
                            {{ number_format($withrawal->amount )}}
                            <span class="price_format">تومان</span>
                        </li>
                        <li>{{ jdate($withrawal->created_at) }} </li>
                    </ul>

                    <tr>
                        <th scope="row">{{$loop->iteration }}</th>
                        <td>{{__("withdrawal.".$withrawal->status) }}</td>
                        <td>  {{ number_format($withrawal->amount )}}
                            <span class="price_format">تومان</span></td>
                        <td>
                            {{ jdate($withrawal->created_at) }}
                        </td>
                    </tr>
                    @endforeach




                </tbody>
            </table>
          </div>

    </div>








@endsection
