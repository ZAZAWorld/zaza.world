@extends('manager.layout')
@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $title }}</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 10px">id</th>
                            <th>User comment</th>
                            <th>User name</th>
                            <th>User email</th>
                            <th>Created at</th>
                            <th style="width: 40px"></th>
							<th style="width: 40px"></th>
                        </tr>
                        @foreach ($items as $i)
                            <tr>
                                <td>{{ $i->id }}</td>
                                <td>{{ $i->note }}</td>
                                <td>{{ $i->relUser->full_name }}</td>
                                <td>{{ $i->relUser->email }}</td>
                                <td>{{ $i->created_at }}</td>
                                <td>
									@if ($i->status_id == 1)
										<a href='{{ action('ManagerCommentController@getChangeStatus', array($i->id, 2)) }}'>Accept</a>
									@endif
                                </td>
								<td>
									@if ($i->status_id == 1)
										<a href='{{ action('ManagerCommentController@getChangeStatus', array($i->id, 3)) }}'>Cancel</a>
									@endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{ $items->links('paginator') }}
            </div>
        </div>
    </div>
</div>
@stop
