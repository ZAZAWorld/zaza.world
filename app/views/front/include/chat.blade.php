<style>
    .main-chat-container {
        display: none;
        width: 480px;
        height: 360px;
        z-index: 999;
        bottom: 160px;
        right: 50px;
        position: fixed;
    }
    .tmp-dialog{
        opacity: 0.9;
    }
    .all-chat-loader-container{
        display: block !important;
        top: 47% !important;
    }
    .chat-container{
        z-index: 10;
    }
    .chat-preloader-container{
        z-index: 9;
    }
    .chat-container, .chat-preloader-container{
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>
<div class="main-chat-container">
<div class="chat-container"></div>
<div class="chat-preloader-container">
    <div class="all-chat-loader-container loader-container"><div class="loader">{{TransWord::getArabic('Loading',false)}}...</div></div>

    <div class="tmp-dialog dialog-container">
        <button class="close">&times;</button>
        <div class="dialog-list-wrapper">
            <div class="search-block">
                <form action="#search" >
                    <input  type="text" name="dialog_search" placeholder="{{ TransWord::getArabic('Search contact or chat',false) }}" >
                </form>
            </div>
            <div class="dialog-list dialogs-scroll-pane scroll-pane-arrows">
            </div>
        </div>
        <div class="message-list-wrapper">
            <div class="dialog-header">
                <div class="user-icon"> <img @if(empty($dialogUserName)) style="display: none" @endif   src="{{ $dialogAvatar or '/front/img/chat/photo.jpg'}}" alt=""> </div>
                <div class="user-name">
                    <p class="user-dialog-name">  </p>
                    <p class="last-visit"></p>
                </div>
            </div>
            <form >
                <input  type="hidden" value="2"/>
                <div class="loader-container"><div class="loader">{{TransWord::getArabic('Loading',false)}}...</div></div>
            </form>
            <div class="dialog-body scroll-pane scroll-pane-arrows">
            </div>
            <div class="dialog-footer">
                <form autocomplete="off">
                    <input name="rand-id" value="" type="hidden" />
                    <input @if(empty($dialogId)) disabled="disabled" @endif type="text" name="content" placeholder="{{ TransWord::getArabic('Type your message',false) }}" >
                    <span></span>
                    <button @if(empty($dialogId)) disabled="disabled" @endif ><img src="/front/img/chat/send_ico_chat.gif" alt="{{ TransWord::getArabic('Send your message',false) }}"></button>
                </form>
                <div class="attach-plus"  @if(empty($dialogId)) style="display: none" @endif >+</div>
                <div class="attach-minus">-</div>
            </div>
        </div>
    </div>

</div>
</div>