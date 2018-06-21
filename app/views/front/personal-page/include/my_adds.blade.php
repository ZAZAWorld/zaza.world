@section('js')
	@parent
	{{ HTML::script('front/js/advert_edit.js') }}
@endsection

<div class='catalogs'>
	@forelse ($my_adds as $ad)
		<div class="advert_wrapper">
			@include('front.ad.ad_template.edit')
		</div>
	@empty
		<p>{{ TransWord::getArabic('You have not placed any ad') }}</p>
	@endforelse
</div>