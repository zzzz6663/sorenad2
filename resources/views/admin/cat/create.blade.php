@extends('main.manager')
@section('content')


<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <h5 class="card-header">تعریف دسته بندی جدید
                <i class="ti ti-user-plus"></i>
            </h5>
            <div class="card-body">
                @include('master.error')
                <form action="{{ route("cat.store") }}" method="post">
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <label class="form-label" for="name">عنوان
                        </label>
                        <input name="name" class="form-control" id="name" placeholder=" " type="text" value="{{ old("name") }}">
                    </div>



                    <div class="mb-3">
                        <label class="form-label" for="active">وضعیت </label>
                        <select class="form-select" id="active" name="active">
                            <option value="">انتخاب کنید </option>
                            <option {{ old("active")=="0" ?"selected":"" }} value="0">غیر فعال </option>
                            <option {{ old("active")=="1" ?"selected":"" }} value="1"> فعال</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <a href="{{ route("cat.index") }}" class="btn btn-warning">
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
