<?php
#<span class="p_personal__left_tab__li">
#	<span class="p_personal__left_tab__li_title">
#		{{TransWord::getArabic('My restaurants')}}
#		<span class="p_personal__left_tab__li_open " data-tab='js-personal-tabs-restoran'></span>
#	</span>
#	<div class='js-personal-tabs js-personal-tabs-restoran'>
#	@foreach ($restorants as $i)
#		<span class="p_personal__left_tab__sub_li">
#			<a href='/catalog-company/company-view/{{ $i->id }}' class="p_personal__left_tab__sub_li_link">
#				<img src='{{ $i->photo }}' class="p_personal__left_tab__sub_li_img" />
#				<span class="p_personal__left_tab__sub_li_span">{{$i->title}} </span>
#			</a>
#		</span>
#	@endforeach
#	</div>
#</span>
?>
<span class="p_personal__left_tab__li">
	<span class="p_personal__left_tab__li_title">
		{{TransWord::getArabic('My Stores')}}
		<span class="p_personal__left_tab__li_open" data-tab='js-personal-tabs-shop'></span>
	</span>
	<div class='js-personal-tabs js-personal-tabs-shop'>
	@foreach ($shops as $i)
		<span class="p_personal__left_tab__sub_li">
		   <a href='/catalog-company/company-view/{{ $i->id }}' class="p_personal__left_tab__sub_li_link">
		   		<img src='{{ $i->photo }}' class="p_personal__left_tab__sub_li_img" />
				<span class="p_personal__left_tab__sub_li_span">{{$i->title}} </span>
		   	</a>
		</span>
	@endforeach
	</div>
</span>
<span class="p_personal__left_tab__li">
	<span class="p_personal__left_tab__li_title">
		{{TransWord::getArabic('My service providers')}}
		<span class="p_personal__left_tab__li_open" data-tab='js-personal-tabs-service-provider'></span>
	</span>
	<div class='js-personal-tabs js-personal-tabs-service-provider'>
	@foreach ($services as $i)
		<span class="p_personal__left_tab__sub_li">
			<a href='/catalog-company/company-view/{{ $i->id }}' class="p_personal__left_tab__sub_li_link">
				<img src='{{ $i->photo }}' class="p_personal__left_tab__sub_li_img" />
				<span class="p_personal__left_tab__sub_li_span">{{$i->title}} </span>
			</a>
		</span>
	@endforeach
	</div>
</span>
