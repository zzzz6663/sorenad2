@extends('main.manager')

@section('content')


 <div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <h5 class="card-header">
                  ویرایش اطلاعات کاربر
        <span class="text  text-success">
             {{ $user->name }}
             {{ $user->family }}

        </span>
        <i class="ti ti-edit"></i>
            </h5>
            <div class="card-body">
                @include('master.error')
                <form action="{{ route("user.update" ,$user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="mb-3">
                        <label class="form-label" for="name">نام
                        </label>
                        <input name="name" class="form-control" id="name" placeholder="مثلا ناصر" type="text" value="{{ old("name",$user->name) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="family">نام خانوادگی
                        </label>
                        <input name="family" class="form-control" id="family" placeholder="مثلا جعفری" type="text" value="{{ old("family",$user->family) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="mobile">همراه</label>
                        <input name="mobile" class="form-control" id="mobile" placeholder="مثلا 09373699317" type="text" value="{{ old("mobile",$user->mobile) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password">رمز عبور</label>
                        <input name="password" class="form-control" id="password" placeholder="مثلا 123456" type="text" value="{{ old("password") }}">
                    </div>
                    {{--  <div class="mb-3">
                        <label class="form-label" for="personal_code">کد پرسنلی</label>
                        <input name="personal_code" class="form-control" id="personal_code" placeholder="مثلا 2323222" type="text" value="{{ old("personal_code",$user->personal_code) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="melli_code">کد ملی</label>
                        <input name="melli_code" class="form-control" id="melli_code" placeholder="مثلا 2323222" type="text" value="{{ old("melli_code",$user->melli_code) }}">
                    </div>  --}}
                    {{--  <div class="mb-3">
                        <label class="form-label" for="region_id">منطقه</label>
                        <select class="form-select" id="region_id" name="region_id">
                            <option value="">انتخاب کنید </option>
                            @foreach (App\Models\Region::withoutTrashed()->get() as $region )
                            <option {{ old("region_id",$user->region_id)==$region->id?"selected":"" }} value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>  --}}
                    <div class="mb-3">
                        <label class="form-label" for="active">وضعیت </label>
                        <select class="form-select" id="active" name="active">
                            <option value="">انتخاب کنید </option>
                            <option {{ old("active",$user->active)=="0" ?"selected":"" }} value="0">
                                غیر
                                فعال </option>
                            <option {{ old("active",$user->active)=="1" ?"selected":"" }} value="1"> فعال</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="vip">نوع کاربر</label>
                        <select class="form-select" id="vip" name="vip">
                            <option value="">انتخاب کنید </option>
                            <option {{ old("vip",$user->vip)=="0" ?"selected":"" }} value="0">معمولی</option>
                            <option {{ old("vip",$user->vip)=="1" ?"selected":"" }} value="1">Vip</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="avatar" class="form-label">تصویر پروفایل </label>
                        <input class="form-control" type="file" id="formFile"  id="avatar" name="avatar" accept="image/*">
                      </div>


                    <br>
                    <br>
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
