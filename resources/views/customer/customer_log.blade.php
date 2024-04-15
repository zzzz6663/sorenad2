@extends('main.manager')
@section('content')

@include("master.error")

<h1>
    آمار
    تبلیغ کننده
</h1>

<div class="card card-stretch">
    <div class="card-inner-group">
        <div class="card-inner position-relative card-tools-toggle">
            <div class="components-preview mx-auto">
                <form action="{{ route("customer.log") }}" autocomplete="off" method="get">
                    @csrf
                    @method('get')
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <ul class="custom-control-group">
                                <li>
                                    <div class="custom-control custom-control-sm custom-radio custom-control-pro checked">
                                        <input {{ request("priod")=="0"?"checked":"" }} value="0" type="radio" class="custom-control-input" name="priod" id="btnRadio1">
                                        <label class="custom-control-label" for="btnRadio1">امروز </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-control-sm custom-radio custom-control-pro">
                                        <input {{ request("priod")=="1"?"checked":"" }} value="1" type="radio" class="custom-control-input" name="priod" id="btnRadio2">
                                        <label class="custom-control-label" for="btnRadio2">دیروز</label>
                                    </div>
                                </li>

                                <li>
                                    <div class="custom-control custom-control-sm custom-radio custom-control-pro">
                                        <input {{ request("priod")=="7"?"checked":"" }} value="7" type="radio" class="custom-control-input" name="priod" id="btnRadio3">
                                        <label class="custom-control-label" for="btnRadio3">7 روز اخیر</label>
                                    </div>
                                </li>


                                <li>
                                    <div class="custom-control custom-control-sm custom-radio custom-control-pro">
                                        <input {{ request("priod")=="30"?"checked":"" }} value="30" type="radio" class="custom-control-input" name="priod" id="btnRadio4">
                                        <label class="custom-control-label" for="btnRadio4">30 روز اخیر</label>
                                    </div>
                                </li>



                            </ul>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div class="form-wrap  ml-2">
                                <label for="advertise_id" class="d-inline-block">تبلیغ من</label>
                                <select name="advertise_id" id="advertise_id" class="form-control w-150px d-inline-block">
                                    <option value="">همه</option>
                                    @foreach ($user->advertises as $ad )
                                    <option {{ request('advertise_id')==$ad->id?"selected":"" }} value="{{ $ad->id }}">
                                        {{ $ad->title }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="d-flex justify-content-start">
                                <div class="form-wrap w-150px ml-2 d-flex">
                                    <label for="from">از</label>
                                    <input type="text" name="from" value="{{ request('from') }}" class="form-control date-picker">
                                </div>
                                <div class="form-wrap w-150px d-flex">
                                    <label for="to">تا </label>
                                    <input type="text" name="to" value="{{ request('to') }}" class="form-control date-picker">
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-2 mb-3">
                            <button class="btn btn-danger">
                                گزراش گیری

                            </button>

                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
    <div class="card-inner-group">
        <div class="card-inner position-relative card-tools-toggle">
            <div class="row">
                <div class="col-lg-2 col-sm-6">
                    <div class="card bg-primary-dim ">
                        <div class="nk-ecwg nk-ecwg6">
                            <div class="card-inner ">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title">
                                            <i class="fas fa-eye"></i>
                                            نمایش
                                        </h6>

                                    </div>
                                </div>
                                <div class="data">
                                    <div class="data-group">
                                        <div class="amount">
                                            {{ $actions->where('count_type',"view")->count() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- .card-inner -->
                        </div>
                        <!-- .nk-ecwg -->
                    </div>
                    <!-- .card -->
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="card bg-success-dim  ">
                        <div class="nk-ecwg nk-ecwg6">
                            <div class="card-inner">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title">
                                            <i class="fas fa-mouse"></i>
                                            کلیک
                                        </h6>

                                    </div>
                                </div>
                                <div class="data">
                                    <div class="data-group">
                                        <div class="amount">
                                            {{ $actions->where('count_type',"click")->count() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- .card-inner -->
                        </div>
                        <!-- .nk-ecwg -->
                    </div>
                    <!-- .card -->
                </div>

                <div class="col-lg-2 col-sm-6">
                    <div class="card bg-danger-dim  ">
                        <div class="nk-ecwg nk-ecwg6">
                            <div class="card-inner">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title">
                                            <i class="fas fa-money-bill-alt"></i>
                                            هزینه
                                        </h6>

                                    </div>
                                </div>
                                <div class="data">
                                    <div class="data-group">
                                        <div class="amount">
                                            {{ number_format(abs($actions->where('main',"1")->sum("adveriser_share")) )}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- .card-inner -->
                        </div>
                        <!-- .nk-ecwg -->
                    </div>
                    <!-- .card -->
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="card-inner-group">
        <div class="card-inner position-relative card-tools-toggle">
            <script src="/js/libs/apexcharts.min.js"></script>

            {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.48.0/apexcharts.min.js" integrity="sha512-wqcdhB5VcHuNzKcjnxN9wI5tB3nNorVX7Zz9NtKBxmofNskRC29uaQDnv71I/zhCDLZsNrg75oG8cJHuBvKWGw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  --}}
            {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.48.0/apexcharts.min.css" integrity="sha512-qc0GepkUB5ugt8LevOF/K2h2lLGIloDBcWX8yawu/5V8FXSxZLn3NVMZskeEyOhlc6RxKiEj6QpSrlAoL1D3TA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  --}}
            <div id="chart"></div>
            <script>
                var app = @json($time);
                var income = @json($income);
                console.log(app)
                var options = {
                    series: [{
                        name: 'series1'
                        , data: income
                    }]
                    , chart: {
                        height: 350
                        , type: 'area'
                    }
                    , dataLabels: {
                        enabled: true
                    }
                    , stroke: {
                        curve: 'smooth'
                    }
                    , xaxis: {

                        categories: app
                    }
                    , tooltip: {
                        x: {
                            format: 'dd/MM/yy HH:mm'
                        }
                    , }
                , };

                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();

            </script>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="card-inner-group">
        <div class="card-inner position-relative card-tools-toggle">
            <h3>
                آمار به تفکیک تبلیغ
            </h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>

                        <th scope="col">نام</th>
                        <th scope="col">درآمد</th>

                        <th scope="col">بازدید</th>
                        <th scope="col">کلیک</th>
                        <th scope="col">Ctr</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($advertises as $ads)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $ads->title }}</td>
                        <td>{{ number_format($ads->actions()->where('main',1)->whereActive(0)->where("count_type","view")->sum('site_share')) }}</td>
                        <td>{{ $ads->actions()->where('main',1)->whereActive(0)->where("count_type","view")->count() }}</td>
                        <td>{{ $ads->actions()->where('main',1)->whereActive(0)->where("count_type","click")->count() }}</td>
                        <td>{{ floor(($ads->actions()->where('main',1)->where("count_type","click")->count()*100)/
                            $ads->display?$ads->display:1
                             ) }}%

                            </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

</div>





@endsection
