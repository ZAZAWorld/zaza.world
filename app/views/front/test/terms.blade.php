@extends('front.layout')
@section('content')

    @include('front.index.slider')

	@include('front.index.company-icons')
    @include('front.index.advert-icons')
	
	
	<div class='modal_terms  open'>
		<div class='modal_terms_bg js_call_modal_terms'> </div>
		<div class='modal_terms_body shadow'>
			<div class='modal_terms_close js_call_modal_terms'>x</div>
			<div class='modal_terms_title'>Terms & condition</div>
			<p>asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd</p>
			<p>asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd</p>
			<p>asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd</p>
		</div>
	</div>
	
	<style>
		.modal_terms {
			position: absolute;
			z-index: 9999999999999999999;
			width: 100%;
			top: 0;
			height: 4000px;
			display: none;
		}
		.modal_terms.open {
			display: block;
		}
		.modal_terms_bg{
			position: absolute;
			width: 100%;
			height: 4000px;
			top: 0;
		}
		.modal_terms_body{
			width: 40%;
			position: relative;
			margin: 100px auto;
			background: #fff;
			border-radius: 15px;
			padding: 15px 10px;
		}
		.modal_terms_close{
			position: absolute;
			top: -6px;
			right: -8px;
			font-size: 16px;
			background: #d41f26;
			color: #fff;
			cursor: pointer;
			border-radius: 50%;
			padding: 2px 7px 2px 7px;
		}
		.modal_terms_title{
			
		}
	</style>
	
@stop
