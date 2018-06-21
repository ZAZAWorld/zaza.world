<div class="comment__title"> {{TransWord::getArabic('Comments')}} ({{SysAdComment::where('element_type_id', 4)->where('element_id', $company->id)->orderBy('id', 'desc')->count()}})</div>
<div class="comment__list">
	@foreach( SysAdComment::where('element_type_id', 4)->where('element_id', $company->id)->orderBy('id', 'desc')->get() as $g )
		<div class="comment__item">
			<a href='{{ action("PersonController@getView",  $g->user_id) }}'>
				<div class="comment__image_block" style="background:#eee url('{{ $g->relUser->photo }}') no-repeat center; background-size: auto 100%;">
					<img class="comment__image" src=""/>
				</div>
			</a>
			<div class="comment__text_block">
				<div class="comment__text">
					{{ $g->note}} 


				</div>
				<div class="comment__name">
					<a href='{{ action("PersonController@getView",  $g->user_id) }}'>{{ $g->name}}</a>

				</div>

				<div class="comment__date">
					{{ $g->created_at}}

					<a href=""> </a>
					@if (Auth::check() && Auth::user()->id == $g->user_id)
									<a href="{{ action('CommentController@getDelete', $g->id) }}" class="">
									   Delete
									</a>
								@endif
				</div>
			</div>
		</div>
	@endforeach
</div>
<div class="comment__add">
	@if (Auth::check())
		<form action="{{ action('CommentController@anyAdd') }}" method='post' enctype="multipart/form-data">
			<input type="text" name="note" class="comment__input" placeholder="{{TransWord::getArabic('Leave your reviews and comments',false)}}..." />
			<input type='hidden' name='element_type_id' value='4'>
			<input type='hidden' name='element_id' value='{{ $company->id }}'>
			<button class="comment__submit" name="submit">
				{{TransWord::getArabic('Submit')}}
			</button>
		</form>
	@else 
		<p>{{TransWord::getArabic('Please',false)}}, <a href="#login" class="js-login">{{TransWord::getArabic('sign in',false)}}</a> {{TransWord::getArabic('in to leave your comment',false)}}</p>
	@endif	
</div>