@extends('main.manager')
@section('content')

<form action="{{ route("setting.ads.app") }}" method="post">
    @csrf
    @method('post')
    <div class="components-preview wide-md mx-auto">
        <br>

        <h2 class="nk-block-title fw-normal">    {{ __("setting.app_title") }}   </h2>
        <br>
        <div class="card">
            <div class="card-inner">
                <div class="row">
                    <div class="col mb-3-md-6">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox checked">
                                <input type="text" name="app_active_site" hidden value="0">
                                <input type="checkbox" class="custom-control-input" id="app_active_site" {{ old("app_active_site",$app_active_site->val)?"checked":"" }} value="1">
                                <label class="custom-control-label" for="app_active_site">فعال کردن تبلیغ در سایت</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="app_advertiser_click">
                                                            {{ __("setting.app_advertiser_click") }}
                            </label>
                            <div class="form-control-wrap">
                                <input type="text" id="app_advertiser_click" name="app_advertiser_click" class="number_format form-control" value="{{ old("app_advertiser_click",$app_advertiser_click->val) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="app_advertiser_show">
                                                            {{ __("setting.app_advertiser_show") }}
                            </label>
                            <div class="form-control-wrap">
                                <input type="text" id="app_advertiser_show" name="app_advertiser_show" class="number_format form-control" value="{{ old("app_advertiser_show",$app_advertiser_show->val) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="app_limit_order">
                                                            {{ __("setting.app_limit_order") }}
                            </label>
                            <div class="form-control-wrap">
                                <input type="text" id="app_limit_order" name="app_limit_order" class="number_format form-control" value="{{ old("app_limit_order",$app_limit_order->val) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="app_user_vip_click">
                                                            {{ __("setting.app_user_vip_click") }}
                            </label>
                            <div class="form-control-wrap">
                                <input type="text" id="app_user_vip_click" name="app_user_vip_click" class="number_format form-control" value="{{ old("app_user_vip_click",$app_user_vip_click->val) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="app_user_vip_show">
                                                            {{ __("setting.app_user_vip_show") }}
                            </label>
                            <div class="form-control-wrap">
                                <input type="text" id="app_user_vip_show" name="app_user_vip_show" class="number_format form-control" value="{{ old("app_user_vip_show",$app_user_vip_show->val) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="app_user_normal_click">
                                                            {{ __("setting.app_user_normal_click") }}
                            </label>
                            <div class="form-control-wrap">
                                <input type="text" id="app_user_normal_click" name="app_user_normal_click" class="number_format form-control" value="{{ old("app_user_normal_click",$app_user_normal_click->val) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="app_user_normal_show">
                                                            {{ __("setting.app_user_normal_show") }}
                            </label>
                            <div class="form-control-wrap">
                                <input type="text" id="app_user_normal_show" name="app_user_normal_show" class="number_format form-control" value="{{ old("app_user_normal_show",$app_user_normal_show->val) }}">
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



        </div>


    </div>

</form>




{{--  <h2 class="title_right">
    {{ __("setting.app_title") }}
</h2>
@include("master.error")  --}}
{{--  <form action="{{ route("setting.ads.app") }}" method="post">
    @csrf
    @method('post')
    <div class="dashboard_site_form">
        <div class="flex">
            <label for="setting_installapp_show">فعال کردن تبلیغ در سایت ؟</label>
            <div class="flex switch_box">
                <span>بله</span>
                <label class="switch" for="app_active_site">
                    <input type="text" name="app_active_site" hidden value="0">
                    <input type="checkbox" id="app_active_site" name="app_active_site" {{ old("app_active_site",$app_active_site->val)?"checked":"" }} value="1">
                    <span class="slider"></span>
                </label>
                <span>خیر</span>


            </div>
        </div>

        <div class="flex_threerow">

            <p>
                <label for="app_advertiser_click">
                    {{ __("setting.app_advertiser_click") }}
                </label>
                <input type="text" id="app_advertiser_click" name="app_advertiser_click" value="{{ old("app_advertiser_click",$app_advertiser_click->val) }}">
            </p>

            <p>
                <label for="app_advertiser_show">
                    {{ __("setting.app_advertiser_show") }}
                </label>
                <input type="text" id="app_advertiser_show" name="app_advertiser_show" value="{{ old("app_advertiser_show",$app_advertiser_show->val) }}">
            </p>
            <p>
                <label for="app_limit_order">
                    {{ __("setting.app_limit_order") }}
                </label>
                <input type="text" id="app_limit_order" name="app_limit_order" value="{{ old("app_limit_order",$app_limit_order->val) }}">
            </p>



        </div>



        <div class="flex_tworow">

            <p>
                <label for="app_user_vip_click">
                    {{ __("setting.app_user_vip_click") }}
                </label>
                <input type="text" id="app_user_vip_click" name="app_user_vip_click" value="{{ old("app_user_vip_click",$app_user_vip_click->val) }}">
            </p>
            <p>
                <label for="app_user_vip_show">
                    {{ __("setting.app_user_vip_show") }}
                </label>
                <input type="text" id="app_user_vip_show" name="app_user_vip_show" value="{{ old("app_user_vip_show",$app_user_vip_show->val) }}">
            </p>


        </div>

        <div class="flex_tworow">




            <p>
                <label for="app_user_normal_click">
                    {{ __("setting.app_user_normal_click") }}
                </label>
                <input type="text" id="app_user_normal_click" name="app_user_normal_click" value="{{ old("app_user_normal_click",$app_user_normal_click->val) }}">
            </p>



            <p>
                <label for="app_user_normal_show">
                    {{ __("setting.app_user_normal_show") }}
                </label>
                <input type="text" id="app_user_normal_show" name="app_user_normal_show" value="{{ old("app_user_normal_show",$app_user_normal_show->val) }}">
            </p>



        </div>



    </div>

    <button class="btn btn-success">

        به روز سانی
    </button>
</form>  --}}

@endsection
