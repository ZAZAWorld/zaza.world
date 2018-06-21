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
	@include('front.ad.add_body.body_include.price', array('ad_negotiable'=>true, 'ad_exchange'=>false, 'ad_free'=>false))
</div>

<div class="add_ad_option add_ad_option_top-border">
    <div class="row">
        <div class="col-md-70">
			<!-- Rent term -->
            @include('front.ad.add_body.body_include.option_rent_term')
        </div>
        <div class="col-md-30">
			<!-- With driver -->
            @include('front.ad.add_body.body_include.option_with_driver')
        </div>
    </div>
</div>

@include('front.ad.owner')
