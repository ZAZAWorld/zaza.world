@extends('front.layout')
@section('css')
	@parent
    {{ HTML::style('front/charity/slick/slick.css') }}
@endsection

@section('js')
	@parent
	{{ HTML::script('front/charity/slick/slick.min.js') }}
    {{ HTML::script('front/charity/default.js') }}
@endsection



<div id="p_prldr"><div class="contpre"><span class="svg_anm"></span><small>Loading...</small></div></div>

@section('content')
<script>window.isFront=true;</script>
    @include('front.index.slider')
	@include('front.index.company-icons')
    @include('front.index.advert-icons')
    @include('front.index.footer-search')
	
	@include('front.index.advertising_link')
@stop

<style>

</style>