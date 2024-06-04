<div class="ssoren_cont">
    <div class="icon_soren">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 32 32" height="32px" id="Layer_1" version="1.1" viewBox="0 0 32 32" width="32px" xml:space="preserve"><path d="M18.221,7.206l9.585,9.585c0.879,0.879,0.879,2.317,0,3.195l-0.8,0.801c-0.877,0.878-2.316,0.878-3.194,0  l-7.315-7.315l-7.315,7.315c-0.878,0.878-2.317,0.878-3.194,0l-0.8-0.801c-0.879-0.878-0.879-2.316,0-3.195l9.587-9.585  c0.471-0.472,1.103-0.682,1.723-0.647C17.115,6.524,17.748,6.734,18.221,7.206z" fill="#515151"/></svg>
    </div>
    <div class="soren_ad_hamsab     sorenad s-w-100 sorenad_par">

        <div class="soren_han_container">
            <span class="sorenad_base_logo">
                <a href="https://sorenad.com/">
                    <img class="" id="sorenad_logo" src="{{ asset("/site/images/mono.png") }}">
                </a>
            </span>
            <div class="sorenad_ham_body">
                <div class="sorenad_ham_img">
                    <div class="">
                        {{-- <img class="" src="{{ asset("/site/images/mono.png") }}"> --}}
                        <img class="" src="{{ $advertise->banner1() }}">
                    </div>
                </div>
               <div>
                <h3 class="sorenad_title" id="sorenad_title">
                    {{ $advertise->title }}
                </h3>
                <p class="sorenad_info" id="sorenad_info">
                        {{ $advertise->info }}
                </p>
               </div>
                <div class=" sorenad_btn_par" id="sorenad_btn_par">
                    <a target="blank" class="btn_full " style="background: {{ $advertise->bt_color }}" href="{{Illuminate\Support\Facades\URL::signedRoute('redirect.add', ["site_id"=>$site->id,"ip"=>$ip,'advertis_id' =>  $advertise->id,"link_number"=>1]) }}">
                        {{ $advertise->landing_title1 }}
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>
