@section('js')
	@parent
	{{ HTML::script('front/js/registration_company.js') }}
@endsection

<div class="req_com_modal">
    <div class="req_com_modal__content shadow">
        <span class="req_com_modal__steps">
            <span class="step_1 active js-req-com-step" data-id='1'> {{TransWord::getArabic('Step 1',false)}} </span>
            <span class="step_2 js-req-com-step" data-id='2'> {{TransWord::getArabic('Step 2',false)}} </span>
            <span class="step_3 js-req-com-step" data-id='3'> {{TransWord::getArabic('Step 3',false)}} </span>
        </span>
        <span class="req_com_modal__close" style='z-index: 100;'></span>
        <form class='main_from_req_company ' method="post" enctype="multipart/form-data" action="{{ action('CompanyController@postRegistration') }}">
           <?php // <input type='hidden' name="type_id" class='reg_company_type_id' value="{{ SysCompanyType::getDiningID() }}" /> ?>

            <div class="req_com_modal__body active" id='req_com_tab_1'>
                <h3> {{TransWord::getArabic('Commercial account registration',false)}}</h3>
                <div class="row ">
                    <div class="col-md-100">
                        {{  Form::select('city_id', array(null => TransWord::getArabic('Select Emirate',false)) + SysCity::getCityAr(), null, array('class'=>'b_sel_blue  normalValidate registr_company_city')) }}
                    </div>
                </div>
                <div class="row">
					<?php
                    // <div class="col-md-33">
                    //    <button class="b_com_cat_dining js_com_cat active" data-id='{{ SysCompanyType::getDiningID() }}' type='button'>
                    //         {{TransWord::getArabic('Dining & Outing',false)}}
                    //    </button>
                    // </div>
				    ?>
                    <div class="col-md-33">
                        <button class="b_com_cat_shop js_com_cat" data-id='{{ SysCompanyType::getShopID() }}' type='button'>
                             {{ TransWord::getArabic('STORES',false) }}
                        </button>
                    </div>
                    <div class="col-md-33">
                        <button class="b_com_cat_service js_com_cat" data-id='{{ SysCompanyType::getServiceID() }}' type='button'>
                             {{TransWord::getArabic('SERVICE PROVIDERS',false)}}
                        </button>
                    </div>
                </div>

				<?php
                 #<div class="b_com_cat open dinning-cat-block" id='b_com_cat_{{ SysCompanyType::getDiningID() }}'>
                 #   <div class="row dinning_cats">
                 #       <div class="col-md-85">
                 #           {{  Form::select('cat_id['.SysCompanyType::getDiningID().'][]', array(null=>'Add "Dinning & Outing" category') + SysCompanyCat::where('type_id', SysCompanyType::getDiningID())->orderBy('name', 'asc')->lists('name', 'id'), null, array('class'=>'b_sel_blue normalValidate reg_company_cat_id')) }}
                 #       </div>
				 #		<div class="col-md-10 col-md-offset-5" >
				 #			<a href='#delete_cat' class='del-company-cat' style='position: relative; top: 14px; font-size: 12px; color: #dd2c00; text-decoration: underline; display: none;'>{{TransWord::getArabic('Delete',false)}}</a>
				 #		</div>
                 #   </div>
			     #	<div class="row">
                 #      <div class="col-md-100">
				 #			<a href="#add" class='link_plus' data-cat='dinning' data-block='dinning'>
				 #				<img src="/front/img/icons/link_plus.png"/>
				 #				{{TransWord::getArabic('Add <strong>Category</strong>',false)}}
				 #				</a>
				 #		</div>
				 #	</div>
                 #</div>
                ?>

                <div class="b_com_cat shop-cat-block" id='b_com_cat_{{ SysCompanyType::getShopID() }}'>
                    <div class="row shop_cats">
                        <div class="col-md-40">
                            {{  Form::select('cat_id['.SysCompanyType::getShopID().'][]', array(null=>'Select store category') + SysCompanyCat::where('type_id', SysCompanyType::getShopID())->orderBy('name', 'asc')->lists('name', 'id'), null, array('class'=>'b_sel_blue  normalValidate reg_company_cat_id js_reg_com_cat')) }}
                        </div>
                        <div class="col-md-40 col-md-offset-5">
                            {{  Form::select('subcat_id['.SysCompanyType::getShopID().'][]', array(), null, array('class'=>'b_sel_blue reg_company_subcat_id hide', 'multiple'=>'multiple', 'size'=>"2")) }}
                        </div>
						<div class="col-md-10 col-md-offset-5" >
							<a href='#delete_cat' class='del-company-cat' style='position: relative; top: 14px; font-size: 12px; color: #dd2c00; text-decoration: underline; display: none;'>{{TransWord::getArabic('Delete',false)}}</a>
						</div>
                    </div>
					<div class="row">
                        <div class="col-md-45">
							<a href="#add" class='link_plus' data-cat='shop' data-block='shop'>
								<img src="/front/img/icons/link_plus.png"/>
								{{TransWord::getArabic('Add <strong>Store</strong>',false)}}
							</a>
						</div>
						<div class="col-md-45 col-md-offset-5">
							<a href="#add" class='link_plus' data-cat='service' data-block='shop'>
								<img src="/front/img/icons/link_plus.png"/>
								{{TransWord::getArabic('Add <strong>Service Provider</strong>',false)}}
								</a>
						</div>
					</div>
                   

                </div>

                <div class="b_com_cat service-cat-block" id='b_com_cat_{{ SysCompanyType::getServiceID() }}'>
                    <div class="row service_cats">
                        <div class="col-md-40">
                            {{  Form::select('cat_id['.SysCompanyType::getServiceID().'][]', array(null=>'Select service provider category') + SysCompanyCat::where('type_id', SysCompanyType::getServiceID())->orderBy('name', 'asc')->lists('name', 'id'), null, array('class'=>'b_sel_blue normalValidate reg_company_cat_id js_reg_com_cat')) }}
                        </div>
                        <div class="col-md-40 col-md-offset-5">
                            {{  Form::select('subcat_id['.SysCompanyType::getServiceID().'][]', array(), null, array('class'=>'b_sel_blue reg_company_subcat_id hide', 'multiple'=>'multiple', 'size'=>"2")) }}
                        </div>
						<div class="col-md-10 col-md-offset-5" >
							<a href='#delete_cat' class='del-company-cat' style='position: relative; top: 14px; font-size: 12px; color: #dd2c00; text-decoration: underline; display: none;'>{{TransWord::getArabic('Delete',false)}}</a>
						</div>
                    </div>
					<div class="row">
						<div class="col-md-45 ">
							<a href="#add" class='link_plus' data-cat='service' data-block='service'>
								<img src="/front/img/icons/link_plus.png"/>
								{{TransWord::getArabic('Add <strong>Service Provider</strong>',false)}}
							</a>
						</div>
                        <div class="col-md-45 col-md-offset-5">
							<a href="#add" class='link_plus' data-cat='shop' data-block='service'>
								<img src="/front/img/icons/link_plus.png"/>
								{{TransWord::getArabic('Add <strong>Store</strong>',false)}}
							</a>
						</div>
					</div>

                </div>

                <div class="req_com_modal__footer">
                    <button class="b_com_back js-bot_step" data-id='0' type='button'>
                        <img src="/front/img/icons/link_before.png" /> {{TransWord::getArabic('Cancel',false)}}
                    </button>

                    <button class="b_com_next js-bot_step" data-id='2' type='button'>
                         {{TransWord::getArabic('Next',false)}}
                         <img src="/front/img/icons/link_next.png" />
                    </button>
                </div>
            </div>
            <div class="req_com_modal__body" id='req_com_tab_2'>
                <h3> {{TransWord::getArabic('Commercial account registration',false)}}</h3>

                <div class="row">
                    <div class="col-md-40">
                        <div class="youtube_block_img">
                            <img src="/front/img/youtube_bg.png" class="youtube_block_img__bg">
                            <a class="popup-youtube" href="https://www.youtube.com/watch?v=PBDZFv8oSd8?showinfo=0&enablejsapi=1&origin=https://zaza.ae:8350"><img src="/front/img/icons/play_icon.png" class="youtube_block_img__play"></a>
                        </div>

                        <a href="#link" class="link_yout_channel" >
                            {{TransWord::getArabic('Watch all tutorial videos in our <br /><b>youtube channel</b>',false)}}

                            <img src="/front/img/icons/youtube_play.png">
                        </a>

                        <div class="license_block">
                            <h4 class="license_block__title"> {{TransWord::getArabic('Upload company license',false)}}</h4>
                            <div class='license_block__input'>
								<input type='hidden' class="license_block__hidden" name="license[]">
                                <input class='js_req_upload_file' type="file" name="image"  />
                                <span class="text">
                                    <span class="text_blue"> {{TransWord::getArabic('Choose your file...',false)}}</span> <br />
                                    {{TransWord::getArabic('jpg, png, bmp, pdf up to 2 mb',false)}}
                                </span>
                                <img class='license_block__image js_req_upload_image' />
                                <img class='js_add_license' src="/front/img/icons/link_plus.png" />
                            </div>
                        </div>



                        <div class="upload_logo">
							<input type='hidden' class="upload_logo__hidden" name="logo">
                            <input class="upload_logo__file" type="file" name="img"  />
                            <div class="upload_logo__circle"> {{TransWord::getArabic('Upload logo (jpg, bmp, png up to 1mb)',false)}}</div>
                        </div>

                    </div>

                    <div class="col-md-55 col-md-offset-5">
                        <div class="row js-company-field">
                            <div class="col-md-90">
                                <input class="b_req_input normalValidate" required="required" type="text" placeholder="{{TransWord::getArabic('Company name',false)}}" name='title_1'/>
                            </div>
                        </div>
						<div class="row js-restoran-field">
                            <div class="col-md-90">
                                <input class="b_req_input normalValidate" required="required" type="text" placeholder="{{TransWord::getArabic('Trade name',false)}}" name='title_2'/>
                            </div>
                        </div>
						<div class="row js-restoran-field">
                            <div class="col-md-90 js-input">
                                {{  Form::select('cousine_id[]', array(Null=>'Cuisine') + SysAdRestoranCousine::orderBy('name', 'asc')->lists('name', 'name'), null, array('class'=>'b_req_input normalValidate js-counsinea' , 'required'=>'required', 'placeholder'=>'Cuisine')) }}
                            </div>
							<div class="col-md-5 col-md-offset-5">
                                <img src="/front/img/icons/link_plus.png" class="b_req_input_add" data-type='jaosdfjoasidf'/>
                            </div>
                        </div>
						
                        <div class="row js-company-field">
                            <div class="col-md-90">
                                <input class="b_req_input normalValidate" required="required" type="text" placeholder="{{TransWord::getArabic('Activity',false)}}" maxlength="60" name='activity' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-90 js-input">
								<input class="b_req_input normalValidate" required="required" id="txtPlacesCompany" type="text" placeholder="{{TransWord::getArabic('Location',false)}}" name='location[]' />

                            </div>
							<div class="col-md-5 col-md-offset-5 js-company-field">
                                <img src="/front/img/icons/link_plus.png" class="b_req_input_add" data-type='location'/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-90 js-input">
                                <input class="phone_uae b_req_input normalValidate" required="required" type="text" placeholder="{{TransWord::getArabic('Phone',false)}}" name='phone[]' />
                            </div>
							<div class="col-md-5 col-md-offset-5 js-company-field">
                                <img src="/front/img/icons/link_plus.png" class="js_aosdfkaposdfk" style='margin-top: 12px;
																										cursor: pointer;
																										width: 17px;
																										height: 17px;'/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-90 js-input">
                                <input class="phone_uae b_req_input" type="text" placeholder="{{TransWord::getArabic('Mobile',false)}}" name='mobile[]' />
                            </div>
							<div class="col-md-5 col-md-offset-5 js-company-field">
                                <img src="/front/img/icons/link_plus.png" class="asdasdasczxcsa2123123asd" style='margin-top: 12px;
																										cursor: pointer;
																										width: 17px;
																										height: 17px;'/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-90">
                                <input class="b_req_input " type="text" placeholder="{{TransWord::getArabic('Website (not mandatory)',false)}}" name='web_site' />
                            </div>
                        </div>
						<div class="row js-restoran-field">
							<div class='col-md-90 js-restoran-branch-add' style="border-top: 1px solid #d41f26;border-bottom: 1px solid #d41f26;padding: 5px 0 10px 16px;margin: 15px 0;cursor: pointer;">
								<img src="/front/img/icons/link_plus.png" style='position: relative; top: 4px;' /> 
								<a href='#add-branch' style='border-bottom: 1px dotted black;'>{{TransWord::getArabic('Add <strong>more branch</strong>',false)}}</a>
							</div>
						</div>
						<div class="row js-restoran-sample-branch" style='display: none;'>	
							<div class="col-md-90 " style='margin-top: 15px; border-top: 1px solid #d41f26;'>
								<input class="b_req_input normalValidate" required="required" id="txtPlaces" type="text" placeholder="{{TransWord::getArabic('Location',false)}}" name='location[]' />
                            </div>
							<div class="col-md-90 " style='margin-bottom: 15px; border-bottom: 1px solid #d41f26;'>
                                <input class="phone_uae b_req_input normalValidate" required="required" type="text" placeholder="{{TransWord::getArabic('Phone',false)}}" name='phone[]' />
                            </div>
						</div>
						<div class="row">
                            <div class="col-md-90">
                                <input class="b_req_input normalValidate js_check_user_isset_mail" required="required" type="email" placeholder="{{TransWord::getArabic('Email',false)}}" name='email' />
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-90">
								<input class="b_req_input text_blue min6symbolValidate password1" id="pass1" type="password" required="required" placeholder="{{TransWord::getArabic('Password',false)}}" name='password' >
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-90">
								<input class="b_req_input text_blue ValidatePassword password2" id="pass2" type="password"  required="required" placeholder="{{TransWord::getArabic('Repeat password',false)}}" name='re_password' >
                            </div>
                        </div>
						<div class="row">
							<div class="col-md-90">
								<span id="confirmMessage" class="confirmMessage"></span>
							</div>
						</div>
                    </div>
                </div>

                <div class="req_com_modal__footer">
                    <button class="b_com_back js-bot_step" data-id='1' type='button'>
                        <img src="/front/img/icons/link_before.png" /> {{TransWord::getArabic('Back to step 1',false)}}
                    </button>

                    <button class="b_com_next js-bot_step" id="buttonActivate" data-id='3' type='button'>
                         {{TransWord::getArabic('Next',false)}}
                         <img src="/front/img/icons/link_next.png" />
                    </button>
                </div>
            </div>
            <div class="req_com_modal__body" id='req_com_tab_3' style='overflow: hidden;'>
				<div class='js-registr-company-restoran'>
					<div class="plan_prem" style='position: relative; top: -21px; width: 110% !important;     left: -5%;     border-radius: 0 !important; box-shadow: none !important;'>
						<div class="plan_prem__header__sale">
							<strong>{{ TransWord::getArabic('Special offer only for the first 100 registered accounts',false) }}</strong>  <br /> 
							<span class="plan_prem__header__sale__line"><span class="plan_prem__header__sale__normal">{{TransWord::getArabic('AED',false)}} 199</span></span> &nbsp; {{TransWord::getArabic('AED',false)}} 0!
						</div>
						<div class="row">
							<div class="col-md-50">
								<div class="plan_free" style='    box-shadow: none;'>
									<div class="plan_free__body">
										<div class="plan_free__punkt">
											<img src="/front/img/icons/select-red-icon.png"> {{TransWord::getArabic('Cash',false)}} {{TransWord::getArabic('AED',false)}} 555 {{TransWord::getArabic('in the account',false)}}
										</div>
										<div class="plan_free__punkt">
											<img src="/front/img/icons/select-red-icon.png"> {{TransWord::getArabic('1 year registration',false)}}
										</div>
										<div class="plan_free__punkt">
											<img src="/front/img/icons/select-red-icon.png"> {{TransWord::getArabic('Presentable profile',false)}}
										</div>
										<div class="plan_free__punkt">
											<img src="/front/img/icons/select-red-icon.png"> {{TransWord::getArabic('Photo gallery, Menu, Meals',false)}}
										</div>
										<div class="plan_free__punkt">
											<img src="/front/img/icons/select-red-icon.png"> {{TransWord::getArabic('Shares & Reviews',false)}}
										</div>
										<div class="plan_free__punkt">
											<img src="/front/img/icons/select-red-icon.png"> {{TransWord::getArabic('Online Chat',false)}}
										</div>
										<div class="plan_free__punkt">
											<img src="/front/img/icons/select-red-icon.png"> {{TransWord::getArabic('Followers',false)}}
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-45 col-md-offset-5"><br /><br />
								<img src='/front/img/paid.png' style='width: 90%;'>
							</div>
						</div>
					</div>
				</div>
				<div class='js-registr-company-other'>
					<div class="plan_prem" style='position: relative; top: -21px; width: 110% !important;     left: -5%;     border-radius: 0 !important; box-shadow: none !important;'>
					{{--<div class="plan_prem__header">
							{{TransWord::getArabic('PREMIUM',false)}} <strong>({{TransWord::getArabic('AED',false)}} 0)</strong>
					</div>--}}
						<div class="plan_prem__header__sale">
						   <strong>{{ TransWord::getArabic('Special offer only for the first 100 registered accounts',false) }}</strong> <br />
						   <span class="plan_prem__header__sale__line"><span class="plan_prem__header__sale__normal">{{TransWord::getArabic('AED',false)}} 199</span></span> &nbsp; {{TransWord::getArabic('AED',false)}} 0!
							   {{--<span class="plan_prem__header__sale__line">
								<span class="plan_prem__header__sale__normal"> {{TransWord::getArabic('AED',false)}} 225 </span>
							   </span>
							 &nbsp; &nbsp; {{TransWord::getArabic('AED',false)}} 0--}}
						</div>
						<div class="row">
							<div class="col-md-60 col-md-offset-3">
								<div class="plan_free__body">
									<div class="plan_free__punkt">
										<img src="/front/img/icons/select-red-icon.png"> {{TransWord::getArabic('Cash',false)}} {{TransWord::getArabic('AED',false)}} 555 {{TransWord::getArabic('in the account',false)}}
									</div>
									<div class="plan_free__punkt">
										<img src="/front/img/icons/select-red-icon.png"> {{TransWord::getArabic('1 year registration',false)}}
									</div>
									<div class="plan_free__punkt">
										<img src="/front/img/icons/select-red-icon.png"> {{TransWord::getArabic('Presentable company profile',false)}}
									</div>
									<div class="plan_free__punkt">
										<img src="/front/img/icons/select-red-icon.png"> {{TransWord::getArabic('Chat',false)}}
									</div>
									<div class="plan_free__punkt">
										<img src="/front/img/icons/select-red-icon.png"> {{TransWord::getArabic('Photo gallery of goods and services',false)}}
									</div>
									<div class="plan_free__punkt">
										<img src="/front/img/icons/select-red-icon.png"> {{TransWord::getArabic('Rating',false)}}
									</div>
									<div class="plan_free__punkt">
										<img src="/front/img/icons/select-red-icon.png"> {{TransWord::getArabic('Blog & shares',false)}}
									</div>
									<div class="plan_free__punkt">
										<img src="/front/img/icons/select-red-icon.png"> {{TransWord::getArabic('Call back',false)}}
									</div>
									<div class="plan_free__punkt">
										<img src="/front/img/icons/select-red-icon.png"> {{TransWord::getArabic('Followers',false)}}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
                <div class="req_com_modal__footer">
					
					
					<div style='width: 100%;'>
						<p style='font-size: 11px; display: block; width: 40%; float: left;'>
							<input type="checkbox" class='normalValidate js-check-regist-company-agree' name='agree' value='1'> 
							<span>{{TransWord::getArabic('I have read',false)}} <a href='#terms' class='js_call_modal_terms' style='color: #15499f;'>{{TransWord::getArabic('Terms & Conditions',false)}}</a> {{TransWord::getArabic('and agree to abide by them',false)}}.</span>
						</p>
						<button class="b_com_next js_req_com_complite " type='button' style='width: 200px !important;'>
							{{TransWord::getArabic('Complete registration',false)}}
						</button>
					</div>
                </div>
            </div>
			<input type='hidden' class="js_select_req_plan__value" name='is_vip' value="1">
		</form>

    </div>
</div>


<script type="text/javascript">
jQuery(function($){
	$.mask.definitions['9'] = '';
	$.mask.definitions['n'] = '[0-9]';
   $(".phone_uae").mask("+ (971) nn nnn-nnnn");
});


$(document).ready(function() {
	$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
		disableOn: 700,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,

		fixedContentPos: true
	});
});

$(document).ready(function() {
	$('.popup-gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function(item) {
				return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
			}
		}
	});
});

// function checkPass()
// {
    // //Store the password field objects into variables ...
    // var pass1 = document.getElementById('pass1');
    // var pass2 = document.getElementById('pass2');
    // //Store the Confimation Message Object ...
    // var message = document.getElementById('confirmMessage');
    // //Set the colors we will be using ...
    // var goodColor = "#66cc66";
    // var badColor = "#ff6666";
    // //Compare the values in the password field 
    // //and the confirmation field
    // if(pass1.value == pass2.value){
        // //The passwords match. 
        // //Set the color to the good color and inform
        // //the user that they have entered the correct password 
        // pass2.style.backgroundColor = goodColor;
        // message.style.color = goodColor;
        // message.innerHTML = "Passwords Match!";
		// $("#buttonActivate").prop('disabled',false)
		
    // }else{
        // //The passwords do not match.
        // //Set the color to the bad color and
        // //notify the user.
        // pass2.style.backgroundColor = badColor;
        // message.style.color = badColor;
        // message.innerHTML = "Passwords Do Not Match!"
    // }
// }  

</script>
