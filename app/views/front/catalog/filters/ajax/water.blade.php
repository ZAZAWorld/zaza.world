<div class='ad_filter_row'>
    <div class='col-md-20 ad_filter_col'>


        <select name='sub_cat_id' class='ad_filter_input'>
            <option value="">{{ TransWord::getArabic('Type', false) }}</option>
            @foreach ($sub_cats as $k=>$v)
            @if ($type_car == $k)
            <option value='{{ $k }}' selected>{{ TransWord::getArabic($v, false) }}</option>
            @else
            <option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
            @endif
            @endforeach
        </select>

    </div>

    <div class='col-md-20'>
        <div class='col-md-100 ad_filter_col m-100'>
            {{  Form::select('type_transport_id', array(Null=>TransWord::getArabic('Type', false)) + $ar_type_transport, (Input::has('type_transport_id') ? Input::get('type_transport_id') : null), array('class'=>'ad_filter_input',  'id'=>'type_transport_id')) }}
        </div>
    </div>
    <div class='col-md-20'>
        <div class='col-md-100 ad_filter_col m-100'>
            {{  Form::select('water_length', array(Null=>TransWord::getArabic('Length', false)) + $ar_water_length, (Input::has('water_length') ? Input::get('water_length') : null), array('class'=>'ad_filter_input',  'id'=>'water_length')) }}
        </div>
    </div>
    <div class='col-md-20 ad_filter_col'>
        {{ Form::text('location', (Input::has('location') ? Input::get('location') : null), array('class'=>'ad_filter_input location_ico', 'placeholder'=>TransWord::getArabic('Location', false))) }}
    </div>
    <div class='col-md-20 ad_filter_col'>
        {{ Form::text('keywords', (Input::has('keywords') ? Input::get('keywords') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Keywords', false))) }}
    </div>
</div>
<div class='ad_filter_row'>
    <div class='col-md-20 ad_filter_col price_filter'>
        <div class='ad_filter_col__title'>
            <span class='icon-38 ad_filter_col__icon'></span> {{ TransWord::getArabic('Price',false) }}
        </div>
        <div class='ad_filter_col__body'>
            <div class='row'>
                <div class='col-md-45 m-45'>
                    {{  Form::select('min_price', array(Null=>TransWord::getArabic('Min', false)) + $prices_auto, (Input::has('min_price') ? Input::get('min_price') : null), array('class'=>'ad_filter_input', 'id'=>'min_price')) }}
                </div>
                <div class='col-md-10 m-10' style="text-align:center; margin-top: 4px;">
                    —
                </div>
                <div class='col-md-45 m-45'>
                    {{  Form::select('max_price', array(Null=>TransWord::getArabic('Max', false)) + $prices_auto, (Input::has('max_price') ? Input::get('max_price') : null), array('class'=>'ad_filter_input', 'id'=>'max_price')) }}
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-20 ad_filter_col ad_filter_col--border year_filter'>
        <div class='ad_filter_col__title'>
            {{ TransWord::getArabic('Year',false) }}
        </div>
        <div class='ad_filter_col__body'>
            <div class='row'>
                <div class='col-md-45 m-45'>
                    {{  Form::select('min_year', array(Null=>TransWord::getArabic('Min', false)) + $years, (Input::has('min_year') ? Input::get('min_year') : null), array('class'=>'ad_filter_input', 'id'=>'min_year')) }}
                </div>
                <div class='col-md-10 m-10' style="text-align:center; margin-top: 4px;">
                    —
                </div>
                <div class='col-md-45 m-45'>
                    {{  Form::select('max_year', array(Null=>TransWord::getArabic('Max', false)) + $years, (Input::has('max_year') ? Input::get('max_year') : null), array('class'=>'ad_filter_input', 'id'=>'max_year')) }}
                </div>
            </div>
        </div>
    </div>

    {{--
	<div class='col-md-10 ad_filter_col m-25'>
        <div class='ad_filter_col__title'>
            <span class='icon-68 ad_filter_col__icon'></span> {{ TransWord::getArabic('Gearbox',false) }}
        </div>
        <div class='ad_filter_col__body'>
            <select name='car_transmiss_id' class='ad_filter_input'>
                <option selected="" value=""></option>
                @foreach ($ar_transmission as $k=>$v)
                <option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
                @endforeach
            </select>

        </div>
    </div>
	--}}
    <div class='col-md-10 ad_filter_col m-25'>
        <div class='ad_filter_col__title'>
            <span class='icon-50 ad_filter_col__icon'></span> {{ TransWord::getArabic('Warranty',false) }}
        </div>
        <div class='ad_filter_col__body'>

            <select name='car_warranty_id' class='ad_filter_input'>
                <option selected="" value=""></option>
                @foreach ($ar_warranty as $k=>$v)
                <option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
                @endforeach
            </select>

        </div>

    </div>
    <div class='col-md-10 ad_filter_col ad_filter_col--border m-25'>
        <div class='ad_filter_col__title'>
            <span class='icon-72 ad_filter_col__icon'></span> {{ TransWord::getArabic('Condition',false) }}
        </div>
        <div class='ad_filter_col__body'>
            <select name='car_condition_id' class='ad_filter_input'>
                <option selected="" value=""></option>
                @foreach ($ar_condition as $k=>$v)
                <option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
                @endforeach
            </select>

        </div>
    </div>
</div>
<div class='ad_filter_row'>
    @include('front.catalog.filters.include.NEF_UH_full')
	@include('front.catalog.filters.include.submit_cols')
</div>