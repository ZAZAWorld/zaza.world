<div class='catalogs'>
	@forelse ($my_like as $ad)
		@include('front.ad.ad_template.view')
	@empty
		<p>{{ TransWord::getArabic('You have no liked ads') }}</p>
	@endforelse
</div>