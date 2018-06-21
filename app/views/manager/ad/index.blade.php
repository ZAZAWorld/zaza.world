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
                            <th>Cat</th>
                            <th>Status</th>
                            <th>Created at</th>
							<th>Time of ad</th>
							<th>View</th>
							<th>Time of approval/cancellation</th>
                            <th style="width: 40px"></th>
							<th style="width: 40px"></th>
                        </tr>
                        @foreach ($items as $i)
                            <tr>
                                <td>{{ $i->id }}</td>
                                <td>{{ $i->title }}</td>
                                <td>
									@foreach ($i->relCat as $cat) 
										<p>{{ $ar_ad_cat_1[$cat->cat1_id] }}->{{ $ar_ad_cat_2[$cat->cat2_id] }}</p>
									@endforeach
								</td>
                                <td>{{ $ar_status[$i->status_id] }}</td>
                                <td>{{ $i->created_at }}</td>
								<td>{{ $i->created_time_spec }}</td>
								<td><a href='/catalog-ad/index/17?show_id={{ $i->id }}' target='_blank'>View</a></td>
								<td>{{ $i->modarete_time_spec }}</td>
                                <td>
									@if ($i->status_id == 1)
										<a href='{{ action('ManagerAdController@getChangeStatus', array($i->id, 2)) }}'>Accept</a>
									@endif
                                </td>
								<td>
									@if ($i->status_id == 1)
										<a href='{{ action('ManagerAdController@getChangeStatus', array($i->id, 3)) }}'>Cancel</a>
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
