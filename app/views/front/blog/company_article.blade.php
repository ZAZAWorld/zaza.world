<article class="c-post">
	@if( $b->photo != '')
		<div class="c-post__cover" style="background:#fff url('{{ $b->photo }}') no-repeat center; border:1px solid #eee; background-size: contain;">
		</div>
	@else 
		<div class="c-post__cover" style="background:#fff; border:1px solid #eee; border-bottom:none; height: 40px !important;">
		</div>
	@endif
   <div class="l-grid-noGutter-top-1">
	   <div class="l-grid__col-3_sm-3_xs-3">
		   <div class="c-postauthor">
			   <div class="c-postauthor__inner">
					<a href='{{ action("PersonController@getView",  $b->user_id) }}'>
					   <div class="c-postauthor__image" style="background:#eee url('{{ $b->relUser->getPhoto(); }}') no-repeat center; background-size: auto 100%;" data-id="{{ $b->id }}"></div>
					   <div class="c-postauthor__firstname">
							{{ $b->relUser->full_name }}
					   </div>
					</a>
			   </div>
		   </div>
	   </div>

	   <div class="l-grid__col-9_sm-9_xs-9">
		   <div class="c-post__body" data-id="{{ $b->id }}">
			   <div class="c-post__text" data-id="{{ $b->id }}">
					{{ $b->note }}
			   </div>
			   <div class="c-post__meta">
				   <div class="l-grid-noGutter-middle_sm-1">
					   <div class="l-grid__col-3_xs-4">
						   <div class="c-post__date">
							   <div class="c-postdate">
								   <i class="c-postdate__icon icon-35"></i>
								   <span class="c-postdate__text">{{ $b->created_at }}</span>
							   </div>

						   </div>
					   </div>
					   <!-- comment -->
					   <div class="l-grid__col-3">
						   <div class="c-post__comments">
							   <div class="c-postcomments">
								   <i class="c-postcomments__icon icon-20"></i>
								   <span class="c-postcomments__count">{{ SysAdComment::where('element_type_id', 8)->where('element_id', $b->id)->orderBy('id', 'desc')->count() }}</span>
							   </div>
						   </div>

					   </div>
					   
					   <!-- comment
					   <div class="l-grid__col-6_xs-5">
						   <div class="c-post__share">
							   <a href="#add_share" class="c-postshare" data-id='{{ $b->id }}'>
								   <i class="c-postshare__icon icon-1222"></i>
								   <span class="c-postshare__text">{{TransWord::getArabic('share')}}</span>
							   </a>
						   </div>
					   </div>
					    -->
				   </div>
			   </div>
		   </div>
	   </div>
   </div>
	
	<div class="blog_comments">
		<div class="blog_comments_content">
			@foreach( SysAdComment::where('element_type_id', 8)->where('parent_id', 0)->where('element_id', $b->id)->orderBy('id', 'desc')->get() as $g )
				<div class="c-reviews-list__item">
					<div class="l-grid-noGutter">
						<div class="l-grid__col-2_xs-4_sm-3">
							<div class="c-reviews-autor">
								<a href='{{ action("PersonController@getView",  $g->user_id) }}'>
									<img src="{{ $g->relUser->photo }}" alt="" width="100"
									style="width: 50px; height: 50px; border-radius: 30px;">
								<a>
							</div>
						</div>
						<div class="l-grid__col-10_xs-8_sm-9">
							<div>
								<p>
									<strong>
										<span>
											<a href='{{ action("PersonController@getView",  $g->user_id) }}' class="comment_avtor">
												{{ $g->name}}
											</a>
										</span>
									</strong>  &nbsp;
									{{ $g->note}} 
								</p>
							</div>
							<div class="c-reviews-createdon">
								{{ $g->created_at}} 
								<a href='#ad' class='js-reply-comment' style="text-decoration:none;" data-user-name="{{ $g->name }}" data-note='{{ $g->note_short }}' data-id='{{ $g->id }}'> 
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
				</div>
				<div class="clear"></div>

				@if ($g->relChilds->count() > 0)
					@foreach ($g->relChilds as $ch) 
						<div class="c-reviews-list__item" style=" width: 90%; margin-left: 10%;">
							<div class="l-grid-noGutter">
								<div class="l-grid__col-2_xs-4_sm-3">
									<div class="c-reviews-autor">
										<img src="{{ $ch->relUser->photo }}" alt="" width="100"
										style="width: 50px; height: 50px; border-radius: 30px;">
									</div>
								</div>
								<div class="l-grid__col-10_xs-8_sm-9">
									<div>
										<p>
											<strong>
												<span>
													<a href='{{ action("PersonController@getView",  $ch->user_id) }}' class="comment_avtor">
														{{ $ch->name}}
													</a>
												</span>
											</strong>  &nbsp;
											{{ $ch->note}} 
										</p>
									</div>
									<div class="c-reviews-createdon">
										{{ $g->created_at}} 
										@if (Auth::check() && Auth::user()->id == $ch->user_id)
											<a href="{{ action('CommentController@getDelete', $ch->id) }}" class="">
											   ✖
											</a>
										@endif
									</div>
								</div>
							</div>
						</div>
						<div class="clear"></div>
						
					@endforeach
				@endif
			@endforeach	
		</div>	
		<div class="blog_comments_submit_form">	
			@if (Auth::check())
				<form action="{{ action('CommentController@anyAdd') }}" class="c-reviews-form js-reply-comment-block" method='post' enctype="multipart/form-data">
					<div class="c-reviews-form__field_bar">
						<div class="p_p_add_blog"><textarea name="note" id="" cols="" rows="" placeholder="{{TransWord::getArabic('Leave your comment here',false)}} ..." class="c-textarea"></textarea></div>
					</div>
					<input type='hidden' name='element_type_id' value='8'>
					<input type='hidden' name='element_id' value='{{ $b->id }}'>
					<div class="c-reviews-form__submit_bar">
						<button class="c-button c-button-blue" name="submit"><i class="c-icon icon-56"></i> <span>{{TransWord::getArabic('Submit')}}</span></button>
					</div>
				</form>
			@else 
				<p>{{TransWord::getArabic('Please')}}, <a href="#login" class="js-login">{{TransWord::getArabic('sign in') }}</a> {{TransWord::getArabic('in to leave your comment')}}</p>
			@endif
			<div class="clear"></div>
		</div>
		<br/>
	</div>

   <div class="c-postmore">
	   <span class="c-postmore__link">
		   <i class="c-postmore__icon"></i>
	   </span>
   </div>
</article>