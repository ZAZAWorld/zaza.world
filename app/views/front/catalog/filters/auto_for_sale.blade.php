{{ Form::open(array('url'=>action('CatalogAdController@getIndex', $cat->id), 'method' => 'get', 'role'=>'form')) }}
<div class='ad_filter shadow open'>
	@include('front.catalog.filters.include.head')
	<div class='ad_filter_body'>
        @include('front.catalog.filters.ajax.'.$tpl)
	</div>
	@include('front.catalog.filters.include.sort')
	@include('front.catalog.filters.include.switch')
	
</div>
{{ Form::hidden('filter', 1) }}
{{ Form::close() }}
