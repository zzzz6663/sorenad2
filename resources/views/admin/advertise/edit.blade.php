@extends('main.manager')
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">
                ویرایش اطلاعات آگهی
                <span class="text  text-success">
                    {{ $advertise->title }}
                </span>
                مشتری
                <span class="text  text-success">
                    {{ $advertise->user->name }}
                    {{ $advertise->user->family }}
                </span>
                نوع
                <span class="text  text-success">
                    {{ __("advertise_type.".$advertise->type) }}
                </span>
                <i class="ti ti-edit"></i>
            </h5>
            <div class="card-body">
                @include('master.error')
                <form action="{{ route("advertise.update" ,$advertise->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="title">عنوان
                                </label>
                                <input name="title" class="form-control" id="title" type="text" value="{{ old("title",$advertise->title) }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="text">
                                    متن تبلیغ
                                </label>
                                <input name="text" class="form-control" id="text" type="text" value="{{ old("text",$advertise->text) }}">
                            </div>
                        </div>

                        <div class="col-lg-12">

                            <div class="mb-3">
                                <label class="form-label" for="title">توضیحات
                                </label>
                                <textarea name="info" id="info" class="form-control" cols="30" rows="2">{{ old("info",$advertise->info) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="landing_title1"> عنوان لینک ورود 1
                                </label>
                                <input name="landing_title1" class="form-control" id="landing_title1" type="text" value="{{ old("landing_title1",$advertise->landing_title1) }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="landing_link1"> لینک ورود 1
                                </label>
                                <input name="landing_link1" class="form-control" id="landing_link1" type="text" value="{{ old("landing_link1",$advertise->landing_link1) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="landing_title2"> عنوان لینک ورود 2
                                </label>
                                <input name="landing_title2" class="form-control" id="landing_title2" type="text" value="{{ old("landing_title2",$advertise->landing_title2) }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="landing_link2"> لینک ورود 2
                                </label>
                                <input name="landing_link2" class="form-control" id="landing_link2" type="text" value="{{ old("landing_link2",$advertise->landing_link2) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="landing_title3"> عنوان لینک ورود 3
                                </label>
                                <input name="landing_title3" class="form-control" id="landing_title3" type="text" value="{{ old("landing_title3",$advertise->landing_title3) }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="landing_link3"> لینک ورود 3
                                </label>
                                <input name="landing_link3" class="form-control" id="landing_link3" type="text" value="{{ old("landing_link3",$advertise->landing_link3) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="limit_daily_view"> محدودیت نمایش روزانه
                                </label>
                                <input name="limit_daily_view" class="form-control" id="limit_daily_view" type="text" value="{{ old("limit_daily_view",$advertise->limit_daily_view) }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="limit_daily_click"> محدودیت کلیک روزانه
                                </label>
                                <input name="limit_daily_click" class="form-control" id="limit_daily_click" type="text" value="{{ old("limit_daily_click",$advertise->limit_daily_click) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="banner1"> بنر یک
                                    @if($advertise->banner1())
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        مشاهده
                                    </button>
                                    @endif
                                </label>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ $advertise->banner1() }}" alt="">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input name="banner1" class="form-control" id="banner1" type="file">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="banner2"> بنر دو
                                    @if($advertise->banner2())
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                        مشاهده
                                    </button>
                                    @endif
                                </label>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ $advertise->banner2() }}" alt="">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input name="banner2" class="form-control" id="banner2" type="file">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="icon">   icon
                                    @if($advertise->icon())
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                                        مشاهده
                                    </button>
                                    @endif
                                </label>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ $advertise->icon() }}" alt="">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input name="icon" class="form-control" id="icon" type="file">
                            </div>
                        </div>


                    </div>



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
