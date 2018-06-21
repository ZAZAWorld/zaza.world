@extends('admin.layout')
@section('js')
	{{ HTML::script('admin/my/pages/advert_property_cat.js') }}
@endsection

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $title }} (option "{{ $item->name }}")</h3>
    </div>
    {{ Form::open(array('url'=>action("AdminAdvPropController@postCat", $item->id), 'method' => 'post', 'role'=>'form')) }}
        <div class="box-body">

            <div class="form-group">
                <label for="cat1_id">Category 1</label>
                {{  Form::select('cat1_id', array(Null=>'') + $ar_cat_1, null, array('class'=>'form-control normalValidate', 'id'=>'cat1_id', 'required'=>'required')) }}
            </div>
            <div class="form-group">
                <label for="cat2_id">Category 2</label>
                {{  Form::select('cat2_id', array(Null=>'') , null, array('class'=>'form-control ', 'id'=>'cat2_id')) }}
            </div>
            <div class="form-group">
                <label for="cat3_id">Category 3</label>
                {{  Form::select('cat3_id', array(Null=>'') , null, array('class'=>'form-control ', 'id'=>'cat3_id')) }}
            </div>
            <div class="form-group">
                <label for="cat4_id">Category 4</label>
                {{  Form::select('cat4_id', array(Null=>'') , null, array('class'=>'form-control ', 'id'=>'cat4_id')) }}
            </div>
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
                <h3 class="box-title">{{ $title }} </h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Category 1</th>
                            <th>Category 2</th>
                            <th>Category 3</th>
                            <th>Category 4</th>
                            <th style="width: 40px"></th>
                        </tr>
                        @foreach ($items as $i)
                            <tr>
                                <td>{{ $i->id }}</td>
                                <td>{{ $ar_cat_1[$i->cat1_id] }}</td>
                                <td>{{ $ar_cat_2[$i->cat2_id] }}</td>
                                <td>{{ $ar_cat_3[$i->cat3_id] }}</td>
                                <td>{{ $ar_cat_4[$i->cat4_id] }}</td>
                                <td><a href='{{ action('AdminAdvPropController@getDeleteCat', array($item->id, $i->id)) }}'>Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
