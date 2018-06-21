@extends('admin.layout')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
    {{ Form::open(array('url'=>$action, 'method' => 'post', 'role'=>'form')) }}
        <div class="box-body">
            <div class="form-group">
                <label for="name">Subcategory name</label>
                {{ Form::text('name', (isset($item) ? $item->name : null), array('class'=>'form-control normalValidate', 'id'=>'name')) }}
            </div>
            <div class="form-group">
                <label for="parent_id">Company category</label>
                {{  Form::select('parent_id', array(Null=>'') + $ar_cats, (isset($item) ? $item->parent_id : null), array('class'=>'form-control normalValidate', 'id'=>'parent_id', 'required'=>'required')) }}
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    {{ Form::close() }}
</div>
@stop
