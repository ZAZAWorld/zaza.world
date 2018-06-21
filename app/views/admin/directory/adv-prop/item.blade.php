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
                <label for="icon">Icon</label>
                <div class="row" style="font-size: 40px;">
                    @foreach ($ar_icons as $k=>$v)
                        <div class="col-md-1">
                            <input name="icon" type="radio" value="{{ $k }}"  {{ (isset($item) && $item->icon==$k ? 'checked="checked"' : null) }} >
                            <span class="{{ $k }}"> </span>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="form-group">
                <label for="type_id">Type</label>
                {{  Form::select('type_id', array(Null=>'') + $ar_types, (isset($item) ? $item->type_id : null), array('class'=>'form-control normalValidate', 'id'=>'type_id', 'required'=>'required')) }}
            </div>
            <div class="form-group">
                <label for="is_many">Is many</label>
                {{  Form::select('is_many', array(Null=>'') + $ar_many, (isset($item) ? $item->is_many : null), array('class'=>'form-control normalValidate', 'id'=>'is_many', 'required'=>'required')) }}
            </div>
            <div class="form-group">
                <label for="is_option">Options</label>
                {{  Form::select('is_option', array(Null=>'') + $ar_option, (isset($item) ? $item->is_option : null), array('class'=>'form-control normalValidate', 'id'=>'is_option', 'required'=>'required')) }}
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    {{ Form::close() }}
</div>
@stop
