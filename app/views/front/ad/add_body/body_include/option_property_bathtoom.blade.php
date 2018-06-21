<span class="{{ $props->get(28)->icon }} add_ad_option__img">
<input name="prop[28]" type="number" class="add_ad_option__inline" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    maxlength = "2" placeholder='{{TransWord::getArabic($props->get(28)->name,false)}}'
    value="{{ (!empty($advert_props) && isset($advert_props[28])) ? $advert_props[28][0] : '' }}"/>