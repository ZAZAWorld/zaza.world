<div class="c-settingspanel js-modal-photo-settnig">
<form action="{{ action("CompanyRestoranController@postImages") }}" class="c-settingsform js-form-photo" method='post'>
    <ul class="c-formtabs">
        <li><a href="#main" data-toggle="tab">{{TransWord::getArabic('Main')}}</a></li>
        <li><a href="#menu" data-toggle="tab">{{TransWord::getArabic('Menu')}}</a></li>
        <li><a href="#meals" data-toggle="tab">{{TransWord::getArabic('Meals')}}</a></li>
        <li><a href="#guests" data-toggle="tab">{{TransWord::getArabic('Our guests')}}</a></li>
        <li><a href="#team" data-toggle="tab">{{TransWord::getArabic('Our team')}}</a></li>
    </ul>

    <div class="c-tabs">
        <div class="c-tabs__pane active" id="main">
            <div class="l-grid">
                <div class="l-grid__col-4_sm-12">
                    <div class="c-mainphoto">
                        <div class="c-mainphoto__area" style="background: url('{{ $company->photo }}') no-repeat center; background-size: contain;">
                            
							<input type="file" class='js-main-photo-res-file' style="display: none;">
							<input type='hidden' class='js-main-photo-res-input' name='main_photo' value="{{ $company->photo }}">
                        </div>
                        <a href="#" class="c-mainphoto__link js-main-photo-res-add">{{TransWord::getArabic('Add main photo')}}</a>
                    </div>
                    <div class="c-ytvideos">
                        <div class="c-ytvideos__header">
                            <div class="c-ytvideos__icon"></div>
                            <div class="c-ytvideos__head">{{TransWord::getArabic('Youtube videos')}}</div>
                        </div>
                        <div class="c-ytvideos__body">
                            <div class="c-ytvideos__list js-list-res-youtube">
								@foreach ($ar_youtube as $y) 
									<div class="c-ytvideos__item">
										<div class="c-ytvideos__link">
											<input type="text" class="form_update_input active" value="{{ $y->path }}" name="youtube[]">
										</div>
										<a href="#del" class="c-delete  js-del-res-youtube" >
											<i class="c-delete__icon icon-52"></i>
										</a>
									</div>
								@endforeach
                            </div>
                        </div>
                        <div class="c-ytvideos__footer">
                            <a href="#add" class="c-button js-add-res-youtube">
								<i class="c-button__icon icon-16"></i> 
								<span class="c-button__text">
									{{TransWord::getArabic('Add link')}} 
									(<span class='js-youtube_count'>{{ (2 - $ar_youtube->count()) }}</span> {{TransWord::getArabic('left')}})
								</span>
							</a>
                        </div>
                    </div>
                </div>
                <div class="l-grid__col-8_sm-12">
                    <div class="c-gallery">
                        <div class="c-gallery__header">
                            <h5 class="c-gallery__head">{{TransWord::getArabic('Media gallery photos')}}</h5>
                        </div>
                        <div class="c-gallery__body">
                            <div class="l-grid js-galerea-photo-res-list">
								@foreach ($photo_galerea as $i) 
									<div class="l-grid__col-3_md-3_sm-3_xs-3"> 
										<div class="c-gallery__item js-photo_galerea_item">
											<div class="c-gallery__image" style="background:url({{ $i->path }}) no-repeat center; background-size:contain;">
												
											</div>
											<div class="c-gallery__delete js-galerea-photo-res-delete">
												<a href="#" class="c-delete">
													<i class="c-delete__icon icon-52"></i>
												</a>
											</div>
											<input type="hidden" class="js-galerea-photo-res-input" name="photo_galerea[]" value="{{ $i->path }}">
										</div>
									</div>
								@endforeach
                                <div class="l-grid__col-3_md-3_sm-3_xs-3">
                                    <div class="c-gallery__item c-gallery__item--add js-galerea-photo-res-add">
                                        <div class="c-gallery__add "></div>
                                        <div class="c-gallery__addinfo ">
                                            {{TransWord::getArabic('add more')}} 
											(<span class='js-photo_galerea_count'>{{ (15 - $photo_galerea->count()) }}</span> {{TransWord::getArabic('left')}})
                                        </div>
										
                                    </div>
									<input type="file" class='js-galerea-photo-res-file' style="display: none;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="c-tabs__pane" id="menu">
            <div class="c-addmenu">
                <div class="c-addmenu__item js-menu-photo-res-add">
                    <div class="c-addmenu__icons">
                        <i class="c-png-icon c-icon--redplus"></i>
                    </div>
                    <div class="c-addmenu__text">
                        {{TransWord::getArabic('Add more files or images')}}
                    </div>
                </div>
				<input type="file" class='js-menu-photo-res-file' style="display: none;">
            </div>
			
			<div class='l-grid js-menu-photo-res-list'>
				@foreach ($photo_menu as $i) 
					<div class="l-grid__col-3_md-3_sm-3_xs-3"> 
						<div class="c-gallery__item">
							<div class="c-gallery__image" style="background:url({{ $i->path }}) no-repeat center; background-size:contain;">
								
							</div>
							<div class="c-gallery__delete js-menu-photo-res-delete">
								<a href="#" class="c-delete">
									<i class="c-delete__icon icon-52"></i>
								</a>
							</div>
							<input type="hidden" class="js-menu-photo-res-input" name="menu_galerea[]" value="{{ $i->path }}">
						</div>
					</div>
				@endforeach
			</div>
        </div>
        <div class="c-tabs__pane" id="meals">
			
			<div class='restoran_meal_tab_list js-meals-photo-res-list'>
				@foreach ($photo_melas as $i)
					<div class='restoran_meal_tab_item'>
						<div class='restoran_meal_tab_img_block'>
							<img  class='restoran_meal_tab_img' src='{{ $i->path }}' />
						</div>
						<div class='restoran_meal_tab_text_block'>
							<div class='restoran_meal_tab_title'>{{ $i->title }}</div>
							<div class='restoran_meal_tab_note'>{{ $i->note }}</div>
						</div>
						<input type='hidden' name='meals_galerea_img[]' value='{{ $i->path }}'>
						<input type='hidden' name='meals_galerea_title[]' value='{{ $i->title }}'>
						<input type='hidden' name='meals_galerea_note[]' value='{{ $i->note }}'>
						<div class="c-gallery__delete js-meals-photo-res-delete">
							<a href="#" class="c-delete">
								<i class="c-delete__icon icon-52"></i>
							</a>
						</div>
				   </div>
				@endforeach
				<div class='restoran_meal_tab_item'>
					<div class='restoran_meal_tab_img_block'>
						<div class="c-addmenu__item js-meals-photo-res-add">
							<div class="c-addmenu__icons">
								<i class="c-png-icon c-icon--redplus"></i>
							</div>
							<div class="c-addmenu__text">
								Add more files or images
							</div>
						</div>
					</div>
					<div class='restoran_meal_tab_text_block'>
						<div class='restoran_meal_tab_title'>
							<input type='text' class='js-meals-photo-res-title restoran_meal_tab_input' placeholder='Write title of your meal' />
						</div>
						<div class='restoran_meal_tab_note'>
							<textarea class='js-meals-photo-res-note restoran_meal_tab_input' placeholder='Write description of your meal' /></textarea>
						</div>
					</div>
					<input type="file" class='js-meals-photo-res-file' style="display: none;" />
			   </div>
			</div>
		</div>
        <div class="c-tabs__pane" id="guests">
			<div class="c-addmenu">
                <div class="c-addmenu__item js-guests-photo-res-add">
                    <div class="c-addmenu__icons">
                        <i class="c-png-icon c-icon--redplus"></i>
                    </div>
                    <div class="c-addmenu__text">
                        {{TransWord::getArabic('Add more files or images')}}
                    </div>
                </div>
				<input type="file" class='js-guests-photo-res-file' style="display: none;">
            </div>
			
			<div class='l-grid js-guests-photo-res-list'>
				@foreach ($photo_guests as $i) 
					<div class="l-grid__col-3_md-3_sm-3_xs-3"> 
						<div class="c-gallery__item">
							<div class="c-gallery__image" style="background:url({{ $i->path }}) no-repeat center; background-size:contain;">
								
							</div>
							<div class="c-gallery__delete js-guests-photo-res-delete">
								<a href="#" class="c-delete">
									<i class="c-delete__icon icon-52"></i>
								</a>
							</div>
							<input type="hidden" class="js-guests-photo-res-input" name="guests_galerea[]" value="{{ $i->path }}">
						</div>
					</div>
				@endforeach
			</div>
		</div>
        <div class="c-tabs__pane" id="team">
			<div class="c-addmenu">
                <div class="c-addmenu__item js-team-photo-res-add">
                    <div class="c-addmenu__icons">
                        <i class="c-png-icon c-icon--redplus"></i>
                    </div>
                    <div class="c-addmenu__text">
                        {{TransWord::getArabic('Add more files or images')}}
                    </div>
                </div>
				<input type="file" class='js-team-photo-res-file' style="display: none;">
            </div>
			
			<div class='l-grid js-team-photo-res-list'>
				@foreach ($photo_team as $i) 
					<div class="l-grid__col-3_md-3_sm-3_xs-3"> 
						<div class="c-gallery__item">
							<div class="c-gallery__image" style="background:url({{ $i->path }}) no-repeat center; background-size:contain;">
								
							</div>
							<div class="c-gallery__delete js-team-photo-res-delete">
								<a href="#" class="c-delete">
									<i class="c-delete__icon icon-52"></i>
								</a>
							</div>
							<input type="hidden" class="js-team-photo-res-input" name="team_galerea[]" value="{{ $i->path }}">
						</div>
					</div>
				@endforeach
			</div>
		</div>
    </div>
    <div class="c-settingsform__submit">
        <button class="c-button c-button--red js-open-photo-setting" type='button'>{{TransWord::getArabic('Cancel')}}</button>
        <button class="c-button c-button--green js-form-photo-apply">{{TransWord::getArabic('Apply')}}</button>
    </div>
</form>
</div>
