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
                            <th>Company name</th>
                            <th>About</th>
							<th>Cats</th>
                            <th>Email</th>
                            <th>Created at</th>
							<th style="width: 40px"></th>
                            <th style="width: 40px"></th>
							<th style="width: 40px"></th>
                        </tr>
                        @foreach ($items as $i)
                            <tr>
                                <td>{{ $i->id }}</td>
                                <td>{{ $i->title }}</td>
                                <td>{{ $i->more_info }}</td>
								<td>
									<ol>
									@foreach ($i->relCat as $cat) 
										<li>
											@if (isset($ar_types[$cat->type_id]))
												{{ $ar_types[$cat->type_id] }}
												@if (isset($ar_cats[$cat->cat_id]))
													-> {{ $ar_cats[$cat->cat_id] }}
													@if (isset($ar_subcats[$cat->subcat_id]))
														-> {{ $ar_subcats[$cat->subcat_id] }}
													@endif
												@endif
											@endif
										</li>
									@endforeach
									</ol>
								</td>
                                <td>{{ $i->relUser->email }}</td>
                                <td>{{ $i->created_at }}</td>
								<td>
									<a href='{{ action("CatalogCompanyController@getCompanyView", $i->id) }}' target="_blank">View</a>
								</td>
                                <td>
									@if ($i->status_id == 1)
										<a href='{{ action('ManagerCompanyController@getChangeStatus', array($i->id, 2)) }}'>Accept</a>
									@endif
                                </td>
								<td>
									@if ($i->status_id == 1)
										<a href='{{ action('ManagerCompanyController@getChangeStatus', array($i->id, 3)) }}'>Cancel</a>
									@endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $items->appends(Input::except('page'))->links('paginator') }}
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            </div>
        </div>
    </div>
</div>
@stop
