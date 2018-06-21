@include('front.ad.head_body')

<div class="add_ad_feilds">
    <div class="add_ad_feilds__line">
		<div class='col-md-100'>
			@include('front.ad.add_body.body_include.cv_title')
		</div>
    </div>

	<div class="add_ad_feilds__line"> 
        @include('front.ad.add_body.body_include.description')
    </div>

	<div class="add_ad_feilds__line">
		<div class='col-md-70'>
			<!-- Salary -->
			@include('front.ad.add_body.body_include.option_job_salary')
		</div>
	</div>
</div>

<div class="add_ad_option add_ad_option_all-border">
	<div class="add_ad_option__line">
		<div class="col-md-60">
			<!-- Experience -->
			@include('front.ad.add_body.body_include.option_job_experience')
			<div style="clear:both"></div><br />
			<!-- Degree level -->
			@include('front.ad.add_body.body_include.option_job_degree_level')
			<div style="clear:both"></div><br />
			<!-- Company size -->
			@include('front.ad.add_body.body_include.option_job_company_size')
			<div style="clear:both"></div>
		</div>
		<div class="col-md-30 col-md-offset-10">
			<!-- 	Full time / Part time -->
			@include('front.ad.add_body.body_include.option_job_full_part_time')
        </div>
	</div>
	<div class="add_ad_option__line">
		<div class="add_ad_feilds__line">
			@include('front.ad.add_body.body_include.photo_job_vacancies_block')
		</div>
	</div>
</div>



@include('front.ad.owner')
