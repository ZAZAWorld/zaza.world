<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Zaza CMS | {{ (isset($title) ? $title : null) }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{ HTML::style('admin/bootstrap/css/bootstrap.min.css'); }}
    {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'); }}
    {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css'); }}
    {{ HTML::style('admin/dist/css/AdminLTE.min.css'); }}
    {{ HTML::style('admin/dist/css/skins/_all-skins.min.css'); }}
    @yield('css')

    <!--[if lt IE 9]>
        {{ HTML::script('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'); }}
        {{ HTML::script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js'); }}
    <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                @include('manager.include.logo')
                @include('manager.include.menu')
                @include('manager.include.top_right')
            </div>
        </nav>
    </header>

    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>{{ (isset($title) ? $title : null) }}</h1>
                @if (isset($breadcrumb) && is_array($breadcrumb) && count($breadcrumb) > 1)
                    <ol class="breadcrumb">
                        @foreach ($breadcrumb as $b)
                            <li><a href="{{ $b['url'] }}">{{ $b['name'] }}</a></li>
                        @endforeach
                    </ol>
                @endif
            </section>

            @include('manager.include.messages')
            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
        </div>
    </div>

    <footer class="main-footer">
        @include('manager.include.footer')
    </footer>
</div>

    {{ HTML::script('admin/plugins/jQuery/jQuery-2.2.0.min.js'); }}
    {{ HTML::script('admin/bootstrap/js/bootstrap.min.js'); }}
    {{ HTML::script('admin/plugins/slimScroll/jquery.slimscroll.min.js'); }}
    {{ HTML::script('admin/plugins/fastclick/fastclick.js'); }}
    {{ HTML::script('admin/dist/js/app.min.js'); }}
    {{ HTML::script('admin/dist/js/demo.js'); }}
    {{ HTML::script('admin/my/jquery.validate.min.js'); }}
    {{ HTML::script('admin/my/common.js'); }}
    @yield('js')
</body>
</html>
