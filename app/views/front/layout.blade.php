<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title>{{ (isset($title) ? $title : 'title') }}</title>
	<meta name="description" content="Zaza.ae - Buy. Sell. Enjoy."/>
	<meta name="abstract" content="Zaza.ae - Buy. Sell. Enjoy."/>
	<meta name="keywords" content="Zaza.ae - Buy. Sell. Enjoy."/>
	<!-- Mobile Specific Metas
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
	
	<!-- CSS this
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	{{ HTML::style('front/css/normalize.css'); }}
	{{ HTML::style('front/css/grid100.css'); }}
	{{ HTML::style('front/css/jquery-ui.css'); }}
	{{ HTML::style('front/lib/tooltip/jquery.qtip.min.css'); }}
	{{ HTML::style('front/charity/jquery.mCustomScrollbar.css') }}
	{{ HTML::style('front/css/simplebar.css'); }}
	{{-- HTML::style('front/css/bootstrap-3.3.2.min.css'); --}}
	{{ HTML::style('front/css/style.css'); }}
	<!--–––––––––Company Vip Slider––––Begin––––––––––––––––––––––––––––––––––––– -->
	{{ HTML::style('front/lightslider/lightslider.css'); }}
	<!--–––––––––flexslider––––––css––––––––––––––––––––––––––––––––––– -->
	{{ HTML::style('front/flexslider/flexslider.css'); }}
	{{ HTML::style('front/css/jquery.bxslider.css'); }}
	
	<!--–––––––––popup––––––css––––––––––––––––––––––––––––––––––– -->
	{{ HTML::style('front/popup/template.css'); }}
	{{ HTML::style('front/charity/style.css') }}
	<!--––––––––– seerch block ––––––––––––––––––––––––––––––––––– -->
	{{ HTML::style('front/css/search.css'); }}
	<!--––––––––– success message ad ––––––––––––––––––––––––––––––––––– -->
	{{ HTML::style('front/css/mess_ad_success.css'); }}
	<!--––––––––– kolia ––––––css––––––––––––––––––––––––––––––––––– -->
	{{ HTML::style('front/kolia/style.css'); }}
	{{ HTML::style('front/kolia/slick-1.6.0/slick/slick.css'); }}
	<!--––––––––– inquiry_block ––––––css––––––––––––––––––––––––––––––––––– -->
	{{ HTML::style('front/css/inquiry.css'); }}
	<!--––––––––– last_ad_block ––––––css––––––––––––––––––––––––––––––––––– -->
	{{ HTML::style('front/css/last_ad.css'); }}
	
	<!--––––––––– map-block ––––––css––––––––––––––––––––––––––––––––––– -->
	{{ HTML::style('front/css/map-block.css'); }}
	<!--––––––––– radio_block ––––––css––––––––––––––––––––––––––––––––––– -->
	{{ HTML::style('front/css/radio_block.css'); }}
	<!--––––––––– message_block ––––––css––––––––––––––––––––––––––––––––––– -->
	{{ HTML::style('front/css/message_block.css'); }}
	<!--––––––––– other ––––––css––––––––––––––––––––––––––––––––––– -->
	{{ HTML::style('front/css/other.css'); }}
	<!--––––––––– other style 2 ––––––css––––––––––––––––––––––––––––––––––– -->
	{{ HTML::style('front/css/other2.css'); }}
	{{ HTML::style('front/css/magnific-popup.css'); }}
	{{ HTML::style('front/css/lightbox.css'); }}
	
	
	
	{{ HTML::style('front/css/chat/style.css') }}
	{{ HTML::style('front/css/chat/jquery.jscrollpane.css') }}
	
	{{ HTML::style('front/js/timeTo.css') }}

    <!--–––––––––datepicker––––––css––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
	
	@yield('css')
	
	
	 
	{{-- HTML::style('front/js/bootstrap-3.3.2.min.js'); --}}
	{{-- 
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
	--}}
	 

	{{ HTML::script('front/js/jquery.js'); }}

	{{ HTML::script('front/js/jquery.priceformat.min.js'); }}
	{{ HTML::script('front/js/jquery-ui.min.js'); }}
	{{ HTML::script('front/js/jquery.validate.min.js'); }}
	{{ HTML::script('front/lib/tooltip/jquery.qtip.min.js'); }}
	{{ HTML::script('front/js/jquery.countTo.js'); }}
	{{ HTML::script('front/js/simplebar.js'); }}
	{{ HTML::script('front/js/script.js'); }}
	{{ HTML::script('front/js/counter.js'); }}
	{{ HTML::script('front/js/bar.js'); }}
	{{ HTML::script('front/js/right_bar.js'); }}
	{{ HTML::script('front/js/login_registr_modals.js'); }}
	{{ HTML::script('front/js/slider.js'); }}
	{{ HTML::script('front/js/scroll.js'); }}
	{{ HTML::script('front/js/tooltips.js'); }}
	{{ HTML::script('front/charity/jquery.mCustomScrollbar.concat.min.js'); }}
	{{ HTML::script('front/lightslider/lightslider.js'); }}
    {{ HTML::script('front/js/jquery.lazy.min.js'); }}
	<!--–––––––––--- advert functions js–––––––––––––––––––––––––––––––––––– -->
	{{ HTML::script('front/js/advert.js'); }}
	<!--–––––––––flexslider–––––js–––––––––––––––––––––––––––––––––––– -->
	{{ HTML::script('front/flexslider/jquery.flexslider-min.js'); }}
	{{ HTML::script('front/js/jquery.fitvids.js'); }}
	<!--–––––––––---popup–––––js–––––––––––––––––––––––––––––––––––– -->
	{{ HTML::script('front/popup/popup_img.js'); }}
	<!--––––––––– search block ––––––––––––––––––––––––––––––––––– -->
	{{ HTML::script('front/js/search.js'); }}
	<!--––––––––– success message ad ––––––––––––––––––––––––––––––––––– -->
	{{ HTML::script('front/js/mess_ad_success.js'); }}
	<!--––––––––– kolia ––––––js––––––––––––––––––––––––––––––––––– -->
	{{ HTML::script('front/kolia/slick-1.6.0/slick/slick.min.js'); }}
	{{ HTML::script('front/kolia/bootstrap/bootstrap-tab.js'); }}
	{{ HTML::script('front/kolia/default.js'); }}
	<!--––––––––– inquiry_block ––––––js––––––––––––––––––––––––––––––––––– -->
	{{ HTML::script('front/js/inquiry.js'); }}
	<!--––––––––– add advert ––––––js––––––––––––––––––––––––––––––––––– -->
	{{ HTML::script('front/js/add_ad.js'); }}
    {{ HTML::script('front/js/fbook_login.js'); }}
	{{ HTML::script('front/js/registration_company.js'); }}
	
	<!-- ––––––––– last_ad_block ––––––js––––––––––––––––––––––––––––––––––– -->
	{{ HTML::script('front/js/last_ad.js'); }}
	
	<!-- ––––––––– message_block ––––––js––––––––––––––––––––––––––––––––––– -->
	{{ HTML::script('front/js/message_block.js'); }}
	<!-- ––––––––– map-block ––––––js––––––––––––––––––––––––––––––––––– -->
    {{ HTML::script('front/js/map/markerclusterer.min.js'); }}
    {{ HTML::script('front/js/map/map-block.js'); }}
	<!-- ––––––––– chat-block ––––––js––––––––––––––––––––––––––––––––––– -->
	{{ HTML::script('front/js/chat/jquery.mousewheel.js') }}
	{{ HTML::script('front/js/chat/jquery.jscrollpane.min.js') }}
	{{ HTML::script('front/js/chat/chat.js') }}
	{{ HTML::script('front/js/delete_ad.js') }}
	
	{{ HTML::script('front/js/jquery.maskedinput.js') }}
	{{ HTML::script('front/js/jquery.time-to.min.js') }}
	{{ HTML::script('front/js/magnific/jquery.magnific-popup.js') }}
	{{ HTML::script('front/js/magnific/lightbox.js') }}
	{{ HTML::script('front/js/jquery.bxslider.js'); }}
    <!--–––––––––---datepicker–––––js–––––––––––––––––––––––––––––––––––– -->
    {{ HTML::script('front/js/makeup.js'); }}

	<script src="https://maps.googleapis.com/maps/api/js?key=*****************-K1E&libraries=places,drawing,geometry"> </script>
	<script src="https://www.google.com/recaptcha/api.js"></script>
	<script type="text/javascript">$(window).on('load', function () {
    var $preloader = $('#p_prldr'),
        $svg_anm   = $preloader.find('.svg_anm');
    $svg_anm.fadeOut();
    $preloader.delay(500).fadeOut('slow');
});</script>

	@yield('js')
	
	<!-- Favicon
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<link rel="shortcut icon" href="/favicon.ico" />
	
</head>
<body>

	<!------------- alert for small device -------->
    <div class="bg_alert_lands">{{ TransWord::getArabic('Please rotate your device to landscape view') }}<img src="https://zaza.ae/images/RotatePhone.gif" width="300" align="center" alt="phone rotate" /></div>

    <div class="body">
        <div class="wrapper">
			<div class="header_bg"></div>
            <header class="header">
                <div class="row">
					<!-------- HEADER BLOCKS ----------->
                    @include('front.include.header.logo')
                    @include('front.include.header.location')
                    @include('front.include.header.weather')
                    @include('front.include.header.counter')
                    @include('front.include.header.header-buttons')
                </div>
				
            </header>
			<div style="clear:both;"></div>

            @yield('content')

        </div>
	<div class="to-top js-totop" style="display: none;">
		<div class="to-top__inner">
			<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 viewBox="0 0 35 35" style="enable-background:new 0 0 35 35;" xml:space="preserve">
			<rect class="to-top" width="35" height="35"/>
			<path class="to-top__icon" d="M17.5,13.4l7,6.8v1.4l-7-6.8l-7,6.8v-1.4L17.5,13.4z"/>
			</svg>
		</div>
	</div>	
		<!-------- SEARCH BLOCK ----------->
		@include('front.include.search')
		<!-------- BAR BLOCK ----------->
        @include('front.include.bars')
		<!-------- LOGIN MODALS ----------->
        @include('front.modal.login.login')
		@include('front.modal.login.forget_password')
		@include('front.modal.login.reg_simple_user')
		@include('front.modal.login.registr_company')
		<!-------- ADD AD MODAL ----------->
        @include('front.modal.add_ad')
		
		<!-------- MESSAGE MODALS ----------->
		@if (Session::has('mess_ad_success'))
			@include('front.modal.mess_ad_success')
		@endif
		@include('front.modal.message')
		
		<!----- CHARITY BLOCK ------------->
		@if(isset($bottom) && $bottom)
			
			@include('front.index.charity')
		@endif 
		
		<!---------- RIGHT BLOCKS ------>
		@include('front.include.right_blocks.right-buttons')
		@include('front.include.right_blocks.inquiry') 
		@include('front.include.right_blocks.last_ad')
        @include('front.include.right_blocks.map-block')
        @include('front.include.right_blocks.radio_block') 
		@include('front.include.chat')
		
		<!---------- delete advert block -------->
		<div class='delete_ad_block shadow'>
			<div class='delete_ad_block_header'>
				Would you like delete this ad?
			</div>
			<div class='delete_ad_block_body'>
				<div class='delete_ad_block_button_ok'>Yes</div>
				<div class='delete_ad_block_button_no'>No</div>
			</div>
		</div>
		
		<!---------- delete advert block -------->
		<?php $userasdasasd = Auth::user(); ?>
		@if ($userasdasasd )
			<div class='to_top_block shadow'>
				<div class='to_top_block_header'>
					Promotion to the <i class="c-top__icon icon-122" style="vertical-align: middle;"></i> List
				</div>
				<div class='to_top_block_body'>
					<?php $user_balanssdsdsds = Budjet::getBudjet($userasdasasd); ?>
					{{ Form::open(array('url'=>action('CompanyController@postToTop'), 'method' => 'post', 'role'=>'form')) }}
						<div class="row col-md-100" style="margin:10px;">
							<div class="col-md-55">Your balance is <strong>{{ $user_balanssdsdsds->total_aed }} AED</strong> </div>
							<div class="col-md-40 col-md-offset-5"><div style='cursor: pointer; background: #8bc34a; color: #fff; border-radius: 5px; padding: 5px; width:80%'>Add Funds</div></div>
						</div>
					<div class="row col-md-100" style="margin:10px 0 0;">					
						<div class="col-md-40">1 view </div>
						<div class="col-md-20">-</div>
						<div class="col-md-40">AED 1</div>
					</div>
					 <div class="row col-md-100" style="margin:0 10px;">
						
						<div class="col-md-45">
						
							<div class="col-md-70">
								<input class="js_call_to_top_change" name="count_view" type="number" value="" min="50" style="width:100px" />
								<small>Min 50 views</small>
							</div><div class="col-md-30">views</div> 
							
							 
						</div>
						<div class="col-md-50 col-md-offset-5 js-vip_view-value">
							
							<span  style="color: #d41f26; font-size: 16px; line-height: 20px; font-weight: 600;">
								{{TransWord::getArabic('AED')}} <span class='js_call_to_top_change_val'></span>
							</span>
						</div>
						</div>
					 <div class="row col-md-100" style="margin:10px;">
						<small>If you have any special offer</small> <br />
						Special offer <div class="onoffswitch">
									<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox js_is_greeting_call" id="sp_offer_switch" checked="">
									<label class="onoffswitch-label" for="sp_offer_switch">
										<span class="onoffswitch-inner"></span>
										<span class="onoffswitch-switch"></span>
									</label>
								</div> 
					</div>
						<div class="row col-md-100"  style="margin:10px;">
						<div style='overflow:hidden'>
							<button type="submit" class="delete_ad_block_button_ok" style="border:0;">Submit</button> 
							<button type="button" class="delete_ad_block_button_no js_call_to_top" style="border:0;">Cancel</button>
						</div>
						</div>
					{{ Form::close() }}
				</div>
			</div>
		@endif
		
		<!--------- term and condition block ------>

			
			

		<div class='modal_terms' id='modal_terms' style="font-size:10px;"></div>
		<div class='modal_privacy' id='modal_about' style="font-size:10px;"></div>
		<div class='modal_about' id='modal_privacy' style="font-size:10px;"></div>
		<div class='modal_banner' style="font-size:10px;">
			<div class='modal_terms_bg js_call_modal_banner'></div>
			<div class="modal_terms_body shadow" style="height:600px;">
				<span class="modal_terms_close js_call_modal_banner"></span>				
				<div style="overflow:auto; height:530px;">
					<h2>BANNER ADVERTISING POLICY</h2>

<p>By accessing the website Zaza.ae (further zaza or zaza.ae) in any way, you are confirming that you have read and understood the Terms &amp; Conditions and agreeing to be bound by them, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of Terms &amp; conditions, you are prohibited from using or accessing this site. Using the website in any way as Registered User, or Visitor, or in any other purpose, it will be indicated as anacceptance of the Terms &amp; Conditions. These Banner Advertising Policy applies to use of this website, and its terms are made a part of the Terms &amp; Conditions of Zaza.ae.</p>

<h3>BANNER ADVERTISING</h3>

<p>Banner Advertising in zaza.ae could be placed by any Organization (Commercial / Non-Profit Organizations), who has registered in UAE only. The individuals are not allowed to do so. While applying for Banner Advertising, Advertiser must provide accurate and complete information concerning to the Organization, who applies for. Zaza shall have the right to ask for Advertiser confirmation of data mentioned by same and request supporting documents. If Advertiser does not provide or provide incorrect information to Zaza, or if the information does not comply with the requirements of the Banner Advertising Policy of these website, Zaza shall have the right to suspend or cancel Advertiser’s application.</p>

<h3>ADVERTISEMENT PURPOSE AND CONTENT</h3>

<p>Advertiser represent and warrant that it owns or otherwise control all of the rights to the Advertising that been posted; that the content is accurate; that use of the content Advertiser supply does not violate this policy and will not cause injury to any person or entity; and that Organization (Advertiser) will indemnify Zaza for all claims resulting from content Advertiser supply. Zaza has the right but not the obligation to monitor or reject application for Advertising, or remove the active Advertising, if the content of Advertising against these Banner Advertising Policy. Zaza takes no responsibility and assumes no liability for any content posted by Organization or any third party. disclaim

While the placing Banner Advertising, the Advertiser agrees to abide by the following:</p>
<ul>
	<li>Do not violate of these Banner Advertising Policy, Terms &amp; Conditions of this web-site, Local Low and to follow Prohibited Items and Services in Zaza website mentioned in these Policy</li>
	<li>Do not violate the rights of the third party</li>
	<li>Do not spread or use virus(es) and other technologies that may cause damage to Zaza or the interest of other users</li>
	<li>Do not copy, duplicate the content of advertisements belongs to third parties</li>
	<li>Do not post illegal, obscene, false, inaccurate, misleading, defamatory, libelous, threatening, defamatory, invasive of privacy, infringing on intellectual property rights content.</li>

</ul>

<h3>PROHIBITED ITEMS AND SERVICES IN ZAZA WEBSITE:</h3>
<ul>
	<li>Alcoholic Beverages</li>
	<li>Blood, Bodily Fluids and Body Parts</li>
	<li>Counterfeit currency, stamps, or coins</li>
	<li>Counterfeit Products</li>
	<li>Embargoed Goods</li>
	<li>Government and Transit Uniforms, IDs and Licenses</li>
	<li>Illegal Drugs &amp; Drug Paraphernalia</li>
	<li>Illegal Services</li>
	<li>Black Magic</li>
	<li>Hazardous Materials</li>
	<li>Fireworks, Destructive Devices and Explosives</li>
	<li>Identity Documents, Personal Financial Records &amp; Personal Information (in any form, including mailing lists)</li>
	<li>Items which encourage or facilitate illegal activity</li>
	<li>Lottery Tickets, Sweepstakes Entries and Slot Machines</li>
	<li>Obscene Material and Pornography</li>
	<li>Offensive Material</li>
	<li>Pesticides</li>
	<li>Organ and sperm donor</li>
	<li>Pictures or images that contain nudity</li>
	<li>Police Badges and Uniforms</li>
	<li>Prescription Drugs and Devices</li>
	<li>Recalled items</li>
	<li>Stocks and Other Securities</li>
	<li>Stolen Property</li>
	<li>Tobacco Products</li>
	<li>Used Cosmetics</li>
	<li>Weapons and related items (such as firearms, firearm parts and magazines, ammunition, BB and pellet guns, tear gas, stun guns, switchblade knives, and martial arts weapons) If Advertiser violate this policy, Advertising shall be removed. Zaza has the right not to accept application for Banner Advertising, or block active Advertisement that are deemed to contain prohibited content or unfit to be posted on the website. The Organization (Advertiser) is responsible for ensuring compliance with all applicable laws relating to the Advertising on this site.</li>
</ul>

<h3>PAYMENT POLICY</h3>

<p>In Zaza Banner Advertising is paid service, which require payment in full before use, and the amount payable clearly indicated. We may change our prices from time to time. In which case Advertiser will be notified of this before to pay and have the opportunity to decline payment. If Advertiser decline payment, Advertiser will not receive the Services to which such payment relates. We will not start to provide the paid-for Services (and shall be under no obligation to do so) until we have been paid in advance in accordance with these Policy.</p>

<p>To Advertiser given the opportunity to check Application and cancel it or amend it prior to its final submission to us. While applying for Banner advertising and releasing payment, Advertiser has agreed that we will begin to provide the Services as per availability of space on the main page of the website, which agrees before the payment was released by Advertiser. In any case released fund (money) could not be refounded back. On case if the Advertising were removed with some reason (unacceptable content, misusing website) which mentioned in these Policy, the balance amount is not refundable, including the remaining days where advertising supposed to be placed.</p>

<h3>COMPLAINT</h3>

<p>Any complaints from Advertiser about the placement / not placement /not correctness of Advertisement or any other concern related to Banner Advertising are acceptable within 14 calendar days from the actual date of Advertising supposed to be run, as per issued final confirmation from zaza.ae regarding placement of Banner Advertising. If a complaint is filed later than 14 calendar days, it will not be considered. Any complaints shall be forwarded to email info@zaza.ae along with attached Invoice and final confirmation from zaza.ae.</p>

<h3>CLAIMS OF INTELLECTUAL PROPERTY VIOLATIONS AND COPYRIGHT INFRINGEMENT</h3>

<p>Zaza reserves all of our rights, including but not limited to any and all copyrights, trademarks, patents, trade secrets, and any other proprietary right that we may have in our web site, its content, and the goods and services that may be provided. The use of our rights and property requires our prior written consent. We are not providing you with any implied or express licenses or rights by making services available to you and you will have no rights to make any commercial uses of our web site or service without our prior written consent.</p>

<h3>NOTIFICATION OF COPYRIGHT INFRINGEMENT.</h3>

<p>If you believe that your property has been used in any way that would be considered copyright infringement or a violation of your intellectual property rights, please, submit an electronic message to info@zaza.ae</p>

<h3>INDEMNIFICATION.</h3>

<p>You will indemnify and hold harmless Zaza, its subsidiaries, officers, directors, shareholders, service providers, suppliers, agents and employees, from any claim made by any third party due to or arising directly or indirectly out of your conduct or in connection with your use of this website, any alleged violation of the Privacy Policy and Terms of Use, and any alleged violation of any applicable law or regulation. We reserve the right, at our own expense, to assume the exclusive defense and control of any matter subject to indemnification by you, but doing so will not excuse your indemnity obligations.</p>

<h3>DISCLAIMER OF WARRANTIES. LIMITATION OF LIABILITY</h3>

<p>You understand and agree that your use of this web-site and any services or content provided to you at your own risk. Zaza is public web site, and we make no warranty, implied or express that any part of the Zaza Services will be uninterrupted, error-free, virus-free, timely, secure, accurate, reliable, of any quality, nor that any content is safe in any manner for download.</p>

<p>Hereby, Zaza expressly exclude and does not has any liability for:</p>

<p>• all conditions, warranties and other terms of goods and services;</p>
<p>• any direct, indirect or consequential loss or damage incurred by any user in connection with Preloved or in connection with the use, inability to use, or results of the use of Zaza and any materials posted on it, including, without limitation any liability for:</p>
<ul>
	<li>loss of income or revenue;</li>
	<li>loss of business;</li>
	<li>loss of profits or contracts;</li>
	<li>loss of anticipated savings;</li>
	<li>loss of data;</li>
	<li>loss of goodwill;</li>
	<li>wasted management or office time; and for any other loss or damage of any kind, however arising and whether caused by tort (including negligence), breach of contract or otherwise, even if foreseeable, provided that this condition shall not prevent claims for loss of or damage to your tangible property or any other claims for direct financial loss that are not excluded by any of the categories set out above.</li>

</ul>

In additional for the mentioned above, Zaza website:
<ul>
	<li>is under no obligation to you to monitor or record the Postings, Content or other activities of users of Zaza;</li>
	<li>does not assume any responsibility for the quality, safety or legality of Items;</li>
	<li>does not assume any responsibility for the truth or accuracy of any Postings or Content;</li>
	<li>makes no promises, warranties or guarantees about your ability to buy or sell Items using Preloved;</li>
	<li>does not responsible for third parties.</li>

</ul>

<h3>PRIVACY.</h3>

<p>Your privacy is very important to Zaza. Accordingly, Zaza had developed Privacy Policy, applies to use of this website, and its terms are made a part of Terms &amp; Conditions. Please review our Privacy Policy and Terms &amp; Conditions.</p>
				</div>
			</div>
		</div>


			
			
			
	</div>

	
<script>
	$(window).scroll(function () {
		if ($(this).scrollTop() > 500) {
			$('.js-totop').fadeIn();
		} else {
			$('.js-totop').fadeOut();
		}
	});
    $('.js-totop').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 400);
        return false;
    });
	
	$(window).scroll(function () {
		var filter_block = $('.ad_filter');
		var swither = $('.js-switch-filter');
		 if(screen.width>1024){
			if ($(this).scrollTop() > 150) {
				if ($('.ad_filter').hasClass('open')){
				$('.ad_filter').removeClass('open');
				document.getElementById('catalogs').style.marginTop = '0';
				swither.removeClass('c-postmore__icon_up c-postmore__icon');
				swither.addClass('c-postmore__icon');
				filter_block.removeClass('open');
				}
				
			} 
		}
		if(screen.width<1024){
			if($(this).scrollTop() < 45) {
			document.getElementById('front_filter_switch').style.position = 'absolute';
			document.getElementById('front_filter_switch').style.top = '45px';
			}	
			else {
				document.getElementById('front_filter_switch').style.position = 'fixed';
				document.getElementById('front_filter_switch').style.top = '0';
			}
		}
	});

</script>

<!-- ––––––––– radio_block ––––––js––––––––––––––––––––––––––––––––––– -->
	{{ HTML::script('front/js/radio_block.js'); }}
                 
 <!--––––––––– GOOGLE ANALITYCS –––––––––––––––––––––––––––––––––––– -->
                   <script>
                           (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                           (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                           m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                           })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
                           ga('create', 'UA-93841239-1', 'auto');
                           ga('send', 'pageview');
                   </script>

</body>
</html>
