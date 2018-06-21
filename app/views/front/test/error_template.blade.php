@extends('front.layout')



@section('content')

    @include('front.index.slider')

	@include('front.index.company-icons')
    @include('front.index.advert-icons')
    
    @include('front.index.footer-search')
    @include('front.include.right-buttons')
	
	<div class='mess_block false shadow'>
		<div class='mess_title'>Success</div>
		<div class='mess_body'>We will forward you the invoice very soon. Thank you for choosing Zaza.ae!</div>
		<div class='mess_footer'>
			<button class="mess_footer__button shadow">Close</button>
		</div>
	</div>
	
@stop
