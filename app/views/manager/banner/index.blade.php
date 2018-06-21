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
                            <th>Name</th>
                            <th>Location</th>
							<th>Email</th>
                            <th>Contact</th>
							<th>person</th>
							<th>license</th>
							<th>banner</th>
							<th>days</th>
							<th>publish_date</th>
                            <th>Created at</th>
                            <th style="width: 40px"></th>
							<th style="width: 40px"></th>
							<th style="width: 40px"></th>
                        </tr>
                        @foreach ($items as $i)
                            <tr>
                                <td>{{ $i->id }}</td>
                                <td>{{ $i->name }}</td>
                                <td>{{ $i->location }}</td>
								<td>{{ $i->email }}</td>
								<td>{{ $i->contact }}</td>
								<td>{{ $i->person }}</td>
								<td><a href='{{ $i->license }}'  target="_blank">view</a></td>
								<td><a href='{{ $i->banner }}'  target="_blank">view</a></td>
								<td>{{ $i->days }}</td>
								<td>{{ $i->publish_date }}</td>
								<td>{{ $i->created_at }}</td>
                                <td>
									@if ($i->status_id == 0)
										<a href='{{ action('ManagerBannerController@getChangeStatus', array($i->id, 1)) }}'>In process</a>
									@endif
									@if ($i->status_id == 1)
										<a href='{{ action('ManagerBannerController@getChangeStatus', array($i->id, 2)) }}'>Accept</a>
									@endif
                                </td>
								<td>
									@if ($i->status_id == 1)
										<a href='{{ action('ManagerBannerController@getChangeStatus', array($i->id, 3)) }}'>Cancel</a>
									@endif
                                </td>
								<td>
									@if ($i->status_id == 1 || $i->status_id == 0 || $i->status_id == 2)
										<a href='{{ action('ManagerBannerController@getItem', $i->id) }}'>Edit</a>
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
