@extends('admin.layout')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
    {{ Form::open(array('url'=>$action, 'method' => 'post', 'role'=>'form')) }}
        <div class="box-body">
            <div class="form-group">
                <label for="trans_word">Translation</label>
                {{ Form::text('trans_word', (isset($item) ? $item->trans_word : null), array('class'=>'form-control normalValidate', 'id'=>'word')) }}
            </div>
        </div>
		
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    {{ Form::close() }}
</div>
@stop
