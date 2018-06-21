@extends('admin.layout')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $title }} (option "{{ $item->name }}")</h3>
    </div>
    {{ Form::open(array('url'=>action("AdminAdvPropController@postOption", $item->id), 'method' => 'post', 'role'=>'form')) }}
        <div class="box-body">
          <div class="form-group">
              <label for="name">Name</label>
              {{ Form::text('name', null, array('class'=>'form-control normalValidate', 'id'=>'name')) }}
          </div>
          <div class="form-group">
              <label for="icon">Icon</label>
              <div class="row" style="font-size: 40px;">
                  @foreach ($ar_icons as $k=>$v)
                      <div class="col-md-1">
                          <input name="icon" type="radio" value="{{ $k }}" >
                          <span class="{{ $k }}"> </span>
                      </div>
                  @endforeach
              </div>

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
                            <th>Name</th>
                            <th>Icon</th>
                            <th style="width: 40px"></th>
                        </tr>
                        @foreach ($items as $i)
                            <tr>
                                <td>{{ $i->id }}</td>
                                <td>{{ $i->name }}</td>
                                <td style="text-align:center"><span class="{{ $i->icon }}" style="font-size: 40px;"></span></td>
                                <td><a href='{{ action('AdminAdvPropController@getDeleteOption', array($item->id, $i->id)) }}'>Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
