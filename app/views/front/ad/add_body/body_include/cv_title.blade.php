<input name='title' 
		type="text" 
		class="add_ad_field max40sumbolsValidate" 
		placeholder="{{ TransWord::getArabic('Title for Available vacancy (max 40 symbols)', false) }}" maxlength="40"
        @if (!empty($advert))  value="{{ $advert->title }}" @endif
    />