<div class="sorenad_fixpost sorenad  sorenad_par">
    <div class="fixpost_container" style="background: {{ $advertise->bg_color }}">
        <p>
            {!! $advertise->info !!}
        </p>
        <br>
        <div class=" sorenad_btn_par">
            <a target="blank" class="sorenad_btn" href="{{Illuminate\Support\Facades\URL::signedRoute('redirect.add', ["site_id"=>$site->id,"ip"=>$ip,'advertis_id' =>  $advertise->id]) }}">
                {{ $advertise->landing_title1 }}
            </a>
        </div>
        <br>
        <h5 style="text-align: center">
            {{ $advertise->call_to_action }}

        </h5>
    </div>
</div>
