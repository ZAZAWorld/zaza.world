<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->relModarator->full_name }} <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ action('ManagerController@getProfile') }}">Profile</a></li>
                <li><a href="{{ action('ManagerController@getLogout') }}">Exit</a></li>
            </ul>
        </li>
    </ul>
</div>
