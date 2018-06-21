@extends('admin.layout')
@section('js')
	{{ HTML::script('admin/my/pages/company-cat.js') }}
@endsection
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Add new right</h3>
    </div>
    {{ Form::open(array('url'=>action('AdminModeratorController@postCompanyModerate', $item->id), 'method' => 'post', 'role'=>'form')) }}
        <div class="box-body">
            <div class="form-group">
                <label for="cat1_id">Company type</label>
                {{  Form::select('cat1_id', array(Null=>'') + $ar_types, null, array('class'=>'form-control', 'id'=>'cat1_id', 'required'=>'required')) }}
            </div>
			<!--
            <div class="form-group">
                <label for="cat2_id">Company category</label>
                {{  Form::select('cat2_id', array(Null=>''), null, array('class'=>'form-control', 'id'=>'cat2_id')) }}
            </div>
			-->
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    {{ Form::close() }}
</div>

<div class="row">
<div class="col-md-12">

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Lists of rights</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Company type</th>
                        <!-- <th>Company category</th>-->
                        <th style="width: 40px"></th>
                    </tr>
                    @foreach ($rights as $i)
                        <tr>
                            <td>{{ $i->id }}</td>
                            <td>{{ (isset($ar_types[$i->cat1_id]) ? $ar_types[$i->cat1_id]: null ) }}</td>
                            <!-- <td>{{ (isset($ar_cats[$i->cat2_id]) ? $ar_cats[$i->cat2_id]: null ) }}</td>-->
                            <td>

                                <a href='{{ action('AdminModeratorController@getDeleteCompanyModerate', $i->id) }}'>Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {{ $rights->links('paginator') }}
        </div>
    </div>
</div>
</div>
@stop
