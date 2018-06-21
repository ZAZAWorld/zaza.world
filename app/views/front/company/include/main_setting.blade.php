<div class="p_com">
	<div class="p_com_title">
		{{TransWord::getArabic('About company')}}
	</div>
	<div class="p_com_logo" style="background:url('{{ $company->photo }}') no-repeat center center; background-size: auto 100%;">
	</div>
	<div class="p_com_list">
		<div class="p_com_list__item">
			<img class="p_com_list__img" src="/front/img/icons/icon_phone.png" />
			<span class="p_com_list__text"> {{ $company->phone }} </span>
		</div>
		<div class="p_com_list__item">
			<img class="p_com_list__img" src="/front/img/icons/icon_mobile.png" />
			<span class="p_com_list__text"> {{ $company->mobile }} </span>
		</div>
		<div class="p_com_list__item">
			<img class="p_com_list__img" src="/front/img/icons/icon_mail.png" />
			<span class="p_com_list__text"> {{ $user->email }} </span>
		</div>
		<div class="p_com_list__item">
			<img class="p_com_list__img" src="/front/img/icons/icon_location.png" />
			<span class="p_com_list__text"> {{ $company->location }} </span>
		</div>
	</div>
</div>