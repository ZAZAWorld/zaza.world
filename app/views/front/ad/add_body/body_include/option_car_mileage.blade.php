<span class="icon-46 add_ad_option__img"></span>
<input name="prop[8]" type="number" class="add_ad_option__inline" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
 value="{{ (!empty($advert_props) && isset($advert_props[8])) ? $advert_props[8][0] : '' }}"   maxlength = "6"  placeholder='{{ TransWord::getArabic('Mileage',false) }}' />
