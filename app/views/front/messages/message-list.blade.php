@for ( $i=count($messages)-1; $i >= 0; $i-- )
<div class="message {{ $messages[$i]->user_id == $me ?'my':'';}}">
    {{{ $messages[$i]->content }}}
    @if($messages[$i]->attachment_path)
    <br/> <span class="attachment-link" >
            <a href="/uploads/{{{ $messages[$i]->attachment_path }}}"
               download="{{{ $messages[$i]->attachment_real_name }}}">
                {{{ $messages[$i]->attachment_real_name }}}
            </a>
          </span>
    @endif
    <span class="time">
        @if( strtotime($messages[$i]->datetime) > strtotime(date('Y-m-d 0:0:0')) )
            {{ date('H:i',strtotime($messages[$i]->datetime)) }}
        @else
            {{ date('d M',strtotime($messages[$i]->datetime)) }}
        @endif
    </span>
</div>
@endfor
