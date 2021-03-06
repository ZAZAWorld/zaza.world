@include('front.ad.head_body')

<div class="add_ad_feilds">
	<div class="add_ad_feilds__line">
		@include('front.ad.add_body.body_include.car_brand')
	</div>
    <div class="add_ad_feilds__line">
        <div class="col-md-70">
            @include('front.ad.add_body.body_include.car_model')
        </div>
        <div class="col-md-25" style="float:right;">
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
			<!-- Body -->
			@include('front.ad.add_body.body_include.option_car_body')
        </div>
        <div class="col-md-45 col-md-offset-10">
			<!-- Horse power -->
			@include('front.ad.add_body.body_include.option_car_horse_power')
        </div>
    </div>
    <div class="add_ad_option__line">
        <div class="col-md-45">
			<!-- Mileage -->
			@include('front.ad.add_body.body_include.option_car_mileage')
        </div>
        <div class="col-md-45 col-md-offset-10">
			<!-- Engine -->
			@include('front.ad.add_body.body_include.option_car_engine')
        </div>
    </div>
    <div class="add_ad_option__line">
        <div class="col-md-45">
			<!-- Wheel drive -->
			@include('front.ad.add_body.body_include.option_car_wheel_drive')
			<div style="clear:both"></div>
        </div>
        <div class="col-md-45 col-md-offset-10">
			<!-- Warranty -->
			@include('front.ad.add_body.body_include.option_warranty')
			<div style="clear:both"></div>
        </div>
    </div>
    <div class="add_ad_option__line">
        <div class="col-md-45">
			<!-- Transmission -->
			@include('front.ad.add_body.body_include.option_transmission')
			<div style="clear:both"></div>
        </div>
        <div class="col-md-45 col-md-offset-10">
			<!-- Condition -->
			@include('front.ad.add_body.body_include.option_condition')
			<div style="clear:both"></div>
        </div>
    </div>
    <div class="add_ad_option__line">
        <div class="col-md-45">
			<!-- Fuel -->
			@include('front.ad.add_body.body_include.option_fuel')
        </div>
        <div class="col-md-45 col-md-offset-10">
			<!-- Color -->
			@include('front.ad.add_body.body_include.option_color')
        </div>
    </div>
</div>



@include('front.ad.owner')
