<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ (isset($title) ? $title : 'title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Zaza.ae - Buy. Sell. Enjoy."/>
    <meta name="abstract" content="Zaza.ae - Buy. Sell. Enjoy."/>
    <meta name="keywords" content="Zaza.ae - Buy. Sell. Enjoy."/>
    <!-- Mobile Specific Metas
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- CSS
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    {{ HTML::style('front/css/normalize.css'); }}
    {{ HTML::style('front/css/grid100.css'); }}
    {{ HTML::style('front/css/jquery-ui.css'); }}
    {{ HTML::style('front/lib/tooltip/jquery.qtip.min.css'); }}
    {{ HTML::style('front/css/simplebar.css'); }}
    {{ HTML::style('front/css/style.css'); }}

    <!--–––––––––Company Vip Slider––––Begin––––––––––––––––––––––––––––––––––––– -->
	{{ HTML::style('front/lightslider/lightslider.css'); }}

	 <!--–––––––––flexslider––––––css––––––––––––––––––––––––––––––––––– -->
	 {{ HTML::style('front/flexslider/flexslider.css'); }}
	 {{ HTML::style('front/css/jquery.bxslider.css'); }}

	  <!--–––––––––popup––––––css––––––––––––––––––––––––––––––––––– -->
	 {{ HTML::style('front/popup/template.css'); }}

	  <!--–––––––––fancybox––––––css––––––––––––––––––––––––––––––––––– -->
	 {{ HTML::style('front/fancybox/jquery.fancybox-1.3.4.css'); }}
    <!--–––––––––datepicker––––––css––––––––––––––––––––––––––––––––––– -->
    {{ HTML::style('front/css/bootstrap/datepicker.css'); }}
     <!--––––––––– validation css ––––––––––––––––––––––––––––––––––– -->
     {{ HTML::style('https://jqueryvalidation.org/files/demo/site-demos.css'); }}

    @yield('css')
    <!-- Favicon
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="icon" type="image/png" href="images/favicon.png" />
</head>
<body>
    <div class="bg_alert_lands">Бла-бла-бла переверните</div>

    <div class="body">
        <div class="wrapper">
            <header class="header">
                <div class="row">
                    @include('front.include.logo')
                    @include('front.include.location')
                    @include('front.include.weather')
                    @include('front.include.counter')
                    @include('front.include.header-buttons')
                </div>
            </header>

            @yield('content')

        </div>

        @include('front.include.bars')


        @include('front.catalog.house_dialog')

        @include('front.modal.login')
        @include('front.modal.registr_company')
        @include('front.modal.add_ad')
        @include('front.modal.forget_password')


    </div>

    @if(isset($bottom) && $bottom)
        @include('front.index.charity')
    @endif

    {{ HTML::script('front/js/jquery.js'); }}
    {{ HTML::script('front/js/jquery-ui.min.js'); }}
    {{ HTML::script('front/js/jquery.validate.min.js'); }}
    {{ HTML::script('front/lib/tooltip/jquery.qtip.min.js'); }}
    {{ HTML::script('front/js/jquery.countTo.js'); }}
    {{ HTML::script('front/js/simplebar.js'); }}
    {{ HTML::script('front/js/script.js'); }}
    {{ HTML::script('front/js/counter.js'); }}
    {{ HTML::script('front/js/bar.js'); }}
    {{ HTML::script('front/js/login.js'); }}
    {{ HTML::script('front/js/slider.js'); }}
    {{ HTML::script('front/js/scroll.js'); }}
    {{ HTML::script('front/js/tooltips.js'); }}
    {{ HTML::script('front/lightslider/lightslider.js'); }}

	<script type="text/javascript">
    	 $(document).ready(function() {
			$("#content-slider").lightSlider({
                loop:true,
                keyPress:true
            });
            $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:5,
                slideMargin: 0,
                speed:500,
                auto:true,
                loop:true,
				vertical:true,
				verticalHeight:345,
				vThumbWidth:90,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }
            });


		});
    </script>
	<!--–––––––––flexslider–––––js–––––––––––––––––––––––––––––––––––– -->
	{{ HTML::script('front/flexslider/jquery.flexslider-min.js'); }}
	<script type="text/javascript">
        $(document).ready(function() {
			$('.flexslider').flexslider();
		});
	</script>

	{{ HTML::script('front/js/jquery.bxslider.min.js'); }}
	<script type="text/javascript">
	$(document).ready(function(){
		$('.bxslider').bxSlider();
	});
	</script>

	<!--–––––––––---popup–––––js–––––––––––––––––––––––––––––––––––– -->
	{{ HTML::script('front/popup/popup_img.js'); }}

	<!--–––––––––---fancybox–––––js–––––––––––––––––––––––––––––––––––– -->
	{{ HTML::script('front/fancybox/jquery.fancybox-1.3.4.pack.js'); }}
	{{ HTML::script('front/fancybox/jquery.min.js'); }}
	{{ HTML::script('front/fancybox/jquery.mousewheel-3.0.4.pack.js'); }}
    <!--–––––––––---datepicker–––––js–––––––––––––––––––––––––––––––––––– -->
			<script type="text/javascript">
			$("a[rel=example_group]").fancybox({
							'transitionIn'		: 'none',
							'transitionOut'		: 'none',
							'titlePosition' 	: 'over',
							'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
								return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
							}
						});
			</script>
			<script type="text/javascript">
			$(document).ready(function() {
				$(".single_image").fancybox();
			});
			</script>
			<script type="text/javascript">
			$(document).ready(function() {
				$("#content").fancybox({
					'titlePosition' : 'inside',
					'transitionIn' : 'none',
					'transitionOut' : 'none'
				});
			});
			</script>
		<!--Fancybox-->

    @yield('js')
</body>
</html>
