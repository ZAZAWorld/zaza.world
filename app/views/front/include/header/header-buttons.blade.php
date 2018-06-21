<div class="col-md-5  col-sm-5 m-head-lang">
	<select class="select-lang" name='select-lang' id='select-lang' data-lang="{{ (Session::has('LANG') && Session::get('LANG') == 'ae' ? 'ae' : 'en') }}">
        <option  {{ (Session::has('LANG') && Session::get('LANG') == 'en' ? 'selected' : null) }} value='en'><a href='/en'>{{TransWord::getArabic('en',false)}}</a></option>
        <option {{ (Session::has('LANG') && Session::get('LANG') == 'ae' ? 'selected' : null) }} value='ae'><a href='/ae'>{{TransWord::getArabic('ae',false)}}</a></option>
    </select>
</div>
<div class="col-md-25  col-sm-25 m-head-button">
    

    @if (Auth::check() && Auth::user()->user_type_id==3)
        <div class="m-head-profile js-logout" data-tooltip="{{TransWord::getArabic('My profile',false)}} <br /> <a href='{{ action('PersonController@getLogout') }}'>{{TransWord::getArabic('Logout',false)}}</a>"> 
                <a href='{{ action("PersonController@getCabinet") }}'><div class="head-profile__cirlce" style="background:url({{ Auth::user()->photo }}) no-repeat center center; background-size: cover; width: 35px; height: 35px; border-radius: 50%; border:1px solid #15499f;">
                </div></a>

			
            
        </div>
    @elseif (Auth::check() && Auth::user()->user_type_id==4)
        <div class="m-head-profile js-logout" data-tooltip="My profile <br /> <a href='{{ action('PersonController@getLogout') }}'>{{TransWord::getArabic('Logout',false)}}</a>"> 
                <a href='{{ action("CompanyController@getCabinet") }}'>
					<div class="m-head-profile__cirlce" style="background:url({{ Auth::user()->photo }}) no-repeat center center; background-size: cover; width: 35px; height: 35px; border-radius: 50%; border:1px solid #15499f;">
					</div>
				</a>
			
            
        </div>
    @else
        <button class="login js-login">
            <span class="icon-152 login__spec"></span> {{TransWord::getArabic('Sign In')}}
        </button>
    @endif

    <button class="add-advert {{ (Auth::check() && in_array(Auth::user()->user_type_id, array(2,3,4)) ? 'js-add-advert' : 'js-add-tooltip' ) }}" data-tooltip="{{TransWord::getArabic('Please',false)}} <a href='#login' class='js-login'>{{TransWord::getArabic('sign_in',false)}}</a> <br /> {{TransWord::getArabic('to use',false)}} <br /> {{TransWord::getArabic('this function',false)}}">
        <span class="icon-16 add-advert__spec"></span> {{TransWord::getArabic('Ad')}}
    </button>
</div>
