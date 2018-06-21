<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
    <ul class="nav navbar-nav">
        <li class=""><a href="/">To Public</a></li>
		<li class=""><a href="{{ action('AdminOurBannerController@getIndex') }}">Banners</a></li>
		<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Moderators<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
				<li><a href="{{ action('AdminModeratorController@getIndex') }}">Moderators settings</a></li>
				<li><a href="{{ action('AdminModeratorsStatisticController@getAdverts') }}">Statistic of adverts</a></li>
				<li><a href="{{ action('AdminModeratorsStatisticController@getCompanies') }}">Statistic of company</a></li>
				<li><a href="{{ action('AdminModeratorsStatisticController@getBlogs') }}">Statistic of blog</a></li>
				<li><a href="{{ action('AdminModeratorsStatisticController@getComments') }}">Statistic of comments</a></li>
				
            </ul>
        </li>
		
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Directory<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                 <li><a href="{{ action('AdminCompanyCatController@getIndex') }}">Company categories</a></li>
                <li><a href="{{ action('AdminCompanySubController@getIndex') }}">Company sub-categories</a></li>
                <li><a href="{{ action('AdminAdvBarController@getIndex') }}">Advert Bar categories</a></li>
                <li><a href="{{ action('AdminAdvCatController@getIndex') }}">Advert categories</a></li>
                <li><a href="{{ action('AdminAdvSubcatController@getIndex') }}">Advert sub-categories</a></li>
                <li><a href="{{ action('AdminAdvPropController@getIndex') }}">Advert prop</a></li>
				<li><a href="{{ action('AdminTransWordsController@getIndex') }}">Translation</a></li>
				<li><a href="{{ action('AdminAutoBrandController@getIndex') }}">Auto brands</a></li>
				<li><a href="{{ action('AdminAutoModelController@getIndex') }}">Auto models</a></li>
				<li><a href="{{ action('AdminRestoranCousineController@getIndex') }}">Restoran cousine</a></li>
				<li><a href="{{ action('AdminOurPartnersController@getIndex') }}">Our partners</a></li>
            </ul>
        </li>
		<li class=""><a href="{{ action('AdminStatController@getIndex') }}">Statistics</a></li>
		<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
				<li><a href="{{ action('AdminReportAdController@getIndex') }}">Report Ad</a></li>
				<li><a href="{{ action('AdminReportCompanyController@getIndex') }}">Report Company</a></li>
				<li><a href="{{ action('AdminReportCompanyVipController@getIndex') }}">Report Top Company</a></li>
				<li><a href="{{ action('AdminReportBlogController@getIndex') }}">Report Blog</a></li>
				<li><a href="{{ action('AdminReportComentController@getIndex') }}">Report Comment</a></li>
				<li><a href="{{ action('AdminReportBannerController@getIndex') }}">Report Banner</a></li>
				<li><a href="{{ action('AdminReportManagerController@getIndex') }}">Report Manager</a></li>
            </ul>
        </li>
    </ul>
</div>
