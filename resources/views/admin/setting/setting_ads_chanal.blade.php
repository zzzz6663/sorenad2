@extends('main.manager')
@section('content')

<form action="{{ route("setting.ads.chanal") }}" method="post">
    @csrf
    @method('post')
    <div class="components-preview wide-md mx-auto">
        <br>

        <h2 class="nk-block-title fw-normal">    {{ __("setting.chanal_title") }}   </h2>
        <br>
        <div class="card">
            <div class="card-inner">
                <div class="row">
                    <div class="col mb-3-md-6">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox checked">
                                <input type="text" name="chanal_active_site" hidden value="0">
                                <input type="checkbox" class="custom-control-input" name="chanal_active_site" id="chanal_active_site" {{ old("chanal_active_site",$chanal_active_site->val)? "checked":"" }} value="1">
                                <label class="custom-control-label" for="chanal_active_site">فعال کردن تبلیغ در سایت</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="chanal_advertiser_atlist_count">
                                حداقل تعداد کلیک

                            </label>
                            <div class="form-control-wrap">
                                <input type="text" id="chanal_advertiser_atlist_count" name="chanal_advertiser_atlist_count" class="number_format form-control" value="{{ old("chanal_advertiser_atlist_count",$chanal_advertiser_atlist_count->val) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="chanal_advertiser_atlist_price">
                                حداقل قیمت کلیک

                            </label>
                            <div class="form-control-wrap">
                                <input type="text" id="chanal_advertiser_atlist_price" name="chanal_advertiser_atlist_price" class="number_format form-control" value="{{ old("chanal_advertiser_atlist_price",$chanal_advertiser_atlist_price->val) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="chanal_advertiser_aercent">
                                درصد سورن

                            </label>
                            <div class="form-control-wrap">
                                <input type="text" id="chanal_advertiser_percent" name="chanal_advertiser_percent" class="number_format form-control" value="{{ old("chanal_advertiser_percent",$chanal_advertiser_percent->val) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <h5>
                            تنظیمات اول
                        </h5>
                        <div class="form-group">
                            <textarea name="chanal_setting1" id=""  class="edit_area form-control"  cols="30" rows="10">{{ old("chanal_setting1",$chanal_setting1->val) }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <h5>
                            تنظیمات دوم
                        </h5>
                        <div class="form-group">
                            <textarea name="chanal_setting2" id=""  class="edit_area form-control"  cols="30" rows="10">{{ old("chanal_setting2",$chanal_setting2->val) }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <h5>
                            تنظیمات سوم
                        </h5>
                        <div class="form-group">
                            <textarea name="chanal_setting3" id=""  class="edit_area form-control"  cols="30" rows="10">{{ old("chanal_setting3",$chanal_setting3->val) }}</textarea>
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



{{--
<h2 class="title_right">
    {{ __("setting.txt_title") }}
</h2>
@include("master.error")
<form action="{{ route("setting.ads.chanal") }}" method="post">
    @csrf
    @method('post')
    <div class="dashboard_site_form">
        <div class="flex">
            <label for="setting_installapp_show">فعال کردن تبلیغ در سایت ؟</label>
            <div class="flex switch_box">
                <span>بله</span>
                <label class="switch" for="txt_active_site">
                    <input type="text" name="txt_active_site" hidden value="0">
                    <input type="checkbox" id="txt_active_site" name="txt_active_site" {{ old("txt_active_site",$txt_active_site->val)?"checked":"" }} value="1">
                    <span class="slider"></span>
                </label>
                <span>خیر</span>
            </div>
        </div>

        <div class="flex_threerow">

            <p>
                <label for="txt_advertiser_click">
                    {{ __("setting.txt_advertiser_click") }}
                </label>
                <input type="text" id="txt_advertiser_click" name="txt_advertiser_click" value="{{ old("txt_advertiser_click",$txt_advertiser_click->val) }}">
            </p>

            <p>
                <label for="txt_advertiser_show">
                    {{ __("setting.txt_advertiser_show") }}
                </label>
                <input type="text" id="txt_advertiser_show" name="txt_advertiser_show" value="{{ old("txt_advertiser_show",$txt_advertiser_show->val) }}">
            </p>
            <p>
                <label for="txt_limit_order">
                    {{ __("setting.txt_limit_order") }}
                </label>
                <input type="text" id="txt_limit_order" name="txt_limit_order" value="{{ old("txt_limit_order",$txt_limit_order->val) }}">
            </p>



        </div>



        <div class="flex_tworow">

            <p>
                <label for="txt_user_vip_click">
                    {{ __("setting.txt_user_vip_click") }}
                </label>
                <input type="text" id="txt_user_vip_click" name="txt_user_vip_click" value="{{ old("txt_user_vip_click",$txt_user_vip_click->val) }}">
            </p>
            <p>
                <label for="txt_user_vip_show">
                    {{ __("setting.txt_user_vip_show") }}
                </label>
                <input type="text" id="txt_user_vip_show" name="txt_user_vip_show" value="{{ old("txt_user_vip_show",$txt_user_vip_show->val) }}">
            </p>


        </div>

        <div class="flex_tworow">




            <p>
                <label for="txt_user_normal_click">
                    {{ __("setting.txt_user_normal_click") }}
                </label>
                <input type="text" id="txt_user_normal_click" name="txt_user_normal_click" value="{{ old("txt_user_normal_click",$txt_user_normal_click->val) }}">
            </p>



            <p>
                <label for="txt_user_normal_show">
                    {{ __("setting.txt_user_normal_show") }}
                </label>
                <input type="text" id="txt_user_normal_show" name="txt_user_normal_show" value="{{ old("txt_user_normal_show",$txt_user_normal_show->val) }}">
            </p>



        </div>



    </div>

    <button class="btn btn-success">

        به روز سانی
    </button>
</form>  --}}

@endsection
