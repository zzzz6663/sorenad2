@extends('main.manager')
@section('content')
<div class="components-preview wide-md mx-auto">

    <div class="nk-chat">
        <div class="nk-chat-body profile-shown">
            <div class="nk-chat-head">
                <ul class="nk-chat-head-info">
                    <li class="nk-chat-body-close">
                        <a href="#" class="btn btn-icon btn-trigger nk-chat-hide ms-n1"><em class="icon ni ni-arrow-left"></em></a>
                    </li>
                    <li class="nk-chat-head-user">
                        <div class="user-card">
                            <div class="user-avatar bg-purple">
                                <img src="{{ $userticket->customer->avatar() }}" alt="">
                            </div>
                            <div class="user-info">
                                <div class="lead-text">

                                    {{ $userticket->title }}
                                </div>
                                <div class="sub-text">
                                    {{ $userticket->customer->name }}
                                    {{ $userticket->customer->family }}
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>


                <!-- .nk-chat-head-search -->
            </div>

            <div class="nk-chat-panel" data-simplebar="init">
                <div class="simplebar-wrapper" style="margin: -20px -28px;">
                    <div class="simplebar-height-auto-observer-wrapper">
                        <div class="simplebar-height-auto-observer"></div>
                    </div>
                    <div class="simplebar-mask">
                        <div class="simplebar-offset" style="left: 0px; bottom: 0px;">
                            <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                                <div class="simplebar-content" style="padding: 20px 28px;">
                                    @foreach ($answers as $answer)
                                    @if($answer->customer_id)
                                    <div class="chat is-you">
                                        <div class="chat-avatar">
                                            <div class="user-avatar bg-purple">
                                                <img src="{{ $userticket->customer->avatar() }}" alt="">
                                            </div>
                                        </div>
                                        <div class="chat-content">
                                            <div class="chat-bubbles">
                                                <div class="chat-bubble">
                                                    <div class="chat-msg">
                                                        {{ ($answer->answer) }}
                                                    </div>
                                                    @if($answer->attach())
                                                    <a class="no_link" href="{{ route("download",['path'=>$answer->attach()]) }}">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                    @endif
                                                </div>

                                            </div>
                                            <ul class="chat-meta">
                                                <li>
                                                    {{ $userticket->customer->name }}
                                                    {{ $userticket->customer->family }}
                                                </li>
                                                <li>
                                                    {{ jdate($answer->created_at) }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- .chat -->
                                    @else
                                    <div class="chat is-me">
                                        <div class="chat-avatar">
                                            <div class="user-avatar bg-purple">
                                                admin
                                                {{--  <img src="{{ $userticket->customer->avatar() }}" alt="">  --}}
                                            </div>
                                        </div>
                                        <div class="chat-content">
                                            <div class="chat-bubbles">
                                                <div class="chat-bubble">
                                                    <div class="chat-msg">
                                                        {{ ($answer->answer) }}
                                                    </div>
                                                    @if($answer->attach())
                                                    <a class="no_link" href="{{ route("download",['path'=>$answer->attach()]) }}">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                    @endif
                                                </div>

                                            </div>
                                            <ul class="chat-meta">
                                                <li>
                                                    {{ $userticket->customer->name }}
                                                    {{ $userticket->customer->family }}
                                                </li>
                                                <li>
                                                    {{ jdate($answer->created_at) }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="simplebar-placeholder" style="width: auto; height: 815px;"></div>
                </div>
                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                </div>
                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                    <div class="simplebar-scrollbar" style="height: 127px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                </div>
            </div>
            <div class="nk-chat-editor">

                <form class="nk-chat-editor" style="width: 100%" action="{{ route("advertiser.new.answer",$userticket->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                <div class="nk-chat-editor-form">
                    <div class="form-control-wrap">
                        <textarea class="form-control form-control-simple no-resize" rows="1" id="default-textarea" placeholder="پیام خود را تایپ کنید..." name="answer">{{ old("answer") }}</textarea>
                    </div>
                </div>
                <ul class="nk-chat-editor-tools g-2">
                    <li>

                        <label class="btn btn-sm btn-icon btn-trigger text-primary" for="file_select"><i class="fas fa-paperclip"></i>
                            <span class="file_name"></span>

                        </label>
                        <input type="file" id="file_select" name="attach" hidden>

                        {{--  <a href="#" class="btn btn-sm btn-icon btn-trigger text-primary"><em class="icon ni ni-happyf-fill"></em></a>  --}}
                    </li>
                    <li>
                        <button class="btn btn-round btn-primary btn-icon">
                            <em class="icon ni ni-send-alt"></em>
                        </button>
                    </li>
                </ul>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection
