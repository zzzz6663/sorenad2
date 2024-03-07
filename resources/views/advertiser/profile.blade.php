@extends('main.manager')
@section('content')


@include("master.error")
<form action="{{ route("advertiser.profile") }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('post')

    <div class="components-preview wide-md mx-auto">

        <div class="card">
            <div class="card-inner">
                <h2 class="title_right">
                      پروفایل
                </h2>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="name">نام</label>
                                <div class="form-control-wrap">
                                    <input type="number" class=" form-control" id="name" name="name" value="{{ old("name",$user->name) }}">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="family">نام خانوادگی</label>
                                <div class="form-control-wrap">
                                    <input type="number" value="{{ old("family",$user->family) }}" id="family" name="family" class=" form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="site">کد ملی</label>
                                <div class="form-control-wrap">
                                    <input type="text" value="{{ old("mellicode",$user->mellicode) }}" id="mellicode" name="mellicode" class=" form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="site">شماره موبایل</label>
                                <div class="form-control-wrap">
                                    <input type="text" value="{{ old("mobile",$user->mobile) }}" readonly id="mobile" name="mobile" class=" form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="default-06">آپلود فایل </label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file"  id="avatar" name="avatar" accept="image/png, image/jpeg">
                                        <label class="form-file-label" for="avatar"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button class="btn btn-success">
                                <i class="fas fa-save"></i>
                                ذخیره
                            </button>
                        </div>
                    </div>

            </div>


        </div>


    </div>




{{--
    <h2 class="title_right"><i class="fa fa-user-o"></i>اطلاعات کلی</h2>
    <div class="dashboard_site_form">

            <div class="form_right_box flex_tworow">
                <p>
                    <label for="fname">نام</label>
                    <input type="text" id="fname" value="{{ old("name",$user->name) }}"  name="name">
                </p>
                <p>
                    <label for="family">نام خانوادگی</label>
                    <input type="text" id="family" value="{{ old("family",$user->family) }}"  name="family">
                </p>
                <p>
                    <label for="mellicode">کد ملی</label>
                    <input type="text" id="mellicode" value="{{ old("mellicode",$user->mellicode) }}" name="mellicode">
                </p>
                <p>
                    <label for="mobile">شماره موبایل</label>
                    <input type="text" id="mobile" readonly value="{{ old("mobile",$user->mobile) }}" name="mobile">
                </p>

            </div>

            <div class="form_left_box upload_avatar">

                <p>
                    <i class="fa fa-image"></i>
                    <label class="avatar_select" for="avatar">آپلود آواتار</label>
                    <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg">
                </p>

            </div>

        <div class="clear"></div>
    </div>

    <button class="btn btn-success">

        به روز سانی
    </button>  --}}
</form>

@endsection
