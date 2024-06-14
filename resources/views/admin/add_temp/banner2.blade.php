<div class="sorenad_banner sorenad   sorenad_par">
    <div class="rotate-border">
        <div class="banner_container" >
            <br>
            <div class=" " style="margin-bottom: 10px">
                <a target="blank" class="" href="{{Illuminate\Support\Facades\URL::signedRoute('redirect.add', ["site_id"=>$site->id,'advertis_id' =>  $advertise->id]) }}">
                <img src="{{ $advertise->banner2() }}" alt="">
                </a>
            </div>
            <h4>
                {{ $advertise->title}}
            </h4>
        </div>
    </div>
</div>
