
    @php
    $cats=[];
    if($advertise->id){
        $cats=$advertise->cats()->pluck("id")->toArray();
    }
    @endphp

  <div class="col-lg-6">
        <label class="form-label" for="cats">    دسته بندی

            <span class="text text-danger">
                (خالی==همه)
            </span>
        </label>
        <select  name="cats[]" class="custom-control select2" id="cats" multiple>
            <option value=""></option>
            @foreach (App\Models\Cat::whereActive(1)->get() as $cat )
            <option {{ in_array($cat->id,old("cats",$cats))?"selected":"" }} value="{{ $cat->id }}">{{ $cat->name }}</option>
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

