<span class="{{ $props->get(29)->icon }} add_ad_option__img">
<input name="prop[29]" type="number" class="add_ad_option__inline"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    maxlength = "2" placeholder="{{TransWord::getArabic($props->get(29)->name,false)}}"
    value="{{ (!empty($advert_props) && isset($advert_props[29])) ? $advert_props[29][0] : '' }}" />