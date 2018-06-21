@extends('admin.layout')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
    {{ Form::open(array('url'=>$action, 'method' => 'post', 'role'=>'form')) }}
        <div class="box-body">
            <div class="form-group">
                <label for="word">Word</label>
                {{ Form::text('word', (isset($item) ? $item->word : null), array('class'=>'form-control normalValidate', 'id'=>'word')) }}
            </div>
        </div>
		
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    {{ Form::close() }}
</div>
@stop
