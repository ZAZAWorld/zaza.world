@extends('manager.layout')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
     {{ Form::open(array('url'=>$action, 'method' => 'post', 'role'=>'form', 'files'=>true)) }}
        <div class="box-body">
            <div class="form-group">
                <label for="paid_date">Paid on, Date</label>
                {{ Form::text('paid_date', null, array('class'=>'form-control normalValidate', 'id'=>'paid_date')) }}
            </div>
			<div class="form-group">
                <label for="paid_doc_number">Document Nu</label>
                {{ Form::text('paid_doc_number', (isset($item) ? $item->paid_doc_number : null), array('class'=>'form-control normalValidate', 'id'=>'paid_doc_number')) }}
            </div>
			<div class="form-group">
                <label for="paid_sum">Paid, AED</label>
                {{ Form::text('paid_sum', (isset($item) ? $item->paid_sum : null), array('class'=>'form-control normalValidate', 'id'=>'paid_sum')) }}
            </div>
			
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    {{ Form::close() }}
</div>
@stop