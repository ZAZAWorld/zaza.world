@section('js')
	@parent
	{{ HTML::script('front/js/advert_edit.js') }}
@endsection
<div class='catalogs'>
	<div class="row ad_normal">
		@forelse ($ads as $ad)
			<div class="advert_wrapper">
				@include('front.ad.ad_template.edit')
			</div>
		@empty
			<p>{{ TransWord::getArabic('Note have any adverts') }}</p>
		@endforelse
	</div>
</div>