@extends('front.layout')
@section('content')

<section class="c-avd">
            <div class="c-line c-line--blue">
				{{ TransWord::getArabic('Banner advertising with zaza.ae - Highly efficient advertising!') }}
            </div>
            <div class="c-avdform">
				{{ Form::open(array('url'=>action('BannerController@postItem'), 'method' => 'post', 'role'=>'form', 'files'=>true)) }}
                    <div class="c-avdform__header">
                        <div class="c-avdform__head">
                            <div class="c-avdform__head__text">
                                <i class="icon-2 c-avdform__icon"></i>
                               {{ TransWord::getArabic('Next available date is') }}
                            </div>
                            <div class="c-avddate">
                                <span class="c-avddate__item">{{ $wish_day+2 }}</span>
                                <span class="c-avddate__item">{{ $wish_month }}</span>
                                <span class="c-avddate__item">{{ $wish_year }}</span>
                            </div>
                            <div class="c-avdform__head__text">{{ TransWord::getArabic('onwards') }}</div>
                        </div>
                    </div>
                    <div class="c-avdform__body">
                        <div class="l-container">
                            <div class="l-container-small">
                                <div class="c-avdform__info">
                                    <div class="l-grid-noGutter_top_xs-12">
                                        <div class="l-grid__col-8">
                                            <h5>{{ TransWord::getArabic('Please, fill the application') }}<span class="c-avdform__info--red">*</span>:</h5>
                                            <p>{{ TransWord::getArabic('“Kindly note that, only the Business Entities registered in UAE may apply for the Banner Advertising with zaza.ae. In any other case, please email to sales@zaza.ae”') }}</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="l-grid-noGutter">
                                    <div class="l-grid__col-8_xs-12">
                                        <div class="c-avdform__field__list">
                                            <div class="c-avdform__field">
												{{ Form::text('name', null, array('class'=>'c-avdform__input', 'placeholder'=>TransWord::getArabic('Company name', false), 'required')) }}
                                            </div>
                                            <div class="c-avdform__field">
												{{ Form::text('location', null, array('class'=>'c-avdform__input c-avdform__input__withicon ', 'placeholder'=>TransWord::getArabic('Location', false), 'required')) }}
                                                <div class="c-avdform__field__icon icon-39"></div>
                                            </div>
                                            <div class="c-avdform__field">
												{{ Form::text('contact', null, array('class'=>'c-avdform__input ', 'placeholder'=>TransWord::getArabic('Contact phone number', false), 'required')) }}
                                            </div>
                                            <div class="c-avdform__field" style="display: none;">
                                                {{ Form::text('recipient', 'sales@zaza.ae', array('class'=>'c-avdform__input ', 'placeholder'=>TransWord::getArabic('recipient', false), 'required')) }}
                                            </div>
                                            <div class="c-avdform__field">
												{{ Form::text('email', null, array('class'=>'c-avdform__input ', 'placeholder'=>TransWord::getArabic('Email', false), 'required')) }}
                                            </div>
                                            <div class="c-avdform__field">
												{{ Form::text('person', null, array('class'=>'c-avdform__input ', 'placeholder'=>TransWord::getArabic('Contact person', false), 'required')) }}
                                            </div>
											<div class="c-avdform__field">
												<input placeholder="{{ TransWord::getArabic('Requested starting date of the advertising', false) }}" class='c-avdform__input' type="text" onfocus="(this.type='date')" name="publish_date" required /> <!---- change 1 ---->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="l-grid__col-4_xs-12">
                                        <div class="c-avdform__field">
                                            <div class="c-upload">
                                                <h5 class="c-upload__head">{{ TransWord::getArabic('Upload company license') }}</h5>
                                                <div class="c-upload__body">
                                                    <div class="c-upload__field">

                                                        <div class="c-upload__field--blue">{{ TransWord::getArabic('Choose your file...') }}</div>
                                                        <div class="c-upload__field--grey">{{ TransWord::getArabic('jpg, png, bmp, pdf up to 2 mb') }}</div>
                                                        <div class="c-upload__icon">
                                                            <a href="#" class="c-button"><i class="c-button__icon icon-16"></i></a>
                                                        </div>

                                                    </div>
                                                    <img src="/upload/company/1477891958_pkLnrcl.jpg" class="js_blog_photo_preview" style="display: none; margin: 10px auto; width: 150px;"> <!--- change 2 -->
                                                    <div class="c-upload__submit">
                                                        <div class="c-button c-button--blue">
														<span style="width: 90%;cursor: pointer;position: absolute;">{{ TransWord::getArabic('Upload') }}</span>
														{{ Form::file('license', array('class'=>'js-form-blog-file','style'=>'opacity:0;width: 100%;cursor:pointer;',  'required')) }}
														
														<!--	<input class='add_ad_feilds__upload_file' type="file" name="license"/> -->
														</div>
														
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-line c-line--grey"></div>
                        </div>
                        <div class="l-container">
                            <div class="l-container-small">
                                <div class="c-avdform-download">
                                    <div class="c-avdform-download__header">
                                       {{ TransWord::getArabic('Upload your Advertising') }}
                                    </div>
                                    <div class="c-avdform-download__info">
                                        {{ TransWord::getArabic('Image:') }} <span> {{ TransWord::getArabic('jpg, png, size max. 500 kb. resolution min. 1280x800 px') }}</span>
                                    </div>
                                    <div class="c-avdform-download__body">
                                        <h5>{{TransWord::getArabic('Review your Advertising at the same time',false)}}</h5>
                                        <div class="c-avdform-download__image">
											{{ Form::file('banner', array('class'=>'js_avdform_photo_upload','style'=>'opacity:0;position:absolute;z-index: 4;width: 100%;height: 100%;cursor:pointer;', 'required')) }}
                                            <img src="../images/c-avdform-download.png" alt="" class="js_avdform_photo_preview">
                                            <span class="bg"></span>
                                            <i class="c-avdform-download__icon icon-16"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-line c-line--grey"></div>
                        </div>

                    </div>
                    <div class="c-avdform__footer">
                        <div class="l-container">
                            <div class="l-container-small">
                                <div class="l-grid">
                                    <div class="l-grid__col-6_xs-12">
                                        <div class="c-avdform__advertising">
                                            <div class="c-avdform__advertising__title"> {{ TransWord::getArabic('Post Advertising for') }}</div>
                                            <div class="c-avdform__advertising__days"> {{ TransWord::getArabic('Days (min. 7 days)') }}</div>
                                            <div class="l-grid">
                                                <div class="l-grid__col-4_md-6">
                                                    <div class="c-avdform__field">
														{{ Form::number('days', null, array('class'=>'c-avdform__input js-avdform_count-input', 'placeholder'=>'7', 'required', 'min'=>'7')) }}
                                                    </div>
                                                    <div class="c-avdform__advertising__oneday">{{ TransWord::getArabic('1 day is') }} <span>{{TransWord::getArabic('AED',false)}} 2200 <i class="crossed"></i></span><div class="c-avdform__advertising__price">{{TransWord::getArabic('AED',false)}} 395</div></div>
                                                    
                                                </div>
                                                <div class="l-grid__col-4_md-6">
                                                    <div class="c-avdform__advertising__currency">{{TransWord::getArabic('AED',false)}} 2765</div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="l-grid__col-6_xs-12">
                                        <div class="c-avdform-submit">
                                            <div class="c-avdform-submit__header">
                                                <!-- <i class="c-avdform-submit__icon icon-32"> --><!-- </i> -->
                                                <div class="c-avdform-submit_text">
                                                <input type="checkbox" name="" class="regular-checkbox" onchange="isChecked(this, 'sub1')">
                                                    {{ TransWord::getArabic(' We (Advertiser) have read the') }} <a href="#">{{ TransWord::getArabic('Banner Advertising Policy') }}</a>
                                                    {{ TransWord::getArabic('and agree to abide by them.') }}
                                                </div>
                                            </div>
                                            <div class="c-avdform-submit__body">
                                                <button type="submit" class="myC-button c-button c-button--blue c-avdform-submit__button" disabled="disabled" id="sub1" style="background-color: gray;border-color: gray;"><i class="c-avdform-submit__icon icon-53"></i> <span>{{ TransWord::getArabic('Submit') }}</span></button>
                                            </div>
                                            <div class="c-avdform-submit__footer">
                                                <p>{{ TransWord::getArabic('After submitting this application, the invoice will be forwarded to the mentioned email shortly, to process the payment.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
			{{ Form::close() }}
            </div>
            <!-- {{ Form::open(array('url'=>action('BannerController@postBannerMessage'), 'method' => 'post', 'role'=>'form', 'files'=>true)) }}

                <div>
                                                <button type="submit" style="background-color: gray;border-color: gray;"> <span>{{ TransWord::getArabic('Submit') }}</span></button>
                                            </div>
            {{ Form::close() }} -->
            <footer class="c-footer">
                <div class="c-line c-line--green">
                    {{ TransWord::getArabic('The reasons to place your avdertising with Zaza.AE:') }}
                </div>
                <div class="l-container">
                    <div class="c-footer-checklist">
                        <ul class="c-footer-checklist__list">
                            <li class="c-footer-checklist__item"><i class="c-footer-checklist__icon icon-33"></i>{{ TransWord::getArabic('Your Advertising will be placed entire the main page, to be visible for every single visitor of the website.') }}</li>
                            <li class="c-footer-checklist__item"><i class="c-footer-checklist__icon icon-33"></i> {{ TransWord::getArabic('Per day main page allocated for 10 Ads only! Each Ad is changing every 5 sec.') }}</li>
                            <li class="c-footer-checklist__item"><i class="c-footer-checklist__icon icon-33"></i> {{ TransWord::getArabic('Reasonable price.') }}</li>
                            <li class="c-footer-checklist__item"><i class="c-footer-checklist__icon icon-33"></i> {{ TransWord::getArabic('By Placing Banner Advertising with ZAZA.AE you shall expect excellent deals and best offers soon.') }}</li>
                            <li class="c-footer-checklist__item"><i class="c-footer-checklist__icon icon-33"></i> {{ TransWord::getArabic('The audience of ZAZA.AE are individuals and all kind of Business Entities, which will bring your Advertising to the higher level of efficiency.') }}</li>
                        </ul>
                    </div>
                </div>
            </footer>
        </section>
        <script type="text/javascript">
        	function isChecked(checkbox, sub1) {
			    var button = document.getElementById(sub1);

			    if (checkbox.checked === true) {
			        button.disabled = "";
			        $('#sub1').css('background-color', '#15499f');
			        $('#sub1').css('border-color', '#15499f');


			    } else {
			        button.disabled = "disabled";
			        $('#sub1').css('background-color', 'gray');
			        $('#sub1').css('border-color', 'gray');
			    }
			}

			

        	
        </script>

        
@stop
