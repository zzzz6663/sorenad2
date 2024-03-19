@extends('main.manager')
@section('empty')
<div class="nk-block nk-block-middle wide-md mx-auto">
    <div class="nk-block-content nk-error-ld text-center">
        <img class=" logo-small logo-img logo_side"  src="/site/images/plogo.png">
        <br>
        <br>
        <div class="wide-xs mx-auto">
            <h3 class="nk-error-title">در حال انتقال به مقصدمورد نظر هستیم </h3>
            <p class="nk-error-text">
                چند ثانیه صبر کنید
            </p>
            <script>
                setTimeout(function(){
                    window.location.href="{{$link }}"
                }, 3000)
            </script>

            {{--  <a href="html/index.html" class="btn btn-lg btn-primary mt-2">بازگشت به صفحه اصلی</a>  --}}
        </div>

    </div>
</div>

@endsection
