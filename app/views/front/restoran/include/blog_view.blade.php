@section('js')
	@parent
	{{ HTML::script('front/js/blog.js') }}
	{{ HTML::script('front/js/restoran_review.js') }}
@endsection

<div class="c-posts">
   <div class="c-posts__header">
	   <h3 class="c-posts__head">{{TransWord::getArabic('Shares & Reviews')}} <strong class="c-posts__count">({{ Blog::where('element_id', $user->id)->count() }})</strong></h3>
   </div>
   <div class="c-posts__form">
		@if (Auth::check())
			<form action="{{ action('CatalogCompanyController@postAddRestoranReview') }}" class="c-addpostform c-addpostform--admin js-form-blog-main" method='post' enctype="multipart/form-data">
			   <div class="c-addpostform__field">
				   <textarea name="note" id="" class="c-addpostform__textarea" placeholder="{{ TransWord::getArabic('Write your review and rate this place...',false) }}"></textarea>
				   <div class="c-addpostform__image js-form-blog-add">
					   <a href="#"><i class="c-addpostform_icon icon-34"></i></a>
				   </div>
				   <input name='image' type="file" class='js-form-blog-file' style="display: none;">
				   <input type='hidden' name='type_id' value='2'>
				   <input type='hidden' name='element_id' value='{{ $user->id }}'>
			   </div>
			   
			   <div style='overflow:hidden'>
					<div class="c-rating" style="width: 50%; float: left;">
					   <div class="c-rating--food">
						   <div class="c-rating__label">{{TransWord::getArabic('Food')}}</div>
						   <div class="c-rating__stars">
								<div class="c-stars__item c-stars--empty js-set-restoran-score" data-score='1'></div>
								<div class="c-stars__item c-stars--empty js-set-restoran-score" data-score='2'></div>
								<div class="c-stars__item c-stars--empty js-set-restoran-score" data-score='3'></div>
								<div class="c-stars__item c-stars--empty js-set-restoran-score" data-score='4'></div>
								<div class="c-stars__item c-stars--empty js-set-restoran-score" data-score='5'></div>
						   </div>
						   <input type='hidden' name='score_food' class='score_val' value='0'>
					   </div>
					   <div class="c-rating--service">
						   <div class="c-rating__label">{{TransWord::getArabic('Service')}}</div>
						   <div class="c-rating__stars">
								<div class="c-stars__item c-stars--empty js-set-restoran-score" data-score='1'></div>
								<div class="c-stars__item c-stars--empty js-set-restoran-score" data-score='2'></div>
								<div class="c-stars__item c-stars--empty js-set-restoran-score" data-score='3'></div>
								<div class="c-stars__item c-stars--empty js-set-restoran-score" data-score='4'></div>
								<div class="c-stars__item c-stars--empty js-set-restoran-score" data-score='5'></div>
						   </div>
						   <input type='hidden' name='score_service' class='score_val' value='0'>
					   </div>
					   <div class="c-rating--city">
						   <div class="c-rating__label">{{TransWord::getArabic('Interior')}}</div>
						   <div class="c-rating__stars">
								<div class="c-stars__item c-stars--empty js-set-restoran-score" data-score='1'></div>
								<div class="c-stars__item c-stars--empty js-set-restoran-score" data-score='2'></div>
								<div class="c-stars__item c-stars--empty js-set-restoran-score" data-score='3'></div>
								<div class="c-stars__item c-stars--empty js-set-restoran-score" data-score='4'></div>
								<div class="c-stars__item c-stars--empty js-set-restoran-score" data-score='5'></div>
						   </div>
						   <input type='hidden' name='score_interior' class='score_val' value='0'>
					   </div>
					</div> 
					<div class="c-addpostform__submit" style=" float: right;">
						<input type="submit" class="c-button c-button--red" value="{{TransWord::getArabic('Post',false)}}">
					</div>
				</div>
		   </form>
		   
			<img src="/upload/company/1477891958_pkLnrcl.jpg" class="js_blog_photo_preview" style="display: none; margin: 10px auto; width: 50px;">
		@else 
			<p>{{TransWord::getArabic('Please',false)}}, <a href="#login" class="js-login">{{TransWord::getArabic('sign in',false)}}</a> {{TransWord::getArabic('to leave your comment',false)}}</p>
		@endif
   </div>
   <div class="c-posts__list">
		@foreach ($blog as $b)
			@include('front.blog.article')
		@endforeach
	</div>
   <div class="c-pagination">
		{{ $blog->links() }}
   </div>
</div>