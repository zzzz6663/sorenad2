@extends('master.pdf')

@section('content')
<br>
<div class="page-header d-print-none">
    <div class="row g-2 align-items-center">
        <div class="col">
            <h4 class="page-title">
                شماره فاکتور:
                {{$transaction->id}}
            </h4>
            <h5>
                تاریخ صدور:
                {{jdate( )}}
            </h5>
            <br>
            <p>
                <b>
                    صورحساب برای

                </b>
            </p>
            <h4>
                <b>نام و نام خانوادگی:</b>
                <span>
                    {{ $transaction->user->name }}
                    {{ $transaction->user->family }}
                </span>

            </h4>
            <h4>
                <b>کد ملی:</b>
                <span>
                    {{ $transaction->user->mellicode }}
                </span>

            </h4>
        </div>

    </div>


</div>



<div class="card card-lg " style="max-width: 100%">
    <div class="card-body canvas_div_pdf_war">
        <div class="row">
            <div class="col-12 " style=" text-align:center">
                    <table>
                        <thead>
                            <tr  style="background: rgb(144, 189, 240)">
                                <th colspan="3">مشخصات فاکتور</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{ __('arr.'.$transaction->type) }}
                                </td>
                                <td>
                                    {{number_format( $transaction->amount) }}
                                </td>
                                <td>
                                    {{jdate( $transaction->created_at)->format("Y-m-d") }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
            </div>

            <br>
            <div>
                {{--  <img style="width: 100%" src="{{ asset("images/1.jpg") }}" alt="">  --}}

            </div>

            <br>
            <p>
                این فاکتور به سفارش تبلیغ دهنده در پلتفرم سورن اد ایجاد شده است
            </p>
        </div>

    </div>

</div>


@endsection
