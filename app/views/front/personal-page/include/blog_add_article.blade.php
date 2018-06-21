@if (count($blog_interest) > 0)
<div class="p_p_add_blog" style="margin:30px 0 40px;">
	<form class="p_p_add_blog__form" action="{{ action('PersonController@postAddArticle') }}" method="post" enctype="multipart/form-data">
		<textarea class="p_p_add_blog__input"   name="about" rows="1" placeholder="{{TransWord::getArabic('Write your post',false)}}"></textarea>
		<input class="p_p_add_blog__file" type="file" name="photo"/>
		<img class="p_p_add_blog__img" src="/front/img/icons/ad_photo_blue_2.png" />
		<input class='p_p_add_blog__interest' type="hidden" name="interest" />
		<input class="p_p_add_blog__submit" type="submit" value="{{TransWord::getArabic('Post',false)}}">
	</form>
	<img src="/upload/article/1477393366_JEdQwiW.jpg" class="js_blog_photo_preview" style="display: none; margin: 10px auto; width: 50px;" />
</div>
@endif

<div class="blog_add_modal">
	<div class="blog_add_modal__content">
		<!--
		{{  Form::select('interest', $blog_interest, null, array('class'=>'add_ad_field', 'id'=>'modal_interest')) }}
		-->
				<select name='interest' class='add_ad_field' id="modal_interest">
				    <option>Select subject</option>
					@foreach ($blog_interest as $k=>$v)
						@if (Input::has('interest') && Input::get('interest') == $k)
							<option value='{{ $k }}' selected>{{ TransWord::getArabic($v, false) }}</option>
						@else 
							<option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
						@endif
					@endforeach
				</select>
				
		<div class="blog_add_modal__bottom">
			<button class="blog_add_modal__cancel">{{TransWord::getArabic('close',false)}}</button>
			<button class="blog_add_modal__ok">{{TransWord::getArabic('ok',false)}}</button>
		</div>
	</div>
</div>