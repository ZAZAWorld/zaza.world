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
<br />
<div style="border:1px solid #bfc0c2; border-left:none; border-right:none;">
    <div class="add_ad_option__line">
        <div class="col-md-45">
			<!-- Sex -->
			@include('front.ad.add_body.body_include.option_sex')
        </div>
    </div>
</div>

@include('front.ad.owner')