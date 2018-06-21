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
	@include('front.ad.add_body.body_include.price', array('ad_negotiable'=>1, 'ad_exchange'=>1, 'ad_free'=>1))
</div>

<div class="add_ad_option add_ad_option_all-border">
    <div class="add_ad_option__line">
        <div class="col-md-100">
			<!-- Condition -->
            @include('front.ad.add_body.body_include.option_condition')
        </div>
    </div>
</div>

@include('front.ad.owner')