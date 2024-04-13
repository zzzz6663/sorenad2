
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDefault{{ $advertise->id }}">
    جزئیات
</button>
<div class="modal fade" tabindex="-1" id="modalDefault{{ $advertise->id }}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">جزئیات آگهی
                    <span class="text text-primary">
                        {{  $advertise->title }}
                    </span>

                </h5>
                <a href="#" class="close no_link" data-bs-dismiss="modal" aria-label="بستن">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body text-align-right">
                <div class="row">
                    <div class="col-lg-3 text-align-right mb-2">
                        <span class="title fw-bold modal-title">
                            عنوان:
                        </span>
                        <span class="content">
                            {{  $advertise->title }}
                        </span>
                    </div>
                    @if( $advertise->device)
                    <div class="col-lg-3 text-align-right mb-2">
                        <span class="title fw-bold modal-title">
                            دیوایس:
                        </span>
                        <span class="content">
                            {{  $advertise->device }}
                        </span>
                    </div>
                    @endif
                    @if( $advertise->banner1)
                    <div class="col-lg-3 text-align-right mb-2">
                        <span class="title fw-bold modal-title">
                            بنر اول:
                        </span>
                        <span class="content">
                            <a target="_blank"  class="no_link" href="{{ $advertise->banner1() }}"></a>
                        </span>
                    </div>
                    @endif
                    @if( $advertise->banner2)
                    <div class="col-lg-3 text-align-right mb-2">
                        <span class="title fw-bold modal-title">
                            بنر دوم:
                        </span>
                        <span class="content">
                            <a target="_blank"  class="no_link" href="{{ $advertise->banner2() }}"></a>
                        </span>
                    </div>
                    @endif

                    @if( $advertise->banner3)
                    <div class="col-lg-3 text-align-right mb-2">
                        <span class="title fw-bold modal-title">
                            بنر سوم:
                        </span>
                        <span class="content">
                            <a target="_blank"  class="no_link" href="{{ $advertise->banner3() }}"></a>
                        </span>
                    </div>
                    @endif

                    @if( $advertise->icon)
                    <div class="col-lg-3 text-align-right mb-2">
                        <span class="title fw-bold modal-title">
                            آیکون:
                        </span>
                        <span class="content">
                            <a target="_blank"  class="no_link" href="{{ $advertise->icon() }}"></a>
                        </span>
                    </div>
                    @endif

                    <div class="col-lg-3 text-align-right mb-2">
                        <span class="title fw-bold modal-title">
                            نوع آگهی:
                        </span>
                        <span class="content">
                            {{  __("advertise_type.".$advertise->type) }}
                        </span>
                    </div>



                    <div class="col-lg-3 text-align-right mb-2">
                        <span class="title fw-bold modal-title">
                            مدل قیمت گذاری:
                        </span>
                        <span class="content">
                            {{  __("arr.".$advertise->count_type) }}
                        </span>
                    </div>

                    @if($advertise->count_type=="click")
                    <div class="col-lg-3 text-align-right mb-2">
                        <span class="title fw-bold modal-title">
                            تعداد کلیک درخواستی:
                        </span>
                        <span class="content">
                            {{ $advertise->click_count}}
                        </span>
                    </div>
                    <div class="col-lg-3 text-align-right mb-2">
                        <span class="title fw-bold modal-title">
                            محدودیت تعداد کلیک:
                        </span>
                        <span class="content">
                            {{ $advertise->limit_daily_click}}
                        </span>
                    </div>
                    <div class="col-lg-3 text-align-right mb-2">
                        <span class="title fw-bold modal-title">
                            تعداد  کلیک امروز:
                        </span>
                        <span class="content">
                            {{ $advertise->actions()->where("count_type","click")->whereMain(1)->count()}}
                        </span>
                    </div>
                    @endif
                    @if($advertise->count_type=="view")
                    <div class="col-lg-3 text-align-right mb-2">
                        <span class="title fw-bold modal-title">
                            تعداد نمایش:
                        </span>
                        <span class="content">
                            {{ $advertise->view_count}}
                        </span>
                    </div>
                    <div class="col-lg-3 text-align-right mb-2">
                        <span class="title fw-bold modal-title">
                            محدودیت تعداد نمایش:
                        </span>
                        <span class="content">
                            {{ $advertise->limit_daily_view}}
                        </span>
                    </div>
                    <div class="col-lg-3 text-align-right mb-2">
                        <span class="title fw-bold modal-title">
                            تعداد  نمایش امروز:
                        </span>
                        <span class="content">
                            {{ $advertise->actions()->where("count_type","view")->whereMain(1)->count()}}
                        </span>
                    </div>
                    @endif
                    <div class="col-lg-12 text-align-right mb-2">
                        <span class="title fw-bold modal-title">
                            لینک های فرود:
                        </span>
                        <span class="content">
                            @if($advertise->landing_link1)
                            <a class="no_link" target="_blank" href="{{ $advertise->landing_link1 }}">{{ $advertise->landing_title1 }}</a>
                            @endif
                            @if($advertise->landing_link2)
                            <a class="no_link" target="_blank" href="{{ $advertise->landing_link2 }}">{{ $advertise->landing_title2 }}</a>
                            @endif
                            @if($advertise->landing_link3)
                            <a class="no_link" target="_blank" href="{{ $advertise->landing_link3 }}">{{ $advertise->landing_title3 }}</a>
                            @endif
                            @if($advertise->video1)
                            <a class="no_link" target="_blank" href="{{ $advertise->video1() }}">ویدئو</a>
                            @endif
                        </span>
                    </div>
                    {{--  <div class="col-lg-12 text-align-right mb-2">
                        <span class="title fw-bold modal-title">
                            توضیحات آگهی:
                        </span>
                        <span class="content">
                          {!! $advertise->info  !!}
                        </span>
                    </div>  --}}
                    <div class="col-lg-12 text-align-right mb-2">
                        <span class="title fw-bold modal-title">
                            متن تبلیغ:
                        </span>
                        <span class="content">
                          {{ $advertise->text }}
                        </span>
                    </div>
                    <div class="col-lg-3 text-align-right mb-2">
                        <span class="title fw-bold modal-title">
                            تعداد کلیک:
                        </span>
                        <span class="content">
                          {{ $advertise->actions()->where("count_type","click")->whereMain(1)->count() }}
                        </span>
                    </div>
                    <div class="col-lg-3 text-align-right mb-2">
                        <span class="title fw-bold modal-title">
                            تعداد نمایش:
                            {{--  {{ $advertise->status }}  --}}
                        </span>
                        <span class="content">
                            {{ number_format($advertise->display) }}
                          {{--  {{ $advertise->actions()->whereIn("count_type","view")->count() }}  --}}
                        </span>
                    </div>
                    @role('customer')
                    <div class="col-lg-12 text-align-right mb-2 mt-2">
                        @if(!$advertise->payed)
                        <form action="{{ route("advertiser.new.ad.".$advertise->type,$advertise->id) }}" method="post">
                            @csrf
                            @method('post')
                            <input type="text" value="acc_money" name="pay_type" hidden>
                            <input type="submit" class="btn btn-primary" value="پرداخت با کیف">
                        </form>
                        <form action="{{ route("advertiser.new.ad.".$advertise->type,$advertise->id) }}" method="post">
                            @csrf
                            @method('post')
                            <input type="text" value="bank_pay" name="pay_type" hidden>

                            <input type="submit" class="btn btn-primary" value="پرداخت مجدد">
                        </form>
                        @else
                        <div class="custom-control custom-control-lg custom-switch">
                            <input type="checkbox" {{ $advertise->active?"checked":" " }} class="custom-control-input add_active" data-id="{{ $advertise->id }}" id="add_active{{ $advertise->id }}" value="1">
                            <label class="custom-control-label " for="add_active{{ $advertise->id }}">
                                {{ $advertise->active?"فعال":"غیر فعال" }}
                            </label>
                        </div>
                        @endif
                    </div>
                    @endrole
                </div>
            </div>
            <div class="modal-footer bg-light">
                @role('customer')
                @if($advertise->status=="ready_to_show")

                <span class="sub-text">
                    <p>
                        درصورت تمایل میتوانید باقیمانده اعتبار به کیف پول برگردانید
                    </p>
                    <form action="{{ route("advertise.reject" ,$advertise->id) }}" method="post">
                        @csrf
                        @method('post')
                        <span class="btn btn-danger confirm_reject">
                            بازگشت باقیمانده به کیف
                        </span>
                    </form>
                </span>
                @endif
                @endrole
            </div>
        </div>
    </div>
</div>
