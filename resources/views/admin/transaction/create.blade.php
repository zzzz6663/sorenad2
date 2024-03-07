@extends('master.admin')
@section('content')


<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <h5 class="card-header">تعریف کاربر جدید
                <i class="ti ti-user-plus"></i>
            </h5>
            <div class="card-body">
                @include('master.error')
                <form action="{{ route("user.store") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <label class="form-label" for="name">نام
                        </label>
                        <input name="name" class="form-control" id="name" placeholder="مثلا ناصر" type="text" value="{{ old("name") }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="family">نام خانوادگی
                        </label>
                        <input name="family" class="form-control" id="family" placeholder="مثلا جعفری" type="text" value="{{ old("family") }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="mobile">همراه</label>
                        <input name="mobile" class="form-control" id="mobile" placeholder="مثلا 09373699317" type="text" value="{{ old("mobile") }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="personal_code">کد پرسنلی</label>
                        <input name="personal_code" class="form-control" id="personal_code" placeholder="مثلا 2323222" type="text" value="{{ old("personal_code") }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="melli_code">کد ملی</label>
                        <input name="melli_code" class="form-control" id="melli_code" placeholder="مثلا 2323222" type="text" value="{{ old("melli_code") }}">
                    </div>


                    {{--  <div class="mb-3">
                        <label class="form-label" for="region_id">منطقه</label>
                        <select class="form-select" id="region_id" name="region_id">
                            <option value="">انتخاب کنید </option>
                            @foreach (App\Models\Region::withoutTrashed()->get() as $region )
                            <option {{ old("region_id")==$region->id?"selected":"" }} value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>  --}}
                    <div class="mb-3">
                        <label class="form-label" for="role">نقش</label>
                        <select class="form-select" id="role" name="role">
                            <option value="">انتخاب کنید </option>
                            <option {{ old("role")=="observer" ?"selected":"" }} value="observer">ناظر</option>
                            <option {{ old("role")=="inspector" ?"selected":"" }} value="inspector">بازرس</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="avatar">تصویر پروفایل </label>
                        <input name="avatar" class="form-control" id="avatar" placeholder="مثلا 2323222" type="file" accept="image/*" >
                    </div>
                    <div class="mb-3">
                        <a href="{{ route("user.index") }}" class="btn btn-warning">
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
@endsection
