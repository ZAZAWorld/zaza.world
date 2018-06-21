@extends('admin.layout')
@section('js')
	{{ HTML::script('admin/my/pages/moderator.js') }}
@endsection
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
    {{ Form::open(array('url'=>$action, 'method' => 'post', 'role'=>'form')) }}
        <div class="box-body">
            <div class="form-group">
                <label for="f_name">First name</label>
                {{ Form::text('f_name', (isset($user) ? $user->f_name : null), array('class'=>'form-control normalValidate', 'id'=>'f_name')) }}
            </div>
            <div class="form-group">
                <label for="l_name">Last name</label>
                {{ Form::text('l_name', (isset($user) ? $user->l_name : null), array('class'=>'form-control normalValidate', 'id'=>'l_name')) }}
            </div>
			<div class="form-group">
                <label for="p_name">Patronymic</label>
                {{ Form::text('p_name', (isset($user) ? $moderator->p_name : null), array('class'=>'form-control normalValidate', 'id'=>'l_name')) }}
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                {{ Form::text('email', (isset($user) ? $user->email : null), array('class'=>'form-control normalValidate', 'id'=>'email')) }}
            </div>
            <div class="form-group">
                <label for="password">Password</labelW>
                {{  Form::password('password', array('class'=>'form-control normalValidate', 'id'=>'password', 'required'=>'required')) }}
            </div>
            <div class="form-group">
                <label for="lang_id">Lang</label>
                {{  Form::select('lang_id', array(Null=>'') + $ar_lang, (isset($user) ? $user->lang_id : null), array('class'=>'form-control normalValidate', 'id'=>'lang_id', 'required'=>'required')) }}
            </div>
            <div class="form-group">
                <label for="country_id">Country</label>
                {{  Form::select('country_id', array(Null=>'') + $ar_country, (isset($user) ? $user->country_id : null), array('class'=>'form-control normalValidate', 'id'=>'country_id', 'required'=>'required')) }}
            </div>
            <div class="form-group">
                <label for="city_id">City</label>
                {{  Form::select('city_id', array(Null=>'') + $ar_city, (isset($user) ? $user->city_id : null), array('class'=>'form-control normalValidate', 'id'=>'city_id', 'required'=>'required')) }}
            </div>
			<div class="form-group">
                <label for="phones">Phone</label>
                {{  Form::text('phones', (isset($moderator) ? $moderator->phones : null), array('class'=>'form-control normalValidate', 'id'=>'phones', 'required'=>'required')) }}
            </div>
			<div class="form-group">
                <label for="mobile">Mobile</label>
                {{  Form::text('mobile', (isset($moderator) ? $moderator->mobile : null), array('class'=>'form-control normalValidate', 'id'=>'mobile', 'required'=>'required')) }}
            </div>
			<div class="form-group">
                <label for="address">Address</label>
                {{  Form::text('address', (isset($moderator) ? $moderator->address : null), array('class'=>'form-control normalValidate', 'id'=>'address', 'required'=>'required')) }}
            </div>

        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    {{ Form::close() }}
</div>
@stop
