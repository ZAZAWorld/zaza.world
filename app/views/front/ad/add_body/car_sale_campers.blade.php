@include('front.ad.head_body')

<div class="add_ad_feilds">
	<div class="add_ad_feilds__line">
        <div class="col-md-75">
			@include('front.ad.add_body.body_include.title')
		</div>
        <div class="col-md-25">
            @include('front.ad.add_body.body_include.car_year')
        </div>
    </div>
    <div class="add_ad_feilds__line">
        @include('front.ad.add_body.body_include.photo_block')
    </div>
    <div class="add_ad_feilds__line">
        @include('front.ad.add_body.body_include.description')
    </div>
</div>

<div class="add_ad_price">
    @include('front.ad.add_body.body_include.price', array('ad_negotiable'=>true, 'ad_exchange'=>true, 'ad_free'=>true))
</div>

<div class="add_ad_option add_ad_option_all-border">
    <div class="add_ad_option__line">
        <div class="col-md-45">
			<!-- Mileage -->
            @include('front.ad.add_body.body_include.option_car_mileage')
        </div>
        <div class="col-md-45 col-md-offset-10">
			<!-- Warranty -->
            @include('front.ad.add_body.body_include.option_warranty')
        </div>
    </div>
	<div class="add_ad_option__line">
        <div class="col-md-45">
			<!-- Color -->
            @include('front.ad.add_body.body_include.option_color')
        </div>
		<div class="col-md-45 col-md-offset-10">
			<!-- Condition -->
            @include('front.ad.add_body.body_include.option_condition')
        </div>
    </div>
</div>



@include('front.ad.owner')