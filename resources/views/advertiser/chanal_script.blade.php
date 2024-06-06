@extends('main.manager')
@section('content')

@include("master.error")


<div class="components-preview wide-md mx-auto">
    <br>

    <h2 class="nk-block-title fw-normal">دریافت تبلیغ برای کانال</h2>
    <br>
    <form action="{{ route("advertiser.chanal.script") }}" method="get">
        @csrf
        @method('get')
        <div class="card  position-sticky">
            <div class="card-inner
            position-sticky ">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label for="site_category">زمان</label>
                            <div class="form-control-wrap">
                                <select name="time" id="time" class="form-control submit_form">
                                    <option value="">همه </option>
                                    <option {{ request("time")=="asc"?"selected":"" }} value="asc">جدید ترین </option>
                                    <option {{ request("time")=="desc"?"selected":"" }} value="desc">قدیمی ترین </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label for="site_category">سودآوری</label>
                            <div class="form-control-wrap">
                                <select name="benefit" id="benefit" class="form-control submit_form">
                                    <option value="">همه </option>
                                    <option {{ request("benefit")=="asc"?"selected":"" }} value="asc"> کم سود ترین</option>
                                    <option {{ request("benefit")=="desc"?"selected":"" }} value="desc">پرسود ترین </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label for="site_category">شبکه اجتماعی</label>
                            <div class="form-control-wrap">
                                <select name="socials[]" id="social" multiple class="form-control submit_form select2">
                                    <option value="">همه </option>
                                    <option {{ in_array("telegram",request("socials",[]))?"selected":"" }} value="telegram"> تلگرام </option>
                                    <option {{  in_array("ita",request("socials",[]))?"selected":"" }} value="ita"> ایتا </option>
                                    <option {{  in_array("rubika",request("socials",[]))?"selected":"" }} value="rubika"> روبیکا </option>
                                    <option {{  in_array("instagram",request("socials",[]))?"selected":"" }} value="instagram"> اینستاگرام </option>
                                    <option {{ in_array("bale",request("socials",[]))?"selected":"" }} value="bale"> بله </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label for="site_category">دسته بندی</label>
                            <div class="form-control-wrap">
                                <select name="group_id" id="group_id" class="form-control submit_form">
                                    <option value="">همه </option>
                                    @foreach ( App\Models\Group::whereActive(1)->get() as $group )
                                    <option {{ request("group_id")==$group->id?"selected":"" }} value="{{ $group->id }}"> {{ $group->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </form>

</div>
<br>
<br>
<div class="nk-block">


    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="alert alert-warning" style="overflow: hidden">
                {!! $chanal_setting3->val !!}
            </div>
        </div>
        @foreach ( $advertises as $ads )

        <div class="col-lg-4 mb-4">
            <div class="card">

                <div class="card-inner">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-12  mb-2">
                                <p class=" alert alert-primary  p-1">
                                    <span class="  ">
                                        تعداد کلیک مورد نیاز:
                                        <span class="text text-success">
                                            {{ number_format($ads->click_count) }}
                                        </span>
                                    کلیک
                                    </span>
                                </p>
                            </div>
                            <div class="col-lg-12  mb-3">
                                <p class=" alert alert-success  p-1">
                                    <span class=" ">
                                        مناسب برای:
                                        {{ implode(' - ',$ads->groups()->pluck("name")->toArray()) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="row">

                                <div class="col-lg-6 mb-1">
                                    <div class="alert alert-info   text-center p-1 ">
                                            <div class=" ">
                                                درآمد 100 کلیک
                                            </div>
                                            <div class=" ">
                                                {{ number_format($ads->unit_click * 100) }}
                                                تومان
                                            </div>
                                    </div>
                                </div>

                                <div class="col-lg-6  mb-1">
                                    <div class="alert alert-primary  p-1 text text-center">
                                            <div class=" ">
                                                درآمد 1000 کلیک
                                            </div>
                                            <div class=" ">
                                                {{ number_format($ads->unit_click * 1000) }}
                                                تومان
                                            </div>
                                    </div>
                                </div>


                        </div>
                        <div class="content_ms">

                        <h4>
                            {{ $ads->title }}
                        </h4>
                        @if($ads->check_image())
                        <img src="{{  $ads->attach() }}" alt="">
                        @else
                        <video width="320" height="240" controls>
                            <source src="{{  $ads->attach() }}" type="video/mp4">
                        </video>
                        @endif
                        <div class="txt">
                            <p>
                                {!! $ads->info !!}
                            </p>
                            <h6 class="mb-4">
                                <span>
                                    {{ $ads->landing_title1 }}
                                </span>
                                <br>
                                <br>
                                {{ route("chanal.track",['check'=>$ads->id,'ln'=>1]) }}
                                {{--  {{Illuminate\Support\Facades\URL::signedRoute('redirect.add', ["owner"=>auth()->user()->id,'advertis_id' =>  $ads->id,"link_number"=>1]) }}  --}}
                                {{--  {{Illuminate\Support\Facades\URL::signedRoute('redirect.add', ["owner"=>auth()->user()->id,'advertis_id' =>  $ads->id,"link_number"=>1]) }}  --}}
                            </h6>
                            @if($ads->landing_title2)
                            <h6 class="mb-4">
                                <span>
                                    {{ $ads->landing_title2 }}
                                </span>
                                <br>
                                <br>
                                {{ route("chanal.track",['check'=>$ads->id,'ln'=>2]) }}

                                {{--  {{Illuminate\Support\Facades\URL::signedRoute('redirect.add', ["owner"=>auth()->user()->id,'advertis_id' =>  $ads->id,"link_number"=>2]) }}  --}}
                            </h6>
                            @endif
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-around">
                                    <a class="btn btn-success no_link" href="{{ route("download",['path'=> $ads->download() ]) }}">
                                        دانلود تصویر
                                    </a>
                                    <span class="btn btn-secondary copy_c">
                                        کپی متن
                                    </span>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

</div>




@endsection
