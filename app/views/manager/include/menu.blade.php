<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
    <ul class="nav navbar-nav">
		<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Moderate company <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ action('ManagerCompanyController@getIndex') }}">Moderate</a></li>
                <li><a href="{{ action('ManagerCompanyController@getIndex', 2) }}">Approved</a></li>
                <li><a href="{{ action('ManagerCompanyController@getIndex', 3) }}">Canceled</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Moderate advert <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ action('ManagerAdController@getIndex') }}">Moderate</a></li>
                <li><a href="{{ action('ManagerAdController@getIndex', 2) }}">Approved</a></li>
                <li><a href="{{ action('ManagerAdController@getIndex', 3) }}">Canceled</a></li>
            </ul>
        </li>
		@if (Auth::user()->relModarator->moderate_blog)
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Moderate blog <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="{{ action('ManagerBlogController@getIndex') }}">Moderate</a></li>
					<li><a href="{{ action('ManagerBlogController@getIndex', 2) }}">Approved</a></li>
					<li><a href="{{ action('ManagerBlogController@getIndex', 3) }}">Canceled</a></li>
				</ul>
			</li>
		@endif
		@if (Auth::user()->relModarator->maderate_comment)
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Moderate comment <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="{{ action('ManagerCommentController@getIndex') }}">Moderate</a></li>
					<li><a href="{{ action('ManagerCommentController@getIndex', 2) }}">Approved</a></li>
					<li><a href="{{ action('ManagerCommentController@getIndex', 3) }}">Canceled</a></li>
				</ul>
			</li>
		@endif
		@if (Auth::user()->relModarator->moderate_banner)
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Moderate banner <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="{{ action('ManagerBannerController@getIndex') }}">Moderate</a></li>
					<li><a href="{{ action('ManagerBannerController@getIndex', 1) }}">In process</a></li>
					<li><a href="{{ action('ManagerBannerController@getIndex', 2) }}">Approved</a></li>
					<li><a href="{{ action('ManagerBannerController@getIndex', 3) }}">Canceled</a></li>
					<li><a href="{{ action('ManagerBannerController@getIndex', 4) }}">Published</a></li>
					<li><a href="{{ action('ManagerBannerController@getIndex', 5) }}">Finish publish</a></li>
				</ul>
			</li>
		@endif
		
    </ul>
</div>
