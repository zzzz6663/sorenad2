@extends('main.manager')
@section('content')



 <div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <h5 class="card-header">
                  برسی سایت
                  {{ $site->name }}
                  از کاربر
                  <span class="text text-success">
                    {{ $site->user->name }}
                    {{ $site->user->family }}
                  </span>

            </h5>
            <div class="card-body">
                @include('master.error')
                <form action="{{ route("site.confirm" ,$site->id) }}" method="post" >
                    @csrf
                    @method('post')

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
                        <label class="form-label" for="status">وضعیت </label>
                        <select class="form-select" id="status" name="status">
                            <option value="">انتخاب کنید </option>
                            <option {{ old("status")=="confirmed" ?"selected":"" }} value="confirmed">
                                تایید  </option>
                            <option {{ old("status")=="rejected" ?"selected":"" }} value="rejected"> عدم تایید </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="reason">توضیحات  </label>
                        <textarea name="reason" id=""  class="form-control"  cols="30" rows="6">{{ old("reason") }}</textarea>
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
