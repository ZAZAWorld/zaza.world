<div class="dialog-container">
    <button class="close">&times;</button>
    <div class="dialog-list-wrapper">
        <div class="search-block">
            <form id="search-form" action="#search" >
                <input id="dialog-search" type="text" name="dialog_search" placeholder="{{{ TransWord::getArabic('Search contact or chat') }}}" >
            </form>
        </div>
        <div class="dialog-list dialogs-scroll-pane scroll-pane-arrows">
            @include('front.messages.dialog-list', array('dialogs'=>$dialogs))
        </div>
    </div>
    <div class="message-list-wrapper">
        <div class="dialog-header">
            <div class="user-icon"> <img @if(empty($dialogUserName)) style="display: none" @endif   src="{{ $dialogAvatar or '/front/img/chat/photo.jpg'}}" alt=""> </div>
            <div class="user-name">
                <p class="user-dialog-name"> @if($dialogUserName) {{{ $dialogUserName }}}  @endif </p>
                <p class="last-visit"></p>
            </div>
        </div>
        <form id="messages-pagination">
            <input id="paginator-input" type="hidden" value="2"/>
            <div class="loader-container"><div class="loader">Loading...</div></div>
        </form>
        <div class="dialog-body scroll-pane scroll-pane-arrows">
            @include('front.messages.message-list', array('messages'=>$messages,'me'=>$me))
        </div>
        <div class="dialog-footer">
            <form id="send-form" class="send-form" autocomplete="off">
                <input id="dialog_id" name="dialog_id" value="{{{$dialogId}}}" type="hidden"/>
                <input id="rand-id" name="rand-id" value="" type="hidden" />
                <input @if(empty($dialogId)) disabled="disabled" @endif type="text" id="message-content" name="content" placeholder="{{{ TransWord::getArabic('Type your message') }}}" >
                <span id="upload-file-name"></span>
                <button id="send-btn" @if(empty($dialogId)) disabled="disabled" @endif ><img src="/front/img/chat/send_ico_chat.gif" alt="{{{ TransWord::getArabic('Send your message') }}}"></button>
                <input  class="attachment" max-size="5120" type="file" name="attachment" />
            </form>
            <div class="attach-plus"  @if(empty($dialogId)) style="display: none" @endif >+</div>
            <div class="attach-minus">-</div>
        </div>
    </div>
</div>
