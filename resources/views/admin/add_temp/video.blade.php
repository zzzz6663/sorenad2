<div class="sorenad_video sorenad   sorenad_par">
    <div class="rotate-border">
        <div class="video_container" >
            <div class="smb-10 " >

                <video autoplay muted controls>
                    <source src="{{ $advertise->video1() }}" type="video/mp4">
                  </video>
            </div>
            <h6 class="smb-10 " id="s_call_to_action">
                {{ $advertise->call_to_action}}
            </h6>
            <div class=" sorenad_btn_par" id="video_sorenad_btn_par">
                @if($site)
                <a target="blank" class="sorenad_btn" href="{{Illuminate\Support\Facades\URL::signedRoute('redirect.add', ["site_id"=>$site->id,'advertis_id' =>  $advertise->id]) }}">
                    {{ $advertise->landing_title1 }}
                </a>
                @endif

            </div>
        </div>
    </div>
</div>
