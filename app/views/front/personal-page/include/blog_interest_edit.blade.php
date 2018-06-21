<span class="p_p_interest_block_title">{{ TransWord::getArabic('Interests') }}:</span>
<div class="p_p_interest_block_buttons">
	@foreach ($ar_interest as $k=>$v)
		<div class='p_p_interest_new_block_button_block_hover p_p_interest_new_block_button_block  {{ (isset($person_interest) && is_array($person_interest) && in_array($v->id, $person_interest) ? null : 'unselect') }}' data-id='{{ $v->id }}'>
			<div class='p_p_interest_new_block_button_image_block'>
				<img src="{{ $v->icon }}" class='p_p_interest_new_block_button_image'/>
			</div>
			<button class="p_p_interest_new_block_button" >
				{{TransWord::getArabic($v->name,false)}}
			</button>
		</div>
	@endforeach
</div>