@section('js')
	@parent
	{{ HTML::script('front/js/advert_edit.js') }}
@endsection
<div class='catalogs'>
    <?php
    $all_ads_ids = Advert::where('user_id', $user->id)->orderBy('id', 'desc')->lists('id');
    ?>
	@forelse (Advert::where('user_id', $user->id)->orderBy('id', 'desc')->get() as $ad)
		<div class="advert_wrapper">
			@include('front.ad.ad_template.edit')
		</div>
	@empty
		@if (isset($is_owner) && $is_owner)
			<p>{{ TransWord::getArabic('Goods and Services will appear after sharing ad about it') }}</p>
		@else 
			<p>{{ TransWord::getArabic('Goods and Services not shared yet') }}</p>
		@endif
	@endforelse

</div>