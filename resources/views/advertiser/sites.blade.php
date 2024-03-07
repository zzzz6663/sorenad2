@extends('main.manager')
@section('content')

@include("master.error")
<form action="{{ route("advertiser.sites") }}" method="post">
    @csrf
    @method('post')

    <div class="components-preview wide-md mx-auto">
        <br>

        <h2 class="nk-block-title fw-normal">ثبت اطلاعات سایت</h2>
        <br>
        <div class="card">
            <div class="card-inner">
                <div class="row">
                    <div class="col mb-3-md-6">
                        <div class="form-group">
                            <label class="form-label" for="name">نام سایت</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" name="name" value="{{ old("name") }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label" for="site">نام سایت</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="site" name="site" value="{{ old("site") }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="site_category">انتخاب دسته بندی</label>
                            <div class="form-control-wrap">
                                <select name="cat_id" id="" class="form-control">
                                    <option value="">یک مورد را انتخاب کنید </option>
                                    @foreach ( App\Models\Cat::whereActive(1)->get() as $cat )
                                    <option {{ old("cat_id")==$cat->id?"selected":"" }} value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">ذخیره اطلاعات</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="">
                            <th>نام</th>
                            <th> سایت</th>
                            <th> وضعیت </th>
                            <th> توضیحات</th>
                            <th>میزان درامد</th>
                            <th>تاریخ ایجاد</th>
                            <th>عملیات </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sites as $site )
                        <tr>
                            <td>{{ $site->name }}</td>
                            <td>{{ $site->site }}</td>
                            <td>
                                {{ __("site_status.$site->status")}}
                            </td>
                            <td>
                                @if($site->status=="rejected")
                                {{ $site->reason }}
                                @endif
                            </td>
                            <td>
                                {{ $site->income() }}
                                <span class="price_format">تومان</span>
                            </td>
                            <td>
                                {{ jdate($site->created_at) }}

                            <td>
                                @if($site->status=="rejected")
                                <a href="{{ route("advertiser.update.site",$site->id) }}" class="btn btn-success">
                                    ویرایش مجدد
                                </a>
                                @endif
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>


    </div>




</form>




{{-- <div class="dashbord_box_table">
    <h2 class="title_right">سایتهای من</h2>
    <div class="flex dashbord_table">

        <div class="dashbord_table_title">
            <ul class="flex">
                <td>نام</td>
                <li> سایت</li>
                <li> وضعیت </li>
                <li> توضیحات</li>
                <li>میزان درامد</li>
                <li>تاریخ ایجاد</li>
                <li>وضعیت </li>
            </ul>
        </div>
        @foreach ($sites as $site )

        <div class="dashbord_table_row">
            <ul class="flex">
                <li>{{ $site->name }}</li>
<li>{{ $site->site }}</li>
<li>
    {{ __("site_status.$site->status")}}
</li>
<li>
    @if($site->status=="rejected")
    {{ $site->reason }}
    @endif
</li>
<li>
    {{ $site->income() }}
    <span class="price_format">تومان</span>
</li>
<li>
    {{ jdate($site->created_at) }}
</li>


<li>
    @if($site->status=="rejected")
    <a href="{{ route("advertiser.update.site",$site->id) }}" class="btn btn-success">
        ویرایش مجدد
    </a>
    @endif
</li>
</ul>
</div>

@endforeach



</div>

</div> --}}

@endsection
