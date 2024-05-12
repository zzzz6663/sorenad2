@extends('master.site')

@section('content')
<h2 class="title_right">
 ویرایش اطلاعات
 سایت
 {{ $site->name }}
</h2>
@include("master.error")
<form action="{{ route("advertiser.update.site",$site->id) }}" method="post">
    @csrf
    @method('post')
    <h2 class="title_right"><i class="fa fa-user-o"></i>اطلاعات کلی</h2>
    <div class="dashboard_site_form">

        <form>
            <p>
                <label for="name">نام سایت</label>
                <input type="text" id="name" name="name" value="{{ old("name",$site->name) }}">
            </p>

            <p>
                <label for="site">آدرس سایت</label>
                <input type="text" id="site" name="site" value="{{ old("site",$site->site) }}">
            </p>


            <p>
                <label for="site_category">انتخاب دسته بندی</label>
                <select name="cat_id" id="" class="form-contol">
                    <option value="">یک مورد را انتخاب کنید </option>
                    @foreach ( App\Models\Cat::whereActive(1)->get() as $cat )
                    <option {{ old("cat_id",$site->cat_id)==$cat->id?"selected":"" }} value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </p>

            <p><button id="submit_form">ثبت سایت</button></p>
        </form>

        <div class="clear"></div>
    </div>
</form>

@endsection
