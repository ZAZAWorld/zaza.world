{{--
<div class="map-tooltip">
    <img src="{{{$item->photo}}}" alt="{{{$item->title}}}"/>
    <p>{{{$item->title}}}</p>
    <p>About: {{{$item->more_info}}}</p>
    <p>Phones: {{{$item->mobile}}}</p>
    <p>Email: {{{$item->relUser->email}}}</p>
    <a href="/catalog-company/index/{{{$item->id}}}">Show More</a>
</div>
--}}

<div class="map-tooltip">
	<div class="advert">
		<a href="/catalog-company/index/{{{$item->id}}}" class="advert__link" target="_blank">
			<div class="advert__image-block" style="background:#eee url('{{{$item->photo}}}') no-repeat center center; background-size: contain;">
			</div>
			<div class="advert__text-block">
				<h3 class="advert__title">{{{$item->title}}}</h3>
			</div>
		</a>
	</div>
</div>