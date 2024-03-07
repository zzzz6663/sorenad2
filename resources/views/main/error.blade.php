    @if($errors->any())
<div class="er_box">

    <div class="er" id="er">
        {!! implode('', $errors->all('<span class="text text-danger">:message</span> </br>')) !!}
    </div>
</div>

@endif
