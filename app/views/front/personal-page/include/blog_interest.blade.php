<span class="p_p_interest_block_title">{{TransWord::getArabic('Interests')}}:</span>
<div class="p_p_interest_block_buttons">
	@foreach ($ar_interest as $k=>$v)
		<div class='p_p_interest_new_block_button_block'>
			<div class='p_p_interest_new_block_button_image_block'>
				<img src="{{ $v->icon }}" class='p_p_interest_new_block_button_image'/>
			</div>
			<button class="p_p_interest_new_block_button">
				{{TransWord::getArabic($v->name,false)}}
			</button>
		</div>
	@endforeach
</div>