@extends('main.manager')
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <h5 class="card-header">
                ویرایش سوال
                <span class="text text-success">
                    {{ $faq->title }}
                </span>
                <i class="ti ti-user-plus"></i>
            </h5>
            <div class="card-body">
                @include('master.error')
                <form action="{{ route("faq.update",$faq->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="mb-3">
                        <label class="form-label" for="title">عنوان
                        </label>
                        <input name="title" class="form-control" id="title" placeholder=" " type="text" value="{{ old("title",$faq->title) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="melli_code">محتوا</label>
                        <textarea name="content" id="" class="form-control"  cols="30" rows="10">{{ old("content",$faq->content) }}</textarea>
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
                        <a href="{{ route("faq.index") }}" class="btn btn-warning">
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
