@extends('manager.layout')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
	<div class="box-body">
		<div class="form-group">
			<label for="f_name">Text:</label> <br/>
			{{ $item->note }}
		</div>
		<div class="form-group">
			<label for="f_name">User name:</label> <br/>
			{{ $item->relUser->full_name }}
		</div>
		<div class="form-group">
			<label for="f_name">User email:</label> <br/>
			{{ $item->relUser->email }}
		</div>
		<div class="form-group">
			<label for="f_name">Created at:</label> <br/>
			{{ $item->created_at }}
		</div>
	</div>
</div>
@stop
