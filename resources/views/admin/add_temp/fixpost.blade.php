<div class="sorenad_fixpost sorenad  sorenad_par">
    <div class="fixpost_container" id="fixpost_container" style="background: {{ $advertise->bg_color }}">
        <p id="s_info">
            {!! $advertise->info !!}
        </p>
        <br>
        <div class=" sorenad_btn_par" id="fix_sorenad_btn_par" >
            @if($site)
            <a target="blank" class="sorenad_btn" href="{{Illuminate\Support\Facades\URL::signedRoute('redirect.add', ["site_id"=>$site->id,'advertis_id' =>  $advertise->id]) }}">
                {{ $advertise->landing_title1 }}
            </a>
            @endif

        </div>
        <br>
        <h5 style="text-align: center" id="s_call_to_action_fix">
            {{ $advertise->call_to_action }}

        </h5>
    </div>
</div>
