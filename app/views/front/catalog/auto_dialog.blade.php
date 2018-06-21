
{{ HTML::script('front/js/blog.js') }}
<div class="ad-modal open">
	<div class='ad-modal_bg'></div>
	<!-- Prev or next ad link -->
    @include('front.catalog.advert_include.prev_next_link')
    <!-- Modal content -->
    <div class="ad-modal__content" id="tabs">
        <span class="ad-modal__close">×</span>
		<!-- Advert headers-->
        <div class="ad-modal__header">
			@include('front.catalog.advert_include.header')
        </div>
		<!-- {{-- Advert top panels (tabs) --}} -->
        <div class="ad-modal__head_body">
			<!--{{------- sliders tab -----}}-->
			<div id="tab-1" class="view_photo tab-content current">			
				@include('front.catalog.advert_include.slider')
			</div>
			<!-- {{------- youtube tab -----}} -->
			<div id="tab-2" class="view_photo tab-content">
				<iframe width="100%" height="370px" src="https://www.youtube.com/embed/{{ $advert->youtube }}?showinfo=0&enablejsapi=1&origin=https://zaza.ae:8350" frameborder="0" allowfullscreen></iframe>
			</div>
			<!-- {{------- map tab -----}} -->
			<div id="tab-google-map-box" class="view_map" style='min-height: 370px;'>
				<div id='map_div' style='width: 100%; min-height:370px;'></div>
			</div>
        </div>
		<!-- {{------- advert main characteristics -----}} -->
        <div class="ad-modal__body">
			@include('front.catalog.advert_include.main_chars')
        </div>
		<!-- {{------- advert panel -----}} -->
        <div class="ad_panel">
            <div class="ad_panel__buttons">
                <button class="ad_panel__button js-ad_panel__button active" data-tab-id='1' >
                    {{TransWord::getArabic('Description')}}
                </button>
                <button class="ad_panel__button js-ad_panel__button" data-tab-id='2'>
                    {{TransWord::getArabic('Characteristics')}}
                </button>
                <button class="ad_panel__button js-ad_panel__button" data-tab-id='3'>
                    {{TransWord::getArabic('Comments')}}
                </button>
            </div>
            <div class="ad_panel__contacs">
                <div class="ad_panel__phones">
                    <span class="ad_panel__phone"> {{ $advert->order_number }} </span>
                </div>
                <!--
                <div class="ad_panel__email">
                    {{ $owner->email }}
                </div>
                -->
            </div>
        </div>
		
		<!--------- advert body ------>
        <div class="ad-modal__body">
			<!--------- advert about tab ------>
            <div class="ad_text_block js-ad_text_block " id='js-ad_text_block-1'>
                {{ preg_replace('/(\r\n|\n|\r)/', '<br/>', $about->note) }}
            </div>
			<!--------- advert props tab ------>
			<div class="ad_text_block js-ad_text_block ad_text_block_hide" id='js-ad_text_block-2'>
               <table border="0" height="310">
					<tbody>
						@foreach ($props as $prop) 
							@if(isset($prop->prop_val) && $prop->prop_val)
								<tr>
									<td width="150">{{ $prop->prop->name }}:</td>
									<td><strong>{{ $prop->prop_val }}</strong></td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
            </div>
			<!-- {{------- advert comment tab -----}} -->
			<div class="ad_text_block js-ad_text_block ad_text_block_hide" id='js-ad_text_block-3'>
				@include('front.catalog.advert_include.comment')
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  jQuery( document ).ready( function( $ ) {
    $('.flexslider').flexslider();
  });
  
  	$(document).ready(function(){
		$('div.tabs a').click(function(){
			var tab_id = $(this).attr('data-tab');
			$('div.tabs a').removeClass('current');
			$('.tab-content').removeClass('current');
			$(this).addClass('current');
			$("#"+tab_id).addClass('current');
		});

        $('.hasTooltip').each(function() { // Notice the .each() loop, discussed below
            $(this).qtip({
                content: {
                    text: $(this).next('div') // Use the "div" element next to this for the content
                },
                hide: {
                    fixed: true,
                    delay: 300
                },
                style: {
                    classes: 'qtip-spec '+ 'qtip-rounded' ,
                    tip: {
                        corner: true
                    }
                },
                position: {
                    corner: {
                        target: "rightMiddle",
                        tooltip: "leftMiddle"
                    }
                }
            });
        });
	});

</script>

