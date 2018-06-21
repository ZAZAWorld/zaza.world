@extends('admin.layout')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
     {{ Form::open(array('url'=>$action, 'method' => 'post', 'role'=>'form', 'files'=>true)) }}
        <div class="box-body">
            <div class="form-group">
                <label for="name">Name</label>
                {{ Form::text('name', (isset($item) ? $item->name : null), array('class'=>'form-control normalValidate', 'id'=>'name')) }}
            </div>
			<div class="form-group">
                <label for="location">Location</label>
                {{ Form::text('location', (isset($item) ? $item->location : null), array('class'=>'form-control normalValidate', 'id'=>'location')) }}
            </div>
			<div class="form-group">
                <label for="contact">Contact</label>
                {{ Form::text('contact', (isset($item) ? $item->contact : null), array('class'=>'form-control normalValidate', 'id'=>'contact')) }}
            </div>
			<div class="form-group">
                <label for="email">Email</label>
                {{ Form::text('email', (isset($item) ? $item->email : null), array('class'=>'form-control normalValidate', 'id'=>'email')) }}
            </div>
			<div class="form-group">
                <label for="person">Person</label>
                {{ Form::text('person', (isset($item) ? $item->person : null), array('class'=>'form-control normalValidate', 'id'=>'person')) }}
            </div>
			
			<div class="form-group">
                <label for="license">License</label>
                {{ Form::file('license', array('class'=>'form-control ')) }}
            </div>
			
			<div class="form-group">
                <label for="banner">Banner</label>
                {{ Form::file('banner', array('class'=>'form-control ')) }}
            </div>
			
			<div class="form-group">
                <label for="days">Days</label>
                {{ Form::text('days', (isset($item) ? $item->days : null), array('class'=>'form-control normalValidate', 'id'=>'days')) }}
            </div>
			
			<div class="form-group">
                <label for="days">Publish date</label> <br />
				{{ Form::text('publish_date', (isset($item) ? $item->publish_date : null), array('class'=>'form-control normalValidate', 'id'=>'days')) }}
            </div>
			
			
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    {{ Form::close() }}
</div>
@stop