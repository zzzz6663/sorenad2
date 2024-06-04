@extends('main.manager')

@section('content')
<h2 class="title_right">سفارش تبلیغ پست ثابت</h2>
<div class="card">
    <div class="card-inner">
        @include("master.error")
        <form action="{{ route("advertiser.new.ad.fixpost") }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <button type="button" class="btn no_link btn-primary" data-bs-toggle="modal" data-bs-target="#modalDefault">پیش نمایش</button>
            <div class="modal fade" tabindex="-1" id="modalDefault" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">پیش نمایش </h5>
                            <a href="#" class="close no_link" data-bs-dismiss="modal" aria-label="بستن">
                                <em class="icon ni ni-cross"></em>
                            </a>
                        </div>
                        <div class="modal-body" id="fixpost_pop">
                            @include("admin.add_temp.fixpost",['site'=>null])
                        </div>
                        {{--  <div class="modal-footer bg-light">
                            <span class="sub-text">متن پاورقی مودال</span>
                        </div>  --}}
                    </div>
                </div>
            </div>

            @include('advertiser.ad_temp.fixpost')
            @include('advertiser.cat_temp')
            @include('advertiser.price_temp')

        </form>
    </div>
</div>

@endsection
