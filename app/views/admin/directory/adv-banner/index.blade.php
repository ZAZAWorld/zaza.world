@extends('admin.layout')

@section('content')
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
                            <th>Location</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Person</th>
                            <th>License</th>
                            <th>Banner</th>
                            <th>Days</th>
                            <th style="width: 40px">
                                <a href='{{ action("AdminOurBannerController@getItem") }}'>Add new</a>
                            </th>
                        </tr>
                        @foreach ($items as $i)
                            <tr>
                                <td>{{ $i->id }}</td>
                                <td>{{ $i->name }}</td>
                                <td>{{ $i->location }}</td>
                                <td>{{ $i->contact }}</td>
                                <td>{{ $i->email }}</td>
                                <td>{{ $i->person }}</td>
                                <td>
									@if ($i->license)
										<img src='{{ $i->license }}' style='width: 150px;'>
									@endif
								</td>
								<td>
									@if ($i->banner)
										<img src='{{ $i->banner }}' style='width: 150px;'>
									@endif
								</td>
								<td>{{ $i->days }}</td>
                                <td>
                                    <div class="dropdown">
										<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											Actions<span class="caret"></span>
										</button>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
											<li><a href='{{ action('AdminOurBannerController@getItem', array($i->id)) }}'>Edit</a></li>
											<li><a href='{{ action('AdminOurBannerController@getDelete', array($i->id)) }}'>Delete</a></li>
										</ul>
									</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
