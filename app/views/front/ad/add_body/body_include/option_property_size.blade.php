<span class="{{ $props->get(27)->icon }} add_ad_option__img">
<!--
	<input name="prop[27]" type="text" class="add_ad_option__inline" placeholder='{{$props->get(27)->name}}' />
-->
<input name="prop[27]" type="number" class="add_ad_option__inline add_ad_field " oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    maxlength = "6" placeholder="{{TransWord::getArabic('Size (ft2) *',false)}}"
    value="{{ (!empty($advert_props) && isset($advert_props[27])) ? $advert_props[27][0] : '' }}" />