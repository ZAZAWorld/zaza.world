<input name='title' 
		type="text" 
		class="add_ad_field" 
		placeholder="{{TransWord::getArabic('Full name  (max 40 symbols)',false)}}" maxlength="40"
        @if (!empty($advert))  value="{{ $advert->title }}" @endif
    />