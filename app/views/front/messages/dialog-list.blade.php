@if(!empty($dialogs))
    @forelse ( $dialogs as $dialog )
    <div class="dialog {{ $dialogId==$dialog->dialog_id ? 'active' : '' }}" data-id="{{{ $dialog->dialog_id }}}">
        <div class="user-icon"><img src="@if($dialog->person_photo){{$dialog->person_photo}}@elseif($dialog->photo){{ $dialog->photo }}@else{{ '/front/img/chat/photo.jpg'}}@endif" alt="{{{ $dialog->f_name.' '.$dialog->l_name }}}"></div>
        <div class="user-name">
            <span class="name">@if($dialog->f_name or $dialog->l_name) {{{ $dialog->f_name.' '.$dialog->l_name }}} @else {{{ $dialog->title }}} @endif</span>
            @if($dialog->count)
                <span class="new-message">{{{ $dialog->count }}}</span>
            @endif
        </div>
    </div>
    @empty
    @endforelse
@endif
@if(!empty($users))
    @foreach( $users as $user )
    <div class="dialog" data-id="{{{ $user->id }}}"  data-is-user="1">
        <div class="user-icon">
            <img src="@if($user->person_photo) {{ $user->person_photo }} @elseif($user->photo) {{ $user->photo }} @else {{'/front/img/chat/photo.jpg'}} @endif" alt="{{{ $user->f_name.' '.$user->l_name }}}"></div>
        <div class="user-name">
            <span class="name">@if($user->f_name or $user->l_name){{{$user->f_name.' '.$user->l_name}}}@else{{{$user->title}}}@endif</span>
        </div>
    </div>
    @endforeach
@endif