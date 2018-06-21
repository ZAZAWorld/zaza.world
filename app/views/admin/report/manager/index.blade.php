@extends('admin.layout')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Set date</h3>
    </div>
    {{ Form::open(array('url'=>action('AdminReportManagerController@getIndex'), 'method' => 'GET', 'role'=>'form')) }}
        <div class="box-body">
            <div class="form-group">
                <label for="begin">Begin date</label>
				<input class="form-control " id="begin"  name="begin" type="date" value="{{ $begin }}" >
            </div>
            <div class="form-group">
                <label for="end">End date</label>
                <input class="form-control " id="end"  name="end" type="date" value="{{ $end }}" >
            </div>
			<div class="form-group">
                <label for="moderator_id">Moderator</label>
                {{  Form::select('moderator_id', array(Null=>'') + $ar_modarators, $end, array('class'=>'form-control', 'id'=>'moderator_id')) }}
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
                            <th style="width: 10px">id</th>
                            <th>Full name</th>
                            <th>Phone</th>
                            <th>Mobile</th>
                            <th>Время входа в систему </th>
							<th>Время выхода из системы</th>
							<th>Заявок отработано </th>
							<th>Заявки отклонены </th>
                        </tr>
                        @foreach ($items as $i)
                            <tr>
                                <td>{{ $i->id_spec }}</td>
                                <td>{{ $ar_modarators[$ar_moderator_user[$i->user_id]] }}</td>
                                <td>{{ $ar_moderator_phone[$i->user_id] }}</td>
                                <td>{{ $ar_moderator_mobile[$i->user_id] }}</td>
                                <td>{{ date('d.m.Y h:i:s', $i->created_unix) }}</td>
								<td>{{ date('d.m.Y h:i:s', $i->closed_unix) }}</td>
								
								<td>0</td>
								<td>0</td>
                            </tr>
                        @endforeach
                    </tbody>
					<tfoot>
						<tr>
							<td colspan='5'>{{ $items->links() }}</td>
						</tr>
					</tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
