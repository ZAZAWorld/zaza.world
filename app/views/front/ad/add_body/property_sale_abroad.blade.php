@include('front.ad.head_body')

<div class="add_ad_feilds">
    <div class="add_ad_feilds__line">
        @include('front.ad.add_body.body_include.title')
    </div>
    <div class="add_ad_feilds__line">
        @include('front.ad.add_body.body_include.photo_block')
    </div>
    <div class="add_ad_feilds__line">
        @include('front.ad.add_body.body_include.description')
    </div>
</div>

<div class="add_ad_price">
    @include('front.ad.add_body.body_include.price', array('ad_negotiable'=>1, 'ad_exchange'=>1, 'ad_free'=>0))
</div>

<div class="add_ad_option add_ad_option_top-border">
    <div class="row">
        <div class="add_ad_option__line">
			<div class="col-md-45">
				<!-- Bedrooms -->
				@include('front.ad.add_body.body_include.option_property_bedroom')
			</div>
			<div class="col-md-45 col-md-offset-10">
				<!-- Furnished -->
				@include('front.ad.add_body.body_include.option_property_furnished')
			</div>
		</div>
		<div class="add_ad_option__line">
			<div class="col-md-45">
				<!-- Size (ft2) -->
				@include('front.ad.add_body.body_include.option_property_size')
			</div>
			<div class="col-md-45 col-md-offset-10">
				<!-- Maidroom -->
				@include('front.ad.add_body.body_include.option_property_maidroom')
			</div>
		</div>
		<div class="add_ad_option__line">
			<div class="col-md-45">
				<!-- Bathrooms -->
				@include('front.ad.add_body.body_include.option_property_bathtoom')
			</div>
			<!--
			<div class="col-md-45 col-md-offset-10">
				<!-- Pets allowed -->
				<!--
				@include('front.ad.add_body.body_include.option_property_pets')
			</div>
			-->
		</div>
		<div class="add_ad_option__line">
			<div class="col-md-45">
				<!-- Parking -->
				@include('front.ad.add_body.body_include.option_property_parking')
			</div>
		</div>
    </div>
 
</div>

@include('front.ad.owner')
