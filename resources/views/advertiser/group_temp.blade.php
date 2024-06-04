
    @php
    $groups=[];
    if($advertise->id){
        $groups=$advertise->groups()->pluck("id")->toArray();
    }
    @endphp

  <div class="col-lg-4">
        <label class="form-label" for="groups">   کانال دسته بندی

            <span class="text text-danger">
                (خالی==همه)
            </span>
        </label>
        <select  name="groups[]" class="custom-control select2" id="groups" multiple>
            <option value=""></option>
            @foreach (App\Models\Group::whereActive(1)->get() as $group )
            <option {{ in_array($group->id,old("groups",$groups))?"selected":"" }} value="{{ $group->id }}">{{ $group->name }}</option>
            @endforeach
        </select>
        <p class="text text-warning">
            اگر تبلیغات شما مناسب برای همه دسته بندی ها می باشد،
            این بخش را خالی بگذارید.
        </p>
        {{--  <ul class="custom-control-group">
            @foreach (App\Models\Cat::whereActive(1)->get() as $group )
            <li>
                <div class="custom-control custom-checkbox custom-control-pro no-control checked">
                    <input type="checkbox" class="custom-control-input" value="{{ $group->id }}" {{ in_array($group->id,old("groups",[]))?"checked":"" }} name="groups[]" name="btnCheck" id="btnCheck{{ $group->id }}">
                    <label class="custom-control-label" for="btnCheck{{ $group->id }}">{{ $group->name }}</label>
                </div>
            </li>
            @endforeach
        </ul>  --}}
    </div>

