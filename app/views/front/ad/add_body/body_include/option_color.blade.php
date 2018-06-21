<div style=' background: #f3f3f3;
    overflow: hidden;
    padding: 1px 0 9px 0;'>
	<span class="icon-71 add_ad_option__img" style='float: left;'></span>
	<!--
	<select name="prop[15]" class="add_ad_option__inline">
		@foreach ($props->get(15)->relPropOption as $option)
			<option value="{{ $option->id }}">{{TransWord::getArabic($option->name,false)}}</option>
		@endforeach
	</select>
	-->
	@foreach ($props->get(15)->relPropOption as $option)
		<span class='js_add_ad_color_option {{ $option->name }}-{{ $option->id }} {{ (!empty($advert_props) && isset($advert_props[15]) && in_array($option->id, $advert_props[15])) ? 'open' : '' }}' style='background-color: {{ $option->name }};' data-id='{{ $option->id }}'>&nbsp;</span>
	@endforeach
	<input type='hidden' name='prop[15]' class='js_add_ad_color_value' value="{{ !empty($advert_props) && isset($advert_props[15])  ? $advert_props[15][0] : '' }}">
</div>

<style>
.js_add_ad_color_option {
	height: 16px;
    width: 16px;
    display: block;
    border-radius: 50%;
    cursor: pointer;
    float: left;
    margin: 2px 3px;
    position: relative;
    top: 4px;
    border: 2px solid transparent;
}
.js_add_ad_color_option:hover, .js_add_ad_color_option.open{
	border: 2px solid blue;
}
</style>