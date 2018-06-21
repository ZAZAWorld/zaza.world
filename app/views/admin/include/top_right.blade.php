<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ action('AdminController@getProfile') }}">Profile</a></li>
                <li><a href="{{ action('AdminController@getLogout') }}">Exit</a></li>
            </ul>
        </li>
    </ul>
</div>
