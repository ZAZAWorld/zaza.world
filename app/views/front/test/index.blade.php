<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Изготовление высококачественных печатей и штампов в Актобе на профессиональном оборудовании. Опыт работы 10 лет! Большой выбор оснастки. Отзывы, гарантии, низкие цены! Создаем печати в Актобе."/>
    <meta name="abstract" content="Изготовление высококачественных печатей и штампов в Актобе на профессиональном оборудовании. Опыт работы 10 лет! Большой выбор оснастки. Отзывы, гарантии, низкие цены! Создаем печати в Актобе."/>
    <meta name="keywords" content="Информация о компании, описание компании, телефон, адрес, предоставляемые товары и услуги, &#34;Изготовление печатей и штампов в г.Актобе&#34;"/>
    <!-- Mobile Specific Metas
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- CSS
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    {{ HTML::style('front/css/normalize.css'); }}
    {{ HTML::style('front/css/grid100.css'); }}
    {{ HTML::style('front/css/style.css'); }}
    @yield('css')
    <!-- Favicon
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="icon" type="image/png" href="images/favicon.png" />
</head>
<body>
    <header class="header">
        <div class="row">
            <div class="col-xs-20 col-md-20 logo">
                <a href='#main' class="logo__link">
                    <img src="img/logo.png" class="logo__image" />
                </a> <br />
                <h5 class="logo__slogan"> Be part of us</h5>
            </div>
            <div class="col-xs-20 col-md-20 location">
                <a href="#location" class="location__link">
                    <image src="img/flag.png" class="location__image" / >
                    &nbsp;&nbsp;<span class='location__name'>Dubai</span>
                </a>
            </div>

            <div class="hidden-xs col-md-20 counter">
                <div class="counter__digits" data-counter="100">
                    <div class="counter__digit">1</div><div class="counter__digit">1</div><div class="counter__digit">1</div>
                    <div class="counter__digit">1</div><div class="counter__digit">6</div><div class="counter__digit">7</div>
                </div>
                <span class="counter__name">online</span>
            </div>

            <div class="col-xs-40 col-md-20 header-buttons">
                <button class="add-advert">
                    <img src="img/plus-icon.svg"> Add
                </button>

                <button class="login">
                    <img src="img/plus-icon.svg"> Sign In
                </button>


                <select class="select-lang">
                    <option name='en'>eng</option>
                    <option name='ru'>rus</option>
                    <option name='kz'>kaz</option>
                </select>
            </div>
        </div>

    </header>

    <div class="company-icons">
        <?php //<button class="dinings shadow">Dinings & Outing</button> ?>
        <button class="services shadow">SERVICES PROVIDERS</button>
        <button class="shops shadow">STORES</button>
    </div>

    <div class="menu-bar">
        <img src="img/menu-icon.png" class="menu-bar__image" />
    </div>

    <div class="advert-icons">
        <a href="#catalog" class="advert-icons__link">
            <img src="img/home-icon.png" class="advert-icons__img" />
        </a>
        <a href="#catalog" class="advert-icons__link">
            <img src="img/home-icon.png" class="advert-icons__img" />
        </a>
        <a href="#catalog" class="advert-icons__link">
            <img src="img/home-icon.png" class="advert-icons__img" />
        </a>
        <a href="#catalog" class="advert-icons__link">
            <img src="img/home-icon.png" class="advert-icons__img" />
        </a>
        <a href="#catalog" class="advert-icons__link">
            <img src="img/home-icon.png" class="advert-icons__img" />
        </a>
        <a href="#catalog" class="advert-icons__link">
            <img src="img/home-icon.png" class="advert-icons__img" />
        </a>
        <a href="#catalog" class="advert-icons__link">
            <img src="img/home-icon.png" class="advert-icons__img" />
        </a>
    </div>

    <div class="slider">
        <img src="img/background.jpg" class="slider__image" />
    </div>

    <div class="footer-search shadow">
        <input type="search" class="footer-search__input" placeholder="search..">
        <input type="submit" class="footer-search__value" value>
    </div>

    <div class="right-buttons">
        <button class="inquiry shadow">
            <img src="img/checkbox-icon.svg"> Inquiry
        </button>
        <button class="watchs shadow">
            <img src="img/eye-icon.svg">
            <span class="watchs__count"> 4 </span>
        </button>
        <button class="adverts shadow">
            <img src="img/adverts-icon.svg">
            <span class="adverts__count"> 6 </span>
        </button>
        <button class="maps shadow">
            <img src="img/map-icon.svg">
        </button>
    </div>


    {{ HTML::script('front/js/jquery.js'); }}
    {{ HTML::script('front/js/jquery.countTo.js'); }}
    {{ HTML::script('front/js/script.js'); }}
    @yield('js')
</body>
</html>
