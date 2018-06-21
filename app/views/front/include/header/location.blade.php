<div class="col-lg-10 col-md-15 col-sm-15 m-location">
    <image src="/front/img/flag.png" class="m-location__image" />
    <select class="select-city-onbar" name='select-city-onbar' id='select-city-onbar' data-cityonbar="{{ SysCity::getUserCity() }}">
            <option  {{ (Session::has('def_city_id') && Session::get('def_city_id') == '1' ? 'selected' : null) }} value='1'>
            <a href='/change-city/1'>{{TransWord::getArabic('Dubai',false)}}</a>
            </option>
            <option  {{ (Session::has('def_city_id') && Session::get('def_city_id') == '2' ? 'selected' : null) }} value='2'>
            <a href='/change-city/2'>{{TransWord::getArabic('Abu Dhabi',false)}}</a>
            </option>
            <option  {{ (Session::has('def_city_id') && Session::get('def_city_id') == '3' ? 'selected' : null) }} value='3'>
            <a href='/change-city/3'>{{TransWord::getArabic('Sharjah',false)}}</a>
            </option>
            <option  {{ (Session::has('def_city_id') && Session::get('def_city_id') == '4' ? 'selected' : null) }} value='4'>
                    <a href='/change-city/4'>{{TransWord::getArabic('Al Ain',false)}}</a>
            </option>
            <option  {{ (Session::has('def_city_id') && Session::get('def_city_id') == '5' ? 'selected' : null) }} value='5'>
                    <a href='/change-city/5'>{{TransWord::getArabic('Fujairah',false)}}</a>
            </option>
            <option  {{ (Session::has('def_city_id') && Session::get('def_city_id') == '6' ? 'selected' : null) }} value='6'>
                    <a href='/change-city/6'>{{TransWord::getArabic('Ajman',false)}}</a>
            </option>
            <option  {{ (Session::has('def_city_id') && Session::get('def_city_id') == '7' ? 'selected' : null) }} value='7'>
                    <a href='/change-city/7'>{{TransWord::getArabic('Ras Al Khaimah',false)}}</a>
            </option>
            <option  {{ (Session::has('def_city_id') && Session::get('def_city_id') == '8' ? 'selected' : null) }} value='8'>
                    <a href='/change-city/8'>{{TransWord::getArabic('Umm al-Quwain',false)}}</a>
            </option>
    </select>
</div>
