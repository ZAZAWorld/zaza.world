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
	@include('front.ad.add_body.body_include.price', array('ad_negotiable'=>0, 'ad_exchange'=>0, 'ad_free'=>1))
</div>

<div class="add_ad_option add_ad_option_all-border">
	<div class="col-md-23">
		<span class="icon-35 add_ad_option__img">
			<span>Date</span>
		</span>
	</div>
	<div class="col-md-37">
		<div class="add_ad_option__line">
			<!-- Date -->
			@include('front.ad.add_body.body_include.option_date_1')
		</div>
	</div>
	<div class="col-md-40">
		<div class="add_ad_option__line">
			<!-- Date -->
			@include('front.ad.add_body.body_include.option_date_2')
		</div>
	</div>
	<div style="clear:both;"></div>
</div>

@include('front.ad.owner')
