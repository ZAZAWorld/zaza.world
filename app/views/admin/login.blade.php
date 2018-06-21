<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Administrator</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{ HTML::style('admin/bootstrap/css/bootstrap.min.css'); }}
    {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'); }}
    {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css'); }}
    {{ HTML::style('admin/dist/css/AdminLTE.min.css'); }}
    {{ HTML::style('admin/dist/css/skins/_all-skins.min.css'); }}
    {{ HTML::style('admin/plugins/iCheck/square/blue.css'); }}

    <!--[if lt IE 9]>
        {{ HTML::script('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'); }}
        {{ HTML::script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js'); }}
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ action('AdminController@getIndex') }}"><b>Zaza</b>CMS</a>
    </div>

    @include('admin.include.messages')
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Enter your email address and password to login</p>

        <form action="{{ action('AdminController@postLogin') }}" method="post">
            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password"  class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
</div>

{{ HTML::script('admin/plugins/jQuery/jQuery-2.2.0.min.js'); }}
{{ HTML::script('admin/bootstrap/js/bootstrap.min.js'); }}
{{ HTML::script('admin/plugins/iCheck/icheck.min.js'); }}
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
