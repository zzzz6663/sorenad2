
@if($advertise->count() > 0)

<div class="sorenad_text sorenad s-w-100 sorenad_par">
    <div class="soren_ad_container_txt">
        <div class="">
            <div class="sorenad_logo2">
                {{-- <img class="" src="{{ asset("/site/images/mono.png") }}"> --}}
            </div>
        </div>
        <div>
            <div class="d-flexj">
                <div>
                    <img class="" src="{{ asset("/site/images/mono.png") }}">
                </div>

            </div>
            <ul class="">
            <li style="background: #e1e1e1; text-align: center">
                از سرتاسر وب
            </li>
                @foreach ($advertise as $adver )
                <li>
                   <a href="{{Illuminate\Support\Facades\URL::signedRoute('redirect.add', ["site_id"=>$site->id,"ip"=>$ip,'advertis_id' =>  $adver->id]) }}" >
                    {{ $adver->title }}
                   </a>
                </li>
                @endforeach

            </ul>
        </div>
    </div>
</div>
@endif
