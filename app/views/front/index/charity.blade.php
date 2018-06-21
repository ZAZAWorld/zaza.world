<div class="c-page wrapper" style="">
    <header class="c-header">
        <div class="c-container g-height100">
            <div class="l-grid-noGutter-middle g-height100">
                <div class="l-grid__col-9_sm-12">
                    <div class="l-grid-noGutter g-height100">
                        <div class="l-grid__col">
                            <div class="c-header-icon">
                                <div class="c-header-icon__image">
                                    <img src="./images/c-header-icon-1.png" alt="">
                                </div>
                                <div class="c-header-icon__title"><a href="">{{TransWord::getArabic('Share the kindness')}}</a></div>
                            </div>
                        </div>
                        <div class="l-grid__col">
                            <div class="c-header-icon">
                                <div class="c-header-icon__image">
                                    <img src="./images/c-header-icon-2.png" alt="">
                                </div>
                                <div class="c-header-icon__title"><a href="#">{{TransWord::getArabic('Help for needy families')}}</a></div>
                            </div>
                        </div>
                        <div class="l-grid__col">
                            <div class="c-header-icon">
                                <div class="c-header-icon__image">
                                    <img src="./images/c-header-icon-3.png" alt="">
                                </div>
                                <div class="c-header-icon__title"><a href="#">{{TransWord::getArabic('Hold out your hand to orphans')}}</a></div>
                            </div>
                        </div>
                        <div class="l-grid__col">
                            <div class="c-header-icon">
                                <div class="c-header-icon__image">
                                    <img src="./images/c-header-icon-4.png" alt="">
                                </div>
                                <div class="c-header-icon__title"><a href="#">{{TransWord::getArabic('Care for disabled')}}</a></div>
                            </div>
                        </div>
                        <div class="l-grid__col">
                            <div class="c-header-icon">
                                <div class="c-header-icon__image">
                                    <img src="./images/c-header-icon-5.png" alt="">
                                </div>
                                <div class="c-header-icon__title"><a href="#">{{TransWord::getArabic('Care for animals')}}</a></div>
                            </div>
                        </div>
                        <div class="l-grid__col">
                            <div class="c-header-icon">
                                <div class="c-header-icon__image">
                                    <img src="./images/c-header-icon-6.png" alt="">
                                </div>
                                <div class="c-header-icon__title"><a href="#">{{TransWord::getArabic('Save the nature together')}}</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="l-grid__col-3_sm-12">
                    <div class="c-botton-wrap">
                        <a href="" class="c-button c-button-orange">{{TransWord::getArabic('Charity')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="c-carousel">
        <div class="c-container">
            <div class="c-carousel__header">
                <h3 class="c-carousel-head">{{TransWord::getArabic('Our partners')}}</h3>
            </div>
            <div class="c-carousel__content">
                <div class="js-carousel">
				
				@foreach( SysAdOurPartners::where('active', 1)->orderBy('id', 'desc')->get() as $p )
					<div>
                        <div class="c-carousel-item"><div class="c-carousel-item__image"><img src="{{ $p->icon }}" alt="{{ $p->name}}" title="{{ $p->name}}"></div></div>
                    </div>
					                    
                @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="c-main">
        <div class="c-container">
            <div class="l-grid-noGutter-sm-1">
                <div class="l-grid__col-4_sm-12">
                    <div class="c-reviews">
                        <div class="c-reviews__header">
                            <h3 class="c-reviews-head">{{TransWord::getArabic('REVIEWS & SUGGESTIONS')}} <span>({{SysAdComment::where('element_type_id', 3)->orderBy('id', 'desc')->count()}})</span></h3>
                        </div>
                        <div class="c-reviews__body">
                            <div class="c-reviews-list js-reviews-scroll">
								@foreach( SysAdComment::where('element_type_id', 3)->orderBy('id', 'desc')->get() as $g )
									<div class="c-reviews-list__item">
										<div class="l-grid-noGutter">
											<div class="l-grid__col-4_xs-4_sm-3">
												<div class="c-reviews-autor" style="background:url('{{ $g->relUser->photo }}') no-repeat center center; background-size:cover;">
													
												</div>
											</div>
											<div class="l-grid__col-8_xs-8_sm-9">
												<div class="c-reviews-text">
													<p>— {{ $g->note}} </p>
												</div>
												<div class="c-reviews-name"><a href='{{ action("PersonController@getView",  $g->user_id) }}'>{{ $g->name}}</a>
                                                @if (Auth::check() && Auth::user()->id == $g->user_id)
                                                    <a class="c-postshare">
                                                     <span class="c-postshare__delete" style="cursor: pointer;">✖</span>
                                                    </a>
                                                @endif



                                             </div>
                                             <div class='mess_block ok shadow' id='confirmDelete' style="display: none;">

                                                <div class='mess_title'></div>                                                                              
                                                <div class='mess_body'>{{TransWord::getArabic('Would you like to delete this post?',false)}}</div>                                                                      

                                                <div class='mess_footer'>
                                                <a href="{{ action('CommentController@getDelete', $g->id) }}" class="mess_confirm__delete " style="border: 0;color: #fff;border-radius: 5px;padding: 5px 15px;font-size: 1.2em;font-weight: 600;background: #8bc34a;margin-bottom: 3px;">Yes</a>
                                                    <a class="mess_confirm__close" style="cursor: pointer;border: 0;color: #fff;border-radius: 5px;padding: 5px 15px;font-size: 1.2em;font-weight: 600;background: #8bc34a;margin-bottom: 3px;" >No</a>
                                                </div>
                                            </div>
                                            <div class="c-reviews-createdon">{{ $g->created_at}}</div>
											</div>
										</div>
									</div>
								@endforeach
                            </div>
							@if (Auth::check())
								<form action="{{ action('CommentController@anyAdd') }}" class="c-reviews-form" method='post' enctype="multipart/form-data">
									<div class="c-reviews-form__field">
										<textarea name="note" id="" cols="" rows="" placeholder='{{TransWord::getArabic('Leave your reviews and suggestions',false)}} ...' class="c-textarea"></textarea>
									</div>
									<input type='hidden' name='element_type_id' value='3'>
									<input type='hidden' name='element_id' value='1'>
									<div class="c-reviews-form__submit">
										<button class="c-button c-button-blue" name="submit"><i class="c-icon icon-56"></i> <span>{{TransWord::getArabic('Submit',false)}}</span></button>
									</div>
									
									<div class="clear"></div>
								</form>
							@else 
								<p>{{TransWord::getArabic('Please',false)}}, <a href="#login" class="js-login">{{TransWord::getArabic('sign in',false)}}</a>{{TransWord::getArabic('to leave your comment',false)}}</p>
							@endif
                        </div>
                    </div>
                </div>
                <div class="l-grid__col-8_sm-12">
                    <div class="c-main-content">
                        <div class="c-main-content__header">
                            <h3 class="c-main-content-head">
                                &nbsp;
                            </h3>
                        </div>
                        <div class="c-main-content__body">
                            <div class="c-main-content-buttons">
                                <div class="l-grid-noGutter-middle_sm-1">
                                    <div class="l-grid__col-6_xs-12">
                                        <a href="/advert-us/" class="c-button c-button-blue">{{TransWord::getArabic('Advertising with us',false)}}</a>
                                    </div>
                                    <div class="l-grid__col-6_xs-12">
                                        <a href="#about" class="c-button c-button-blue js_call_modal_about">{{TransWord::getArabic('About',false)}} zaza.ae</a>
                                    </div>
                                </div>
                            </div>
                            <div class="c-main-content-contacts">
                                <div class="l-grid-noGutter-m-1">
                                    <div class="l-grid__col-6">
                                        <div class="c-main-content-links">
                                            <div class="c-main-content-links__item">
                                                <strong>{{TransWord::getArabic('Contact us',false)}}:</strong> <a href="mailto:info@zaza.ae">info@zaza.ae</a>
                                            </div>
                                             <div class="c-main-content-links__item">
                                                <a href="#modal_privacy" class="js_call_modal_privacy">{{TransWord::getArabic('Privacy Policy',false)}}</a>
                                             </div>
                                             <div class="c-main-content-links__item">
                                                <a href="#modal_terms" class="js_call_modal_terms">{{TransWord::getArabic('Terms & Conditions',false)}}</a>
                                             </div>
                                            <div class="c-main-content-links__item">
                                                <a href="#modal_banner" class="js_call_modal_banner">{{ TransWord::getArabic('Banner Advertising Policy') }}</a>
                                             </div>
                                             
                                        </div>
                                    </div>
                                    <div class="l-grid__col-6">
                                        <div class="c-social">
                                            <div class="c-social__head">
                                                <strong>{{TransWord::getArabic('Get in touch',false)}}:</strong>
                                            </div>
                                            <div class="c-social-lisl">
                                                <div class="c-social__item">
                                                    <a href="#" class="c-social_fb"></a>
                                                </div>
                                                <div class="c-social__item">
                                                    <a href="#" class="c-social_in"></a>
                                                </div>
                                                <div class="c-social__item">
                                                    <a href="#" class="c-social_yt"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="c-footer">
                        <div class="l-grid-noGutter-middle_sm-1">
                            <div class="l-grid__col-4_xs-12_sm-6">
                                <div class="c-logo">
                                    <a href="/"><img src="./images/c-logo.png" alt=""></a>
                                </div>
                            </div>
                            <div class="l-grid__col-8_xs-12_sm-6">
                                <div class="c-copyright">
                                    <a href="#">© {{TransWord::getArabic('2',false)}}{{TransWord::getArabic('0',false)}}{{TransWord::getArabic('1',false)}}{{TransWord::getArabic('7',false)}} {{TransWord::getArabic('All rights reserved')}}.</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </section>
</div>
