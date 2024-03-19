<div class="soren_ad_mobile sorenad s-w-100 sorenad_par">
    <div class="sorenad_logo">
        <img class="" src="{{ asset("/site/images/mono.png") }}">
    </div>
    <div>
        <h6>
            {{ $advertis->title }}
        </h6>
        <p>
            {{ $advertis->info }}
        </p>
        <div class=" sorenad_btn_par">
            @if($advertis->landing_link1)
            <a class="sorenad_btn" href="{{Illuminate\Support\Facades\URL::signedRoute('redirect.add', ['advertis_id' =>  $advertis->id,"link_number"=>1]) }}">
                {{ $advertis->landing_title1 }}
            </a>
            @endif
            @if($advertis->landing_link2)
            <a class="sorenad_btn" href="{{Illuminate\Support\Facades\URL::signedRoute('redirect.add', ['advertis_id' =>  $advertis->id,"link_number"=>2]) }}">
                {{ $advertis->landing_title2 }}
            </a>
            @endif
            @if($advertis->landing_link3)
            <a class="sorenad_btn" href="{{Illuminate\Support\Facades\URL::signedRoute('redirect.add', ['advertis_id' =>  $advertis->id,"link_number"=>3]) }}">
                {{ $advertis->landing_title3 }}
            </a>
            @endif
            {{--  <a class="sorenad_btn" href="{{Illuminate\Support\Facades\URL::signedRoute('redirect_at', ['advertis_id' =>  $advertis->id,"link_number"=>1]) }}">  --}}

        </div>
        <span class="sorenad_close">
            <svg width="20" height="20" viewbox="0 0 30 30"><path d="M 10,10 L 30,30 M 30,10 L 10,30" stroke="black" stroke-width="4" /></svg>
        </span>
    </div>
</div>
