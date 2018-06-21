<div class="p_com_option">
	<div class="p_com_option__item">
		<div class='p_com_option__name' > {{TransWord::getArabic('Registered Name')}}: </div>
		<div class='p_com_option__val' > {{$company->title}}</div>
	</div>
	<div class="p_com_option__item">
		<div class='p_com_option__name' > {{TransWord::getArabic('Activity')}}: </div>
		<div class='p_com_option__val' > {{$company->activity}}</div>
	</div>
	<div class="p_com_option__item">
		<div class='p_com_option__name' > {{TransWord::getArabic('Emirates')}}/{{TransWord::getArabic('Country')}}: </div>
		<div class='p_com_option__val' > {{$citys[$user->city_id]}}</div>
	</div>
	<div class="p_com_option__item">
		<div class='p_com_option__name' > {{TransWord::getArabic('Branches')}}: </div>
		<div class='p_com_option__val' > {{$company->branches}}</div>
	</div>
	<div class="p_com_option__item">
		<div class='p_com_option__name' > {{TransWord::getArabic('Company size')}}: </div>
		<div class='p_com_option__val' > {{$company->size_company}}</div>
	</div>
	<div class="p_com_option__item">
		<div class='p_com_option__name' > {{TransWord::getArabic('Active since')}}: </div>
		<div class='p_com_option__val' > {{$company->active_since}}</div>
	</div>
	<div class="p_com_option__item">
		<div class='p_com_option__name' > {{TransWord::getArabic('More info')}}: </div>
		<div class='p_com_option__val p_com_option__val-text' >{{ preg_replace('/(\r\n|\n|\r)/', '<br/>', $company->more_info) }}</div>
	</div>
</div>
