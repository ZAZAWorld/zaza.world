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


</style>

    <div class="search_modal open shadow">
        <span class="search_modal__close">X</span>
		<div class='search_modal__top'>
			<h2 class='search_modal__title'>SERACH RESULT FOR <span class='search_modal__sub_title'>(about 10 matches) </span></h2>
			<span class='search_modal__search_word'>Auto car</span>
		</div>
        <div class="search_modal__body">
			<div class='search_modal_item'>
				<a href='#ers' class='search_modal_item__title'> Title in <b>Auto car</b> some textsome textsome textsome text </a> <br/>
				<div class='search_modal_item__about'> 
					<p>About some tex some tex some tex some tex some texin <b>Auto car</b> some textsome textsome textsome text </p>
				</div>
				<div class='search_modal_item_found'> 
					found in: <a href='' class='search_modal_item_found_link'> Auto car->Rent</a>
				</div>
			</div>
			<div class='search_modal_item'>
				<a href='#ers' class='search_modal_item__title'> Title in <b>Auto car</b> some textsome textsome textsome text </a> <br/>
				<div class='search_modal_item__about'> 
					<p>About some tex some tex some tex some tex some texin <b>Auto car</b> some textsome textsome textsome text </p>
				</div>
				<div class='search_modal_item_found'> 
					found in: <a href='' class='search_modal_item_found_link'> Auto car->Rent</a>
				</div>
			</div>
			<div class='search_modal_item'>
				<a href='#ers' class='search_modal_item__title'> Title in <b>Auto car</b> some textsome textsome textsome text </a> <br/>
				<div class='search_modal_item__about'> 
					<p>About some tex some tex some tex some tex some texin <b>Auto car</b> some textsome textsome textsome text </p>
				</div>
				<div class='search_modal_item_found'> 
					found in: <a href='' class='search_modal_item_found_link'> Auto car->Rent</a>
				</div>
			</div>
        </div>
    </div>
	
	