<div class="login-modal">
    <!-- Modal content -->
    <div class="login-modal__content shadow">
        <span class="login-modal__close"></span>
        <div class="login-modal__body">
            <a href="{{ action('PersonController@loginWithFacebook') }}">
                <button class="b_facebook">
                    <img src="/front/img/icons/facebook.png"> {{ TransWord::getArabic('Connect with facebook') }}
                </button>
            </a>

            <a href="{{ action('PersonController@loginWithGoogle') }}">
                <button class="b_google">
                    <img src="/front/img/icons/google.png"> {{ TransWord::getArabic('Connect with google') }}
                </button>
            </a>

            <span class="or_block">
                <span class="or_block__inside"> {{TransWord::getArabic('or')}} </span>
            </span>

            <form method="post" class='b_req_login_form validate-form' enctype="multipart/form-data" action="{{ action('PersonController@postLogin') }}">

                <input name='email' class="b_req_input" required="required" type="email" placeholder="{{TransWord::getArabic('email',false)}}" />

                <input name='password' class="b_req_input" required="required" type="password" placeholder="{{TransWord::getArabic('password',false)}}" />

                <a href='#forgot-password' class="b_req_forgot"> {{TransWord::getArabic('forgot password')}} ?</a>


                <button class="b_req_login" type='submit'>
                    <span class="icon-152 b_req_login__spec"></span>&nbsp;&nbsp; {{TransWord::getArabic('log in')}}
                </button>

            </form>

            <span class="or_block">
                <span class="or_block__inside"/> {{ TransWord::getArabic('or') }} </span>
            </span>

            <button class="b_req_person js-open-reg_simple_user_form">
                <span class="icon-19 b_req_person__spec"></span> {{TransWord::getArabic('Create <strong>personal</strong> account')}}</button>

            <button class="b_req_company">
                <span class="icon-14 b_req_company__spec"></span> {{TransWord::getArabic('Create <strong>company</strong> account')}}
            </button>

        </div>
    </div>
</div>
