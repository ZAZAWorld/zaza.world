@extends('front.layout')
@section('js')
	@parent
	{{ HTML::script('front/js/autoresize.jquery.js') }}
	{{ HTML::script('front/js/cabinet.js') }}
	{{ HTML::script('front/js/blog.js') }}
@endsection

@section('content')
<script>
    window.isFront = true;
</script>
<div class="p_title">
	<div class="p_conteiner">
		<!---- Person name.-------->
		<div class="l-grid-noGutter">
			<div class="l-grid__col-9_lg-9_md-6_sm-6">
				<h1 class="c-description__name">
					{{ $personal->full_name }}
				</h1>
			</div>
			<div class="l-grid__col-3_lg-3_md-6_sm-6">
			<!---- Chat link.-------->
				<div class="p_title__button p_title__button__chat js-open-chat" data-user-id="{{ $personal->user_id }}">
					<i class="icon-11 c-chat__icon"></i>
					<span class="p_title__button__chat__text">{{ TransWord::getArabic('Chat') }}</span>
				</div>
				
				<!---- User last visit.-------->
				@if ($user->checkUserOnlain())
					<div class="p_title__button p_title__button__onlain active">
						<span class='p_title__button__onlain__circle'>&nbsp;</span>
						{{ TransWord::getArabic('Online' )}}
					</div>
				@else
					<div class="p_title__button p_title__button__onlain">
						<span class='p_title__button__onlain__circle'>&nbsp;</span>
						<span style='display: inline-block; margin: -5px 0 0 0;'>{{ TransWord::getArabic('Last visit on' )}} <br />
						{{ $user->last_visit_view }}</span>
					</div>
				@endif
			</div>
				
		
		<div class="l-grid__col-4_lg-4_md-9_sm-12">
			<div class="l-grid-noGutter-middle_sm-12">
		
				
		
			</div>
		</div>
		
	</div>
</div>
</div>
	
<div class="p_personal">
	<div class="p_personal__left">
		<!---- Person info.-------->
		<div class="p_personal__left_block">
			@if( $personal->photo != '')
				<div class="p_p_logo js_logo" style="background:url('{{ $personal->photo }}') no-repeat center center; background-size:cover;">
                </div>
			@else 
				<div class="p_p_logo js_logo" style="background:url('/images/no_name.png') no-repeat center; background-size: cover;">
				</div>
			@endif
	
			<div class="p_p_location">
				<img src="/front/img/icons/location_blue.png"> {{ $user->location }}
			</div>
		</div>
		<div class="p_personal__left_block">
			<div class="p_p_about">
				<span class="p_p_about__title"> {{ TransWord::getArabic('About me') }} </span>
				{{ $personal->about }}
			</div>
		</div>
		
		<!---- Person contacts.-------->
		<div class="p_personal__left_block">
			<div class="p_p_phones">
				<a href="tel:{{ $personal->phone }}"><img src='/front/img/icons/photo.png' /> {{ $personal->phone }}</a> <br/>
				<a href="tel:{{ $personal->mobile }}"><img src='/front/img/icons/mobile.png' /> {{ $personal->mobile }}</a> <br/>
				<a href="mailto:{{ $user->email }}"><img src='/front/images/c-sidebar__mail.png' width="12px" /> {{ $user->email }}</a>
			</div>
		</div>
		
		<!---- Social links.-------->
		<div class="p_personal__left_block">
			@include('front.personal-page.include.social_link')
		</div>
		
		<!---- Company likes.-------->
		<div class="p_personal__left_tab">
			@include('front.personal-page.include.company_likes')
		</div>
	</div>
	
	<!---- Blog.-------->
	<div class="p_personal__content">
		<!---- Blog interest. -------->
		<div class="p_p_interest_block">
			@include('front.personal-page.include.blog_interest')
		</div>
		
		<!---- Blog articles. -------->
		<div class="p_p_contents">
			@forelse ($blogs as $b)
				@if (Auth::user() && $b->user_id == Auth::user()->id)
					@include('front.personal-page.include.blog_edit')
				@else 
					@include('front.personal-page.include.blog')
				@endif
			@empty
				@if (Auth::user())
					 @if (Auth::user()->id == $personal->user_id)
                         @if (Auth::user() && PersonInterest::where('person_id', $personal->id)->count() > 0)
					     <p></p>
				         @else
				         <p>{{ TransWord::getArabic('Please') }} <a href="/personal-cabinet/update">{{ TransWord::getArabic('click here') }}</a> {{ TransWord::getArabic('to set your account') }} </p>
				         @endif
					 @else
						 <p></p>
					 @endif
				@else
					<p></p>
				@endif
			@endforelse
		</div>
		{{ $blogs->links() }}
	</div>
</div>

@stop
