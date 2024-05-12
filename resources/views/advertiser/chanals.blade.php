@extends('main.manager')
@section('content')

@include("master.error")
<form action="{{ route("advertiser.chanals") }}" method="post">
    @csrf
    @method('post')

    <div class="components-preview wide-md mx-auto">
        <br>

        <h2 class="nk-block-title fw-normal">ثبت اطلاعات کانال</h2>
        <br>
        <div class="card">
            <div class="card-inner">
                <div class="row">
                    <div class="col mb-3-md-6">
                        <div class="form-group">
                            <label class="form-label" for="name">نام کانال</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" name="name" value="{{ old("name") }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label" for="url">آدرس کانال</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="url" name="url" value="{{ old("url") }}">
                                <span>
                                    حتما با
                                    <span class="text text-danger">
                                        http:
                                    </span>
                                    شروع شود . مثل
                                    <span class="text text-danger">
                                        https://web.eitaa.com/@sorenad
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="site_category">انتخاب دسته بندی</label>
                            <div class="form-control-wrap">
                                <select name="group_id" id="group_id" class="form-control">
                                    <option value="">یک مورد را انتخاب کنید </option>
                                    @foreach ( App\Models\Group::whereActive(1)->get() as $group )
                                    <option {{ old("group_id")==$group->id?"selected":"" }} value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3-md-6">
                        <div class="form-group">
                            <label class="form-label" for="members">
                                تعداد اعضا به K
                            </label>
                            <div class="form-control-wrap">
                                <input type="number" class="form-control" id="members" name="members" value="{{ old("members") }}">
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
                            <th> آدرس </th>
                            <th> اعضا </th>
                            <th>تاریخ ایجاد</th>
                            <th>عملیات </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chanals as $chanal )
                        <tr>
                            <td>{{ $chanal->name }}</td>
                            <td>{{ $chanal->url }}</td>
                            <td>{{ $chanal->members }} K</td>

                            <td>
                                {{ jdate($chanal->created_at) }}

                            <td>
                                {{--  @if($chanal->status=="rejected")
                                <a href="{{ route("advertiser.update.site",$chanal->id) }}" class="btn btn-success">
                                    ویرایش مجدد
                                </a>
                                @endif  --}}
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
        @foreach ($chanals as $chanal )

        <div class="dashbord_table_row">
            <ul class="flex">
                <li>{{ $chanal->name }}</li>
<li>{{ $chanal->site }}</li>
<li>
    {{ __("site_status.$chanal->status")}}
</li>
<li>
    @if($chanal->status=="rejected")
    {{ $chanal->reason }}
    @endif
</li>
<li>
    {{ $chanal->income() }}
    <span class="price_format">تومان</span>
</li>
<li>
    {{ jdate($chanal->created_at) }}
</li>


<li>
    @if($chanal->status=="rejected")
    <a href="{{ route("advertiser.update.site",$chanal->id) }}" class="btn btn-success">
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
