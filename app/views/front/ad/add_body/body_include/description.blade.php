<textarea 
	name='note' 
	class='add_ad_field ' 
	rows="5" 
	placeholder="{{ TransWord::getArabic('Description', true) }}"
	value="{{ !empty($about) ? $about->note : TransWord::getArabic('Description',false) }}">{{ !empty($about) ? $about->note : '' }}</textarea>
    