@extends('admin.layout')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
    {{ Form::open(array('url'=>$action, 'method' => 'post', 'role'=>'form')) }}
        <div class="box-body">
            <div class="form-group">
                <label for="name">Name</label>
                {{ Form::text('name', (isset($item) ? $item->name : null), array('class'=>'form-control normalValidate', 'id'=>'name')) }}
            </div>
            <div class="form-group">
                <label for="parent_id">Parent</label>
                {{  Form::select('parent_id', array(Null=>'') + $ar_parents, (isset($item) ? $item->parent_id : null), array('class'=>'form-control normalValidate', 'id'=>'type_id', 'required'=>'required')) }}
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    {{ Form::close() }}
</div>
@stop
