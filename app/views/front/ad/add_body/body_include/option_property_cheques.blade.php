<span class="cheque_ico"></span>
<input name="prop[34]" type="number" class="add_ad_option__inline" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    maxlength = "2" placeholder='{{TransWord::getArabic($props->get(34)->name,false)}}'
    value="{{ (!empty($advert_props) && isset($advert_props[34])) ? $advert_props[34][0] : '' }}" />