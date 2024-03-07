
@if($errors->any())
<div class="er" id="er">
    {!! implode('', $errors->all('<span class="text text-danger">:message</span> </br>')) !!}
</div>
@endif
