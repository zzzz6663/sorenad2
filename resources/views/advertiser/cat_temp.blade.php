<div class="row mb-5">
    <div class="col-lg-12">
        <h5 class="text text-info">
            تعیین کنید این تبلیغ در چه سایتهایی نمایش داده شود ؟ اگر محصول یا خدمات شما برای تمام اقشار جامعه مناسب است، هیچ دسته بندی را انتخاب نکنید .
        </h5>
        <select  name="cats[]" class="custom-control select2" id="" multiple>
            <option value=""></option>
            @foreach (App\Models\Cat::whereActive(1)->get() as $cat )
            <option {{ in_array($cat->id,old("cats",[]))?"selected":"" }} value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach

        </select>
        {{--  <ul class="custom-control-group">
            @foreach (App\Models\Cat::whereActive(1)->get() as $cat )
            <li>
                <div class="custom-control custom-checkbox custom-control-pro no-control checked">
                    <input type="checkbox" class="custom-control-input" value="{{ $cat->id }}" {{ in_array($cat->id,old("cats",[]))?"checked":"" }} name="cats[]" name="btnCheck" id="btnCheck{{ $cat->id }}">
                    <label class="custom-control-label" for="btnCheck{{ $cat->id }}">{{ $cat->name }}</label>
                </div>
            </li>
            @endforeach
        </ul>  --}}
    </div>
</div>
