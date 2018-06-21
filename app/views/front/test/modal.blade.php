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


@section('content')

    @include('front.index.slider')

	@include('front.index.company-icons')
    @include('front.index.advert-icons')
    
    @include('front.index.footer-search')
    @include('front.include.right-buttons')
	
@stop

<style>


.c-avd-modal {
  padding-left: 15px;
  padding-right: 15px;
  position: fixed;
  z-index: 999;
  padding-top: 200px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto; }
  .c-avd-modal .c-avd-modal-inner {
    position: relative;
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
    background: #fff;
    box-shadow: 0px 0px 10px #ccc;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    -ms-border-radius: 4px;
    border-radius: 4px; }
    .c-avd-modal .c-avd-modal-inner .c-avd-modal__header {
      background-color: #8bc34a;
      color: #ffffff; }
  .c-avd-modal .c-avd-modal__head {
    padding: 13px;
    line-height: 1em;
    text-align: center;
    font-size: 1.3em; }
  .c-avd-modal .c-avd-modal__body {
    padding: 35px; }
    @media (max-width: 768px) {
      .c-avd-modal .c-avd-modal__body {
        padding: 20px; } }
    @media (max-width: 568px) {
      .c-avd-modal .c-avd-modal__body {
        padding: 15px; } }
  .c-avd-modal .c-avd-modal__close {
    position: absolute;
    right: -10px;
    top: -10px;
    color: #ffffff;
    background: #d41f26;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    border-radius: 50%;
    display: block;
    width: 20px;
    height: 20px;
    text-align: center;
    font-size: 1.1em;
    padding: 0px 1px 1px 0px;
    border: 1px solid #d41f26;
    cursor: pointer; }
    .c-avd-modal .c-avd-modal__close:hover {
      background: #ffffff;
      color: #d41f26; }
  .c-avd-modal .c-avd-modal__message {
    font-weight: bold;
    font-size: 1.1em;
    margin-bottom: 20px; }
  .c-avd-modal .c-avd-modal__app {
    font-size: 1.1em;
    margin-bottom: 20px; }
    .c-avd-modal .c-avd-modal__app span {
      font-weight: bold; }
  .c-avd-modal .c-avd-modal__close--button {
    text-align: center; }
    .c-avd-modal .c-avd-modal__close--button .c-button {
      padding-left: 40px;
      padding-right: 40px; }

	  
.c-button {
  display: inline-block;
  padding: 6px 12px;
  margin-bottom: 0;
  font-size: 1em;
  font-weight: 400;
  line-height: 1.42857143;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  -ms-touch-action: manipulation;
  touch-action: manipulation;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  background-image: none;
  border: 1px solid transparent;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  -ms-border-radius: 5px;
  border-radius: 5px;
  text-decoration: none;
  color: #263238;
  font-family: 'Open Sans', sans-serif; }
  .c-button.c-button--green {
    color: #ffffff;
    background: #568b3e;
    border-color: #568b3e; }
    .c-button.c-button--green:hover {
      background: #ffffff;
      color: #568b3e; }
  .c-button.c-button--lightgreen {
    color: #ffffff;
    background: #8bc34a;
    border-color: #8bc34a; }
    .c-button.c-button--lightgreen:hover {
      background: #ffffff;
      color: #8bc34a; }

</style>

<div class="c-avd-modal js-modal-close-mess-ad">
	<div class="c-avd-modal-inner">
		<div class="c-avd-modal__header">
			<h4 class="c-avd-modal__head">
				Your application has been submitted!
			</h4>
		</div>
		<div class="c-avd-modal__body">
			<div class="c-avd-modal__message">
				We will forward you the invoice very soon.
				Thank you for choosing Zaza.ae!
			</div>
			<div class="c-avd-modal__app">
				Your application <span>¹BA00001</span>
			</div>
			<div class="c-avd-modal__close--button">
				<div class="c-button c-button--lightgreen js-close-mess-ad">Close</div>
			</div>

		</div>
		<a class="c-avd-modal__close js-close-mess-ad">
			<i class="icon-52"></i>
		</a>
	</div>
</div>

	
	