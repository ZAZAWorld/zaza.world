@extends('manager.layout')
@section('js')
	{{ HTML::script('admin/my/pages/profile.js') }}
@endsection
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
    {{ Form::open(array('url'=>action('ManagerController@postProfile'), 'method' => 'post', 'role'=>'form')) }}
        <div class="box-body">
            <div class="form-group">
                <label for="f_name">First name</label>
                {{ Form::text('f_name', $user->f_name, array('class'=>'form-control normalValidate', 'id'=>'f_name')) }}
            </div>
            <div class="form-group">
                <label for="l_name">Last name</label>
                {{ Form::text('l_name', $user->l_name, array('class'=>'form-control normalValidate', 'id'=>'l_name')) }}
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                {{ Form::text('email', $user->email, array('class'=>'form-control normalValidate', 'id'=>'email')) }}
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                {{  Form::password('password', array('class'=>'form-control normalValidate', 'id'=>'password', 'required'=>'required')) }}
            </div>
            <div class="form-group">
                <label for="lang_id">Lang</label>
                {{  Form::select('lang_id', array(Null=>'') + $ar_lang, $user->lang_id, array('class'=>'form-control normalValidate', 'id'=>'lang_id', 'required'=>'required')) }}
            </div>
            <div class="form-group">
                <label for="country_id">Country</label>
                {{  Form::select('country_id', array(Null=>'') + $ar_country, $user->country_id, array('class'=>'form-control normalValidate', 'id'=>'country_id', 'required'=>'required')) }}
            </div>
            <div class="form-group">
                <label for="city_id">City</label>
                {{  Form::select('city_id', array(Null=>'') + $ar_city, $user->city_id, array('class'=>'form-control normalValidate', 'id'=>'city_id', 'required'=>'required')) }}
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    {{ Form::close() }}
</div>
@stop
