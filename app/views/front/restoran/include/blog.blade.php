@section('js')
	@parent
	{{ HTML::script('front/js/blog.js') }}
@endsection

<div class="c-posts">
   <div class="c-posts__header">
	   <h3 class="c-posts__head">{{TransWord::getArabic('Shares & Reviews')}} <strong class="c-posts__count">({{ Blog::where('element_id', $user->id)->count() }})</strong></h3>
   </div>
   <div class="c-posts__form">
	   <form action="{{ action('BlogController@postAdd') }}" class="c-addpostform c-addpostform--admin js-form-blog-main" method='post' enctype="multipart/form-data">
		   <div class="c-addpostform__field">
			   <textarea name="note" id="" class="c-addpostform__textarea js-form-blog-note" placeholder="{{TransWord::getArabic('Write your post ...',false)}}"></textarea>
			   <div class="c-addpostform__image js-form-blog-add">
				   <a href="#"><i class="c-addpostform_icon icon-34"></i></a>
			   </div>
			   <input name='image' type="file" class='js-form-blog-file' style="display: none;">
			   <input type='hidden' name='type_id' value='2'>
			   <input type='hidden' name='element_id' value='{{ $user->id }}'>
			   <div class="c-addpostform__submit">
					<input type="submit" class="c-button c-button--red" value="{{TransWord::getArabic('Post',false)}}">
			   </div>
		   </div>
	   </form>
	   <img src="/upload/company/1477891958_pkLnrcl.jpg" class="js_blog_photo_preview" style="display: none; margin: 10px auto; width: 50px;">
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