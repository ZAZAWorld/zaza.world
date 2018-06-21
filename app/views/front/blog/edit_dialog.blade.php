<form action="{{ action('BlogController@postUpdate') }}"  method='post' >
<div class='blog_dialog_edit open shadow'>
	<span class="blog_dialog_edit__close">x</span>
	<div class='blog_dialog_edit__body'>
		<h3 class='blog_dialog_edit__title'>{{TransWord::getArabic('Edit blog')}}</h3>
		<div class='row'>
			<div class='col-md-15 blog_dialog_edit__label'>{{TransWord::getArabic('Photo')}}</div>
			<div class='col-md-85'>
				<div class='blog_dialog_edit_photo__square'>
					<img src="{{ $blog->photo }}" class="blog_dialog_edit_photo__image">
					<span class='blog_dialog_edit_photo__add'>+</span>
				</div>
				<input class="blog_dialog_edit_photo__file" type="file" >
				<input type='hidden' class='blog_dialog_edit_photo__value' name='photo' value='{{ $blog->photo }}'>
				<input type='hidden' name='blog_id' value='{{ $blog->id }}'>
			</div>
		</div>
		<div class='row'>
			<div class='col-md-15 blog_dialog_edit__label'>{{TransWord::getArabic('Text')}}</div>
			<div class='col-md-85'>
				<textarea class="blog_dialog_edit__text" rows="4" name='note'>{{ $blog->note }}</textarea>
			</div>
		</div>
	</div>
	<div class='blog_dialog_edit_bottom'>
		<button class="blog_dialog_edit__cancel" type="button">{{TransWord::getArabic('Cancel')}}</button>
		<button class="blog_dialog_edit__submit" type="submit">{{TransWord::getArabic('Save')}}</button>
	</div>
</div>
</form>