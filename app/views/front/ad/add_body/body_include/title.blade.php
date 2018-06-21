<input name='title' 
		type="text" 
		class="add_ad_field max40sumbolsValidate" 
		placeholder="{{ TransWord::getArabic('Short title of your ad (max 40 symbols)', false) }}" maxlength="40"
        @if (!empty($advert))  value="{{ $advert->title }}" @endif
    />