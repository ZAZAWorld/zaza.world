<div class="c-settingspanel js-modal-main-settnig">
    <form action="{{ action('CompanyRestoranController@postMainSetting') }}" class="c-settingsform js-form-res-main-setting" method="post">
        <div class="l-grid-top_sm-12">
            <div class="l-grid__col-6_md-6_sm-6_xs-6">
                <div class="c-settingsform__field">
                    <input name="title" type="text" class="c-settingsform__input c-settingsform__input--blue" placeholder="{{TransWord::getArabic('Name',false)}}" value='{{ $company->title }}'>
                </div>
                <div class="c-settingsform__field">
                    <div class="l-grid">
                        <div class="l-grid__col-4">
                            <div class="c-settingsform__label">
                                {{TransWord::getArabic('Category')}}:
                            </div>
                        </div>
                        <div class="l-grid__col-8">
                            <div class="c-category">
                                <div class="c-category__list">
                                    <div class="c-selected js-list-restoran-cat">
										@foreach ($company->relCat as $cat) 
											<div class="c-selected__item">
												<div class="c-selected__title">{{TransWord::getArabic($ar_cats[$cat->cat_id],false)}}</div>
												<input type='hidden' name='cat[]' value='{{ $cat->cat_id }}'>
												<a href="#del-cat" class="c-delete js-del-restoran-cat">
													<i class="c-delete__icon icon-52"></i>
												</a>
											</div>
										@endforeach
                                    </div>
                                </div>
                                <div class="c-select js-sel-restoran-cat-group">
									<!--
										<div class="c-select__addlist">
											<a href="#" class="c-button"><i class="c-button__icon icon-16"></i></a>
										</div>
									-->
                                    <div class="c-select__dropdown">
                                        <span class="c-select__arrow"></span>
                                        {{TransWord::getArabic('Select category')}}
                                    </div>
                                    <div class="c-select__list ">
										@foreach ($ar_cats as $k=>$name)
											<div class="c-select__item">
												<a href="#add-cat" class="c-select__link js-sel-restoran-cat" data-id='{{ $k }}'>{{TransWord::getArabic($name,false)}}</a>
											</div>
										@endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="l-grid">
                        <div class="l-grid__col-4">
                            <div class="c-settingsform__label">
                                {{TransWord::getArabic('Cuisine')}}:
                            </div>
                        </div>
                        <div class="l-grid__col-8">
                            <div class="c-cuisine">
                                <div class="c-cuisine__list">
                                    <div class="c-selected js-list-restoran-cousine">
										@foreach ($restoran->cousine as $cou_name)
											<div class="c-selected__item">
												<div class="c-selected__title">{{TransWord::getArabic($cou_name,false)}}</div>
												<input type='hidden' name='cousine[]' value='{{ $cou_name }}'>
												<a href="#" class="c-delete js-del-restoran-cousine">
													<i class="c-delete__icon icon-52"></i>
												</a>
											</div>
										@endforeach
                                    </div>
                                </div>
                                <div class="c-select">
									<div class="c-select__dropdown">
                                        <span class="c-select__arrow"></span>
                                        {{TransWord::getArabic('Select cuisine')}}
                                    </div>
                                    <div class="c-select__list">
										@foreach ($ar_cousine as $k=>$name)
											<div class="c-select__item">
												<a href="#add-cat" class="c-select__link js-sel-restoran-cousine">{{TransWord::getArabic($name,false)}}</a>
											</div>
										@endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="c-settingsform__field">
                    <div class="c-settingsform__label c-settingsform__label--strong">
                        <div class="l-grid">
                            <div class="l-grid__col-8">
                                {{TransWord::getArabic('Greetings')}}
                                <span class="c-settingsform__label__desc">{{TransWord::getArabic('30 symbols only',false)}}</span>
                            </div>
							<div class="l-grid__col-4">
								<div class="onoffswitch" style="float: right;">
									<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox js_is_greeting_call" id="myonoffswitch" {{ ($company->is_greeting ? 'checked' : null) }}>
									<label class="onoffswitch-label" for="myonoffswitch">
										<span class="onoffswitch-inner"></span>
										<span class="onoffswitch-switch"></span>
									</label>
								</div>
								<input type='hidden' name='is_greeting' value='{{ $company->is_greeting }}' class='js_is_greeting_input'>
							</div>
                        </div>
                        <input name='greeting' type="text" class="c-settingsform__input" placeholder="" maxlength="30" value="{{ $company->greeting }}">
                    </div>
                </div>
                <div class="c-settingsform__field">
                    <div class="c-costform">
                        <div class="l-grid">
                            <div class="l-grid__col-8">
                                <div class="c-settingsform__label">
                                    {{TransWord::getArabic('Cost for 2 people',false)}} ({{TransWord::getArabic('AED')}}):
                                </div>
                            </div>
                            <div class="l-grid__col-4">
                                <input name='cost_for_2' type="text" class="c-settingsform__input c-settingsform__input--blue" placeholder="" value="{{ $restoran->cost_for_2 }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="c-settingsform__field">
                    <div class="c-settingsform__textfield">
                        {{TransWord::getArabic('Your login')}}: <strong><input type="text" class="form_update_input" value="{{ $user->email }}" disabled='disabled'  name="email" data-id='email' data-type='user' data-before=''></strong>
                    </div>
					 
					<span class="form_update_ok hide" data-id='email'>
						&#10004;
					</span>
					<span class="form_update_cancel hide" data-id='email'>
						&#10006;
					</span>
					<span class="form_update_pencil" data-id='email'>
						<img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
					</span>
                </div>
            </div>
            <div class="l-grid__col-6_md-6_sm-6_xs-6">
                <div class="c-settingsform__field js-list-contacs-button">
					<?php $i = 0; ?>
					@foreach ($company->phone_ar as $k=>$phone)
						<?php $i++; ?>
						<div class="c-settingsform__contacts">
							<div class="c-formcontacts">
								<div class="c-formcontacts__list">
									<div class="c-formcontacts__item">
										<div class="c-formcontacts__label">{{TransWord::getArabic('Telephone')}}:</div>
										<div class="c-formcontacts__text">
											<input type='text' name='phone[]' class='phone_uae form_update_input js-edit-contacs' value='{{ $phone }}' />
										</div>
									</div>
									<div class="c-formcontacts__item">
										<div class="c-formcontacts__label">{{TransWord::getArabic('Location')}}:</div>
										<div class="c-formcontacts__text">
											<input type='text' name='location[]' class='form_update_input js-edit-contacs'  value='{{ (isset($company->location_ar[$k]) ? $company->location_ar[$k] : null) }}' />
										</div>
									</div>
								</div>
								<a href="#" class="c-button c-formcontacts--edit js-edit-contacs-button" data-edit='0'><i class="c-button__icon icon-57"></i></a>
							</div>
							@if ($i == 1)
								<a href="#" class="c-button c-formcontacts--add js-add-contacs-button" ><i class="c-button__icon icon-16"></i></a>
							@else 
								<a href="#" class="c-button c-formcontacts--add js-del-contacs-button" ><i class="c-button__icon icon-17"></i></a>
							@endif
						</div>
					@endforeach
                </div>
                <div class="c-settingsform__field">
                    <div class="c-formsocial">
                        <div class="c-formsocial__item">
                            <i class="c-formsocial__icon c-formsocial__icon--fb"></i>
                            <div class="c-formsocial__link">
								<input type="text" class="form_update_input" value="{{ $social->facebook }}" disabled='disabled'  name="facebook" data-id='facebook' data-type='social' data-before=''>
                            </div>
                            <div class="c-formsocial__settings">
                                <span class="form_update_ok hide" data-id='facebook'>
									&#10004;
								</span>
								<span class="form_update_cancel hide" data-id='facebook'>
									&#10006;
								</span>
								<span class="form_update_pencil" data-id='facebook'>
									<img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
								</span>
                            </div>
                        </div>
                        <div class="c-formsocial__item">
                            <i class="c-formsocial__icon c-formsocial__icon--in"></i>
                            <div class="c-formsocial__link">
                                <input type="text" class="form_update_input" value="{{ $social->instagram }}" disabled='disabled'  name="instagram" data-id='instagram' data-type='social' data-before=''>
                            </div>
                            <div class="c-formsocial__settings">
                                <span class="form_update_ok hide" data-id='instagram'>
									&#10004;
								</span>
								<span class="form_update_cancel hide" data-id='instagram'>
									&#10006;
								</span>
								<span class="form_update_pencil" data-id='instagram'>
									<img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
								</span>
                            </div>
                        </div>
                        <div class="c-formsocial__item">
                            <i class="c-formsocial__icon c-formsocial__icon--yt"></i>
                            <div class="c-formsocial__link">
                                <input type="text" class="form_update_input" value="{{ $social->youtube }}" disabled='disabled'  name="youtube" data-id='youtube' data-type='social' data-before=''>
                            </div>
                            <div class="c-formsocial__settings">
                                <span class="form_update_ok hide" data-id='youtube'>
									&#10004;
								</span>
								<span class="form_update_cancel hide" data-id='youtube'>
									&#10006;
								</span>
								<span class="form_update_pencil" data-id='youtube'>
									<img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
								</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="c-settingsform__field">
                    <div class="c-newspass">
                        <div class="c-settingsform__label c-settingsform__label--red c-settingsform__label--strong c-settingsform__label--left">
                            {{TransWord::getArabic('Set new password',false)}}
                        </div>
                        <div class="c-newspass__item">
                            <input type="password" class="c-settingsform__input c-settingsform__input--blue" placeholder="{{TransWord::getArabic('Enter old password',false)}}">
                        </div>
                        <div class="c-newspass__item">
                            <input type="password" class="c-settingsform__input c-settingsform__input--blue" placeholder="{{TransWord::getArabic('Enter new password',false)}}">
                        </div>
                        <div class="c-newspass__item">
                            <input name='password' type="password" class="c-settingsform__input c-settingsform__input--blue" placeholder="{{TransWord::getArabic('Repeat new password',false)}}">
                        </div>
                        {{--<div class="c-newspass__settings">
                            <a href="#" class="c-checked">
                                <i class="c-checked__icon icon-53"></i>
                            </a>
                            <a href="#" class="c-delete">
                                <i class="c-delete__icon icon-52"></i>
                            </a>
                        </div>--}}
                    </div>
                </div>
                
            </div>
			<div style="width:100%; margin-top:10px;">
				<div class="c-settingsform__submit">
                    <button class="c-button c-button--red js-open-main-setting">{{TransWord::getArabic('Cancel')}}</button>
                    <button class="c-button c-button--green js-form-res-main-setting-apply">{{TransWord::getArabic('Apply changes')}}</button>
                </div>
			</div>
        </div>
    </form>
    </div>
<script type="text/javascript">
jQuery(function($){
	$.mask.definitions['9'] = '';
	$.mask.definitions['n'] = '[0-9]';
    $(".phone_uae").mask("+ (971) nn nnn-nnnn");
});
</script>