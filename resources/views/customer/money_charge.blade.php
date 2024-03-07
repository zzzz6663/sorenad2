@extends('main.manager')
@section('content')






<div class="components-preview wide-md mx-auto">
    <br>

    <h2 class="nk-block-title fw-normal">شارژ حساب کاربری
    </h2>
    <br>
    <div class="card">
        <div class="card-inner">
            <div class="row">

                <div class="col-sm-6 col-xxl-3">
                    <div class="card card-full bg-success is-dark">
                        <div class="card-inner">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <div class="fs-6 text-white text-opacity-75 mb-0">
                                    <h4>
                                        موجودی
                                    </h4>
                                </div>
                                {{--  <a href="html/copywriter/templates.html" class="link link-white">همه ابزارها</a>  --}}
                            </div>
                            {{--  <h5 class="fs-1 text-white">12 <small class="fs-3">ابزار</small></h5>  --}}

                            <div class="fs-7 text-white text-opacity-75 mt-1">
                                {{number_format( $user->balance()) }}
                                تومان
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <br>
            <br>
            <h5>
                مبلغ افزایش موجودی
            </h5>


                @include("master.error")
                <form action="{{ route("send.pay") }}" method="post" autocomplete="off">
                    @csrf
                    @method('post')
                    <input type="text" name="type" value="charge" hidden>
            <div class="row">

                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label" for="site">مبلغ</label>
                        <div class="form-control-wrap">
                            <input type="number" id="amount" name="amount" class="form-control number_format" placeholder="تومان" value="{{ old("amount") }}">

                            <p id="amount_total" class="persian_number">
                            </p>

                        </div>
                    </div>

                       <div class="mony_bid  mt-5">
                    <span>مبالغ پیشنهادی</span> <i data-price="5000000" class="per_price alert alert-primary">5 میلیون تومان</i> <i data-price="10000000" class="per_price alert alert-secondary">10 میلیون تومان</i> <i data-price="15000000" class="per_price alert alert-dark">15 میلیون تومان</i>
                </div>
                </div>


                <div class="col-md-12 mt-5">
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary">درخواست برداشت</button>

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
                    <th scope="col">شماره  </th>
                    <th scope="col">مبلغ  </th>
                    <th scope="col">تاریخ</th>
                    <th scope="col">نوع</th>
                    <th scope="col">وضعیت</th>
                    <th scope="col">پرینت</th>




                </tr>
            </thead>
            <tbody>


                @foreach ($transactions as  $transaction)

                <tr>
                    <th scope="row">{{$loop->iteration }}</th>
                    <td>{{$transaction->transactionId}}</td>
                    <td>

                        <span class="text text-{{( $transaction->amount>0?"success":"danger") }} ">
                            {{number_format( $transaction->amount) }}
                                           <span class="price_format">تومان</span>
                        </span>
                    </td>
                    <td>
                        {{ jdate($transaction->created_at) }}
                    </td>
                    <td>
                        {{ __("arr.".$transaction->type) }}
                    </td>
                    <td>
                        {{ __("t_status.".$transaction->status) }}
                    </td>
                    <td>
                        <a href="{{ route("customer.transaction.factor",['action'=>$transaction->transactionId]) }}" class="no_link">
                            <i class="fas fa-file-pdf"></i>
                            </a>
                    </td>

                </tr>

                {{--  <li>{{ $transaction->transactionId }}</li>
                <li>
                    <span class="text text-{{( $transaction->amount>0?"success":"danger") }} ">
     {{number_format( $transaction->amount) }}
                    <span class="price_format">تومان</span>
                </span>

                </li>
                <li>{{jdate( $transaction->created_at) }} </li>

                <li>
                    {{ __("arr.".$transaction->type) }}
                </li>
                <li> {{ __("t_status.".$transaction->status) }}</li>
                <li><a href="{{ route("customer.transaction.factor",['action'=>$transaction->transactionId]) }}" class="no_link">
                    <i class="fas fa-file-pdf"></i>
                    </a>
                </li>
                @endforeach  --}}

                @endforeach


            </tbody>
        </table>
      </div>

</div>




{{--
<div class="d-flex justify-content-between">
    <h2 class="title_right">
        شارژ حساب کاربری

    </h2>
    <h2 class="title_right">
موجودی
        {{number_format( $user->balance()) }}
        تومان
    </h2>

</div>
@include("master.error")
<form action="{{ route("send.pay") }}" method="post" autocomplete="off">
    @csrf
    @method('post')
    <input type="text" name="type" value="charge" hidden>
    <div class="moneybox_req box_shdow">
        <p>مبلغ افزایش موجودی</p>


        <div class="dashboard_site_form">
            <form class="money_req_form">
                <input type="number" id="amount" name="amount" class="form-control number_format" placeholder="تومان">
                <div class="mony_bid">
                    <span>مبالغ پیشنهادی</span> <i data-price="5000000" class="per_price">5 میلیون تومان</i> <i data-price="10000000" class="per_price">10 میلیون تومان</i> <i data-price="15000000" class="per_price">15 میلیون تومان</i>
                </div>
                <div class="mony_pay_info flex">
                    <p>مبلغ قابل پرداخت</p>
                    <div class="flex mony_pay_num">
                        <strong id="amount_total"> </strong>

                        <p class="persian_number"> </p>
                    </div>
                </div>
                <span id="send_pay" class="btn btn-success"><svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.94358 3.25H14.0564C15.8942 3.24998 17.3498 3.24997 18.489 3.40314C19.6614 3.56076 20.6104 3.89288 21.3588 4.64124C22.1071 5.38961 22.4392 6.33856 22.5969 7.51098C22.6873 8.18385 22.7244 8.9671 22.7395 9.87428C22.7464 9.91516 22.75 9.95716 22.75 10C22.75 10.0353 22.7476 10.0699 22.7429 10.1039C22.75 10.6696 22.75 11.2818 22.75 11.9436V12.0564C22.75 13.8942 22.75 15.3498 22.5969 16.489C22.4392 17.6614 22.1071 18.6104 21.3588 19.3588C20.6104 20.1071 19.6614 20.4392 18.489 20.5969C17.3498 20.75 15.8942 20.75 14.0564 20.75H9.94359C8.10583 20.75 6.65019 20.75 5.51098 20.5969C4.33856 20.4392 3.38961 20.1071 2.64124 19.3588C1.89288 18.6104 1.56076 17.6614 1.40314 16.489C1.24997 15.3498 1.24998 13.8942 1.25 12.0564V11.9436C1.24999 11.2818 1.24999 10.6696 1.25714 10.1039C1.25243 10.0699 1.25 10.0352 1.25 10C1.25 9.95716 1.25359 9.91517 1.26049 9.87429C1.27564 8.96711 1.31267 8.18385 1.40314 7.51098C1.56076 6.33856 1.89288 5.38961 2.64124 4.64124C3.38961 3.89288 4.33856 3.56076 5.51098 3.40314C6.65019 3.24997 8.10582 3.24998 9.94358 3.25ZM2.75199 10.75C2.75009 11.1384 2.75 11.5541 2.75 12C2.75 13.9068 2.75159 15.2615 2.88976 16.2892C3.02502 17.2952 3.27869 17.8749 3.7019 18.2981C4.12511 18.7213 4.70476 18.975 5.71085 19.1102C6.73851 19.2484 8.09318 19.25 10 19.25H14C15.9068 19.25 17.2615 19.2484 18.2892 19.1102C19.2952 18.975 19.8749 18.7213 20.2981 18.2981C20.7213 17.8749 20.975 17.2952 21.1102 16.2892C21.2484 15.2615 21.25 13.9068 21.25 12C21.25 11.5541 21.2499 11.1384 21.248 10.75H2.75199ZM21.2239 9.25H2.77607C2.79564 8.66327 2.82987 8.15634 2.88976 7.71085C3.02502 6.70476 3.27869 6.12511 3.7019 5.7019C4.12511 5.27869 4.70476 5.02502 5.71085 4.88976C6.73851 4.75159 8.09318 4.75 10 4.75H14C15.9068 4.75 17.2615 4.75159 18.2892 4.88976C19.2952 5.02502 19.8749 5.27869 20.2981 5.7019C20.7213 6.12511 20.975 6.70476 21.1102 7.71085C21.1701 8.15634 21.2044 8.66327 21.2239 9.25ZM5.25 16C5.25 15.5858 5.58579 15.25 6 15.25H10C10.4142 15.25 10.75 15.5858 10.75 16C10.75 16.4142 10.4142 16.75 10 16.75H6C5.58579 16.75 5.25 16.4142 5.25 16ZM11.75 16C11.75 15.5858 12.0858 15.25 12.5 15.25H14C14.4142 15.25 14.75 15.5858 14.75 16C14.75 16.4142 14.4142 16.75 14 16.75H12.5C12.0858 16.75 11.75 16.4142 11.75 16Z" fill="#ffffff"></path>
                    </svg> <span>پرداخت</span></span>
            </form>

            <div class="clear"></div>
        </div>

        <div class="clear"></div>
    </div>
</form>
<h2 class="title_right">لیست تراکنش  ها</h2>
<div class="flex dashbord_table">
    <div class="dashbord_table_title">
        <ul class="flex">
            <li>id</li>
            <li>شماره </li>
            <li>مبلغ </li>
            <li>تاریخ </li>
            <li>نوع </li>
            <li>وضعیت </li>
            <li>صدور فاکتور</li>
        </ul>
    </div>
    @foreach ($transactions  as $transaction )

    <div class="dashbord_table_row">
        <ul class="flex">
            <li>{{ $loop->iteration }}</li>
            <li>{{ $transaction->transactionId }}</li>
            <li>
                <span class="text text-{{( $transaction->amount>0?"success":"danger") }} ">
 {{number_format( $transaction->amount) }}
                <span class="price_format">تومان</span>
            </span>

            </li>
            <li>{{jdate( $transaction->created_at) }} </li>

            <li>
                {{ __("arr.".$transaction->type) }}
            </li>
            <li> {{ __("t_status.".$transaction->status) }}</li>
            <li><a href="{{ route("customer.transaction.factor",['action'=>$transaction->transactionId]) }}" class="no_link">
                <i class="fas fa-file-pdf"></i>
                </a>
            </li>
        </ul>
    </div>
    @endforeach




</div>  --}}

@endsection
