{{ Form::open(array('url'=>action('CatalogAdController@getIndex', $cat->id), 'method' => 'get', 'role'=>'form')) }}
<div class='ad_filter open shadow '>
    @include('front.catalog.filters.include.head')
    <div class='ad_filter_body'>
        <div class='ad_filter_row'>
            <div class='col-md-25 m-50 ad_filter_col'>
                <select name='sub_cat_id' class='ad_filter_input js-filtet_cat_3_id'>
                    <option >{{ TransWord::getArabic('Category', false) }}</option>
                    @foreach ($sub_cats as $k=>$v)
                    @if (Input::has('sub_cat_id') && Input::get('sub_cat_id') == $k)
                    <option value='{{ $k }}' selected>{{ TransWord::getArabic($v, false) }}</option>
                    @else
                    <option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class='col-md-25 m-50 ad_filter_col'>
                {{  Form::select('sub_cat_2_id',
                array(Null=>TransWord::getArabic('Property type', false)) + (Input::has('sub_cat_id') ? SysAdvertCat::where('parent_id', Input::get('sub_cat_id'))->lists('name', 'id') : array()),
                (Input::has('sub_cat_2_id') ?  Input::get('sub_cat_2_id'): array()),
                array('class'=>'ad_filter_input js-filtet_cat_4_id')) }}
            </div>
            <div class='col-md-25 m-50 ad_filter_col'>
                {{ Form::text('location', (Input::has('location') ? Input::get('location') : null), array('class'=>'ad_filter_input location_ico', 'id'=>'txtPlaces', 'placeholder'=>TransWord::getArabic('Location', false))) }}
            </div>
            <div class='col-md-25 m-50 ad_filter_col'>
                {{ Form::text('keywords', (Input::has('keywords') ? Input::get('keywords') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Keywords', false))) }}
            </div>
        </div>
        <div class='ad_filter_row'>
            <div class='col-md-25 ad_filter_col price_filter m-50'>
                <div class='ad_filter_col__title'>
                    <span class='icon-38 ad_filter_col__icon'></span> {{ TransWord::getArabic('Price',false) }}
                </div>
                <div class='ad_filter_col__body'>
                    <div class='row'>
                        <div class='col-md-45 m-45'>
                            {{ Form::text('min_price', (Input::has('min_price') ? Input::get('min_price') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Min', false), 'type'=>'number')) }}
                        </div>
                        <div class='col-md-10 m-10' style='text-align:center; margin-top: 4px;'>
                            —
                        </div>
                        <div class='col-md-45 m-45'>
                            {{ Form::text('max_price', (Input::has('max_price') ? Input::get('max_price') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Max', false), 'type'=>'number')) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-md-22 ad_filter_col ad_filter_col--border year_filter m-50'>
                <div class='ad_filter_col__title'>
                    <span class='icon-66 ad_filter_col__icon'></span> {{ TransWord::getArabic('Bedroom',false) }}
                </div>
                <div class='ad_filter_col__body'>
                    <div class='row'>
                        <div class='col-md-45 m-45'>
                            <select name='min_bedromm' class='ad_filter_input'>
                                <option value="">{{ TransWord::getArabic('Any', false) }}</option>
                                @foreach ($bed_room_types as $k=>$v)
                                @if (Input::has('min_bedromm') && Input::get('min_bedromm') == $k)
                                <option value='{{ $k }}' selected>{{ TransWord::getArabic($v, false) }}</option>
                                @else
                                <option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class='col-md-10 m-10' style='text-align:center; margin-top: 4px;'>
                            —
                        </div>
                        <div class='col-md-45 m-45'>
                            <select name='max_bedromm' class='ad_filter_input'>
                                <option value="">{{ TransWord::getArabic('Any', false) }}</option>
                                @foreach ($bed_room_types as $k=>$v)
                                    @if (Input::has('max_bedromm') && Input::get('max_bedromm') == $k)
                                        <option value='{{ $k }}' selected>{{ TransWord::getArabic($v, false) }}</option>
                                    @else
                                        <option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-md-20 ad_filter_col m-50 '>
                <div class='ad_filter_col__title'>
                    <span class='icon-67 ad_filter_col__icon'></span> {{ TransWord::getArabic('Size',false) }}
                </div>
                <div class='ad_filter_col__body'>
                    <div class='row'>
                        <div class='col-md-45 m-45'>

                            							{{ Form::text('min_size_property', (Input::has('min_size_property') ? Input::get('min_size_property') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Min', false), 'type'=>'number')) }}
                        </div>
                        <div class='col-md-10 m-10' style="text-align:center; margin-top: 4px;">
                            —
                        </div>
                        <div class='col-md-45 m-45'>

                            							{{ Form::text('max_size_property', (Input::has('max_size_property') ? Input::get('max_size_property') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Max', false), 'type'=>'number')) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-md-10 ad_filter_col ad_filter_col--border year_filter m-25 '>
                <div class='ad_filter_col__title' style="width: 120px;">
                    <span class='icon-64 ad_filter_col__icon'></span> {{ TransWord::getArabic('Bathrooms',false) }}
                </div>
                <div class='ad_filter_col__body'>
                    <select name='bathtooms' class='ad_filter_input'>
                        <option value="">{{ TransWord::getArabic('Any', false) }}</option>
                        @foreach ($bath_rooms_types as $k=>$v)
                        @if (Input::has('bathtooms') && Input::get('bathtooms') == $k)
                        <option value='{{ $k }}' selected>{{ TransWord::getArabic($v, false) }}</option>
                        @else
                        <option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class='col-md-9 ad_filter_col m-25'>
                <div class='ad_filter_col__title'>
                    <span class='icon-26 ad_filter_col__icon'></span> {{ TransWord::getArabic('Parking',false) }}
                </div>
                <div class='ad_filter_col__body'>
                    <select name='parking_id' class='ad_filter_input'>
                        <option value="">{{ TransWord::getArabic('Any', false) }}</option>
                        @foreach ($parking_types as $k=>$v)
                        @if (Input::has('parking_id') && Input::get('parking_id') == $k)
                        <option value='{{ $k }}' selected>{{ TransWord::getArabic($v, false) }}</option>
                        @else
                        <option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class='col-md-14 ad_filter_col'>
                <div class='ad_filter_col_total_border'>
                    <span class="icon-65 ad_filter_col__icon"> </span>
                    {{ Form::checkbox('furnished', true, (Input::has('furnished') &&  Input::get('furnished') ? true : null), array('id'=>'furnished')) }}  &nbsp;
                    <label for="{{'furnished'}}">{{ TransWord::getArabic('Furnished',false) }} <span></span></label>

                    <span class="icon-63 ad_filter_col__icon"> </span>
                    {{ Form::checkbox('maidroom', true, (Input::has('maidroom') &&  Input::get('maidroom') ? true : null), array('id'=>'maidroom')) }}
                    <label for="{{'maidroom'}}">{{ TransWord::getArabic('Maidroom',false) }} &nbsp; <span></span></label>
                </div>
            </div>
            @if ($cat->id==16)
            <div class='col-md-14 ad_filter_col'>
                <div class='ad_filter_col__title'>
                    <span class='icon-18 ad_filter_col__icon'></span> {{ TransWord::getArabic('Terms',false) }}
                </div>
                <div class='ad_filter_col__body'>

                    <select name='term_id' class='ad_filter_input'>
                        <option selected="" value=""></option>
                        @foreach ($ar_terms_property as $k=>$v)
                        <option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            @endif
			<div class='col-md-70 top15 ad_filter_col'>
				@if ($cat->id==16)
					@include('front.catalog.filters.include.NEF_UH_property')
					@include('front.catalog.filters.include.submit_cols_35')
				@endif
			</div> 

			</div>
			
			@if ($cat->id==10)
				<div class='ad_filter_row'>
				
					@include('front.catalog.filters.include.NEF_UH_full')
					@include('front.catalog.filters.include.submit_cols')
				
				</div>
			@endif
       
        
    </div>
    @include('front.catalog.filters.include.sort')
    @include('front.catalog.filters.include.switch')

</div>

{{ Form::hidden('filter', 1) }}
{{ Form::close() }}
