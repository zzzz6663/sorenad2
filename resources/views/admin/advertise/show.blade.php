@extends('main.manager')
@section('content')
<div class="components-preview wide-md mx-auto">
    <div class="card">
        <div class="card-inner">


            <div class="row">
                <div class="col-lg-12">
                    <div class="cart">
                        <div class="portlet-heading">
                            <div class="portlet-title">
                                <h3 class="title">
                                    <i class="icon-frane"></i>
                                    {{$advertise->title}}
                                </h3>
                            </div><!-- /.portlet-title -->
                            <div class="buttons-box position-relative">
                                @include("admin.add_temp.$advertise->type",['site'=>App\Models\Site::find(18)])

                            </div><!-- /.buttons-box -->
                        </div><!-- /.portlet-heading -->
                    </div><!-- /.portlet-body -->
                    <div class="text-center">
                        <br>
                        <a href="{{ route("advertise.index") }}" class="btn btn-danger">برگشت</a>

                    </div>
                </div><!-- /.portlet -->
            </div>

        </div>
    </div>
</div>

</div>
@endsection
