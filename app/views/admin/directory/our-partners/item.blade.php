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
                <label for="image">Icon</label>
                {{ Form::file('image', array('class'=>'form-control normalValidate')) }}
            </div>
			
			<div class="form-group">
                <label for="active">Active</label>
                {{  Form::select('active', array(Null=>'') + $ar_active, (isset($item) ? $item->active : null), array('class'=>'form-control normalValidate', 'id'=>'active', 'required'=>'required')) }}
            </div>
			
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    {{ Form::close() }}
</div>
@stop