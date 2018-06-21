@include('front.ad.head_body')

<div class="add_ad_feilds">
    <div class="add_ad_feilds__line">
        @include('front.ad.add_body.body_include.title')
    </div>
    <div class="add_ad_feilds__line">
        @include('front.ad.add_body.body_include.asdasdacxzcaseqwe')
    </div>
    <div class="add_ad_feilds__line">
        @include('front.ad.add_body.body_include.description')
    </div>
</div>


<div class="add_ad_option add_ad_option_all-border">
    <div class="row">
        <div class="col-md-100">
            <!-- Found and lost data -->
			@include('front.ad.add_body.body_include.option_date_found_lost')
        </div>
    </div>
</div>

@include('front.ad.owner')
