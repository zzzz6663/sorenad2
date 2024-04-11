<div class="soren_ad_mobile sorenad s-w-100 sorenad_par">
    <div class="soren_ad_container">
        <div class="sorenad_logo_cont">
            <div class="sorenad_logo">
                {{-- <img class="" src="{{ asset("/site/images/mono.png") }}"> --}}
                <img class="" src="{{ $advertise->icon() }}">
            </div>
        </div>
        <div class="sorenad_body">
            <h3 class="sorenad_title">
                {{ $advertise->title }}
            </h3>
            <p>
                {{ $advertise->info }}
            </p>
            <div class=" sorenad_btn_par">
                @if($advertise->landing_link1)
                <a class="sorenad_btn" href="{{Illuminate\Support\Facades\URL::signedRoute('redirect.add', ["site_id"=>$site->id,'advertis_id' =>  $advertise->id,"link_number"=>1]) }}">
                    {{ $advertise->landing_title1 }}
                </a>
                @endif
                @if($advertise->landing_link2)
                <a class="sorenad_btn" href="{{Illuminate\Support\Facades\URL::signedRoute('redirect.add', ["site_id"=>$site->id,'advertis_id' =>  $advertise->id,"link_number"=>2]) }}">
                    {{ $advertise->landing_title2 }}
                </a>
                @endif
                @if($advertise->landing_link3)
                <a class="sorenad_btn" href="{{Illuminate\Support\Facades\URL::signedRoute('redirect.add', ["site_id"=>$site->id,'advertis_id' =>  $advertise->id,"link_number"=>3]) }}">
                    {{ $advertise->landing_title3 }}
                </a>
                @endif
                {{-- <a class="sorenad_btn" href="{{Illuminate\Support\Facades\URL::signedRoute('redirect_at', ["site_id"=>$sit->id,'advertis_id' =>  $advertise->id,"link_number"=>1]) }}"> --}}

            </div>
            <span class="sorenad_close">
                <svg width="20" height="20" viewbox="0 0 30 30">
                    <path d="M 10,10 L 30,30 M 30,10 L 10,30" stroke="black" stroke-width="4" /></svg>
            </span>
            <span class="sorenad_base_logo">
                <a href="https://sorenad.com/">
                    <img class="" src="{{ asset("/site/images/mono.png") }}">

                </a>
                </span>

        </div>
    </div>
</div>
