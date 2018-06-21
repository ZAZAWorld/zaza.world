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
   <!-- <div class='col-md-40'>
        <div class='col-md-45 ad_filter_col m-45'>
            {{  Form::select('auto_brand_id', array(Null=>TransWord::getArabic('Auto brand', false)) + $ar_brands, (Input::has('auto_brand_id') ? Input::get('auto_brand_id') : null), array('class'=>'ad_filter_input', 'id'=>'auto_brand_id')) }}
        </div>
        <div class='col-md-10 m-10' style="text-align:center; margin-top: 4px;">
            —
        </div>
        <div class='col-md-45 ad_filter_col m-45'>
            {{  Form::select('auto_model_id[]', array(Null=>TransWord::getArabic('Auto model', false)) + $ar_models, (Input::has('auto_model_id') ? Input::get('auto_model_id') : null), array('class'=>'ad_filter_input', 'multiple'=>'multiple', 'id'=>'auto_model_id')) }}
        </div>
    </div>-->
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

    <div class='col-md-10 ad_filter_col m-25'>
        <div class='ad_filter_col__title'>
            <span class='icon-72 ad_filter_col__icon'></span> {{ TransWord::getArabic('Seat',false) }}
        </div>
        <div class='ad_filter_col__body'>
            {{  Form::select('seat', array(Null=>'') + $number_seats, (Input::has('seat') ? Input::get('seat') : null), array('class'=>'ad_filter_input', 'id'=>'seat_id')) }}
        </div>
    </div>
    <div class='col-md-10 ad_filter_col m-25'>
        <div class='ad_filter_col__title'>
            <span class='icon-46 ad_filter_col__icon'></span> {{ TransWord::getArabic('Mileage',false) }}
        </div>
        <div class='ad_filter_col__body'>
            {{  Form::select('car_mileage_id', array(Null=>'') + $mileage_list, (Input::has('car_mileage_id') ? Input::get('car_mileage_id') : null), array('class'=>'ad_filter_input', 'id'=>'car_mileage_id')) }}
        </div>
    </div>
    <div class='col-md-10 ad_filter_col ad_filter_col--border m-25'>
        <div class='ad_filter_col__title'>
            <span class='icon-70 ad_filter_col__icon'></span> {{ TransWord::getArabic('Fuel',false) }}
        </div>
        <div class='ad_filter_col__body'>
            {{  Form::select('car_fuel_id', array(Null=>'') + $ar_fuel, (Input::has('car_fuel_id') ? Input::get('car_fuel_id') : null), array('class'=>'ad_filter_input', 'id'=>'car_fuel_id')) }}
        </div>
    </div>

    <div class='col-md-10 ad_filter_col m-25'>
        <div class='ad_filter_col__title'>
            <span class='icon-50 ad_filter_col__icon'></span> {{ TransWord::getArabic('Warranty',false) }}
        </div>
        <div class='ad_filter_col__body'>
            {{  Form::select('car_warranty_id', array(Null=>'') + $ar_warranty, (Input::has('car_warranty_id') ? Input::get('car_warranty_id') : null), array('class'=>'ad_filter_input', 'id'=>'car_warranty_id')) }}
        </div>


    </div>
    <div class='col-md-10 ad_filter_col ad_filter_col--border m-25'>
        <div class='ad_filter_col__title'>
            <span class='icon-72 ad_filter_col__icon'></span> {{ TransWord::getArabic('Condition',false) }}
        </div>
        <div class='ad_filter_col__body'>
            {{  Form::select('car_condition_id',array(Null=>'') +  $ar_condition, (Input::has('car_condition_id') ? Input::get('car_condition_id') : null), array('class'=>'ad_filter_input', 'id'=>'car_condition_id')) }}

        </div>
    </div>


    @include('front.catalog.filters.include.NEF_UH')

    <div class="top43 col-md-37 clear_mobile">@include('front.catalog.filters.include.submit_cols_20')</div>
</div>