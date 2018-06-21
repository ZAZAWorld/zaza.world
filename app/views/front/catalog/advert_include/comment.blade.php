<span class="ad_comments__title"><strong>{{TransWord::getArabic('Comments')}}</strong> ({{ SysAdComment::where('element_type_id', 5)->where('element_id', $advert->id)->orderBy('id', 'desc')->count() }})</span>
<div class="ad_comments__lists" data-simplebar-direction="vertical">
	@foreach( SysAdComment::where('element_type_id', 5)->where('parent_id', 0)->where('element_id', $advert->id)->orderBy('id', 'desc')->get() as $g )
		<div class="ad_comment">
			<a href='{{ action("PersonController@getView",  $g->user_id) }}'>
				<div class="ad_comment__image" style="background:url('{{ $g->relUser->photo }}')no-repeat center center; background-size:cover;">
					
				</div>
			</a>
			<div class="ad_comment__text_block">
				<div class="ad_comment__title">
					<a href='{{ action("PersonController@getView",  $g->user_id) }}'>{{ $g->name}}</a>
				</div>
				<div class="ad_comment__text">
				   {{ $g->note}}
				</div>
				<div class="ad_comment__bottom">
					<span class="ad_comment__bottom__date">{{ $g->created_at}}</span>
					<a href='#ad' class='js-reply-comment' data-user-name="{{ $g->name }}" data-note='{{ $g->note_short }}' data-id='{{ $g->id }}'> 
						<span style="color:#dd2c00;">{{TransWord::getArabic('Reply')}}</span> 
					</a>
					@if (Auth::check() && Auth::user()->id == $g->user_id)
									<a href="{{ action('CommentController@getDelete', $g->id) }}" class="">
									   ✖
									</a>
								@endif
				</div>
			</div>
		</div>
		@if ($g->relChilds->count() > 0)
			@foreach ($g->relChilds as $ch) 
				<div class="ad_comment" style='margin-left: 20px;'>
					<div class="ad_comment__image" style="background:url('{{ $ch->relUser->photo }}')no-repeat center center; background-size:cover;">
						
					</div>
					<div class="ad_comment__text_block">
						<div class="ad_comment__title">
							<a href='{{ action("PersonController@getView",  $ch->user_id) }}'>{{ $ch->name}}</a>
						</div>
						<div class="ad_comment__text">
						   {{ $ch->note}}
						</div>
						<div class="ad_comment__bottom">
							<span class="ad_comment__bottom__date">{{ $ch->created_at}}</span>
						</div>
					</div>
				</div>
			@endforeach	
		@endif
	@endforeach	
</div>
@if (Auth::check())
	<br />
	<form action="{{ action('CommentController@anyAdd') }}" class="c-reviews-form js-reply-comment-block" method='post' enctype="multipart/form-data" style="font-size:12px;">
		<div class="c-reviews-form__field ad_field">
			<textarea class="c-textarea" placeholder="{{TransWord::getArabic('Leave your comment here',false)}}..." name="note"></textarea>
		</div>
		<input type='hidden' name='element_type_id' value='5'>
		<input type='hidden' name='element_id' value='{{ $advert->id }}'>
		<div class="c-reviews-form__submit ad_submit">
			<button class="c-button-ad c-button-blue" name="submit" style="float:right;"><i class="c-icon icon-56"></i> <span>{{TransWord::getArabic('Submit')}}</span></button>
		</div>
	</form>
@else 
	<p>{{TransWord::getArabic('Please')}}, <a href="#login" class="js-login">{{TransWord::getArabic('sign in')}}</a> {{TransWord::getArabic('to leave your comment')}}</p>
@endif