@extends('admin.layout')
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
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
							<th>Company rights</th>
							<th>Ad rights</th>
							<th>Moderate blog</th>
							<th>Moderate comment</th>
							<th>Moderate banner</th>
                            <th style="width: 40px">
                                <a href='{{ action("AdminModeratorController@getItem") }}'>Add new</a>
                            </th>
                        </tr>
                        @foreach ($items as $i)
                            <tr>
                                <td>{{ $i->id }}</td>
                                <td>{{ $i->full_name }}</td>
                                <td>{{ $i->relUser->email }}</td>
                                <td>{{ $i->phones }}</td>
                                <td>{{ $i->address }}</td>
								<td>
									<ol>
										@foreach ($i->getCompanyRight() as $r)
											<!-- <li>{{ $ar_company_types[$r->cat1_id] }}->{{ $ar_company_cats[$r->cat2_id] }}</li> -->
											<li>{{ $ar_company_types[$r->cat1_id] }}</li>
										@endforeach
									</ol>
								</td>
								<td>
									<ol>
										@foreach ($i->getAdRight() as $r)
											<!-- <li>{{ $ar_ad_cat_1[$r->cat1_id] }}->{{ $ar_ad_cat_2[$r->cat2_id] }}</li> -->
											<li>{{ $ar_ad_cat_1[$r->cat1_id] }}</li>
										@endforeach
									</ol>
								</td>
								<td>{{ $i->moderate_blog_name }}</td>
								<td>{{ $i->moderate_comment_name }}</td>
								<td>{{ $i->moderate_banner_name }}</td>
                                <td>
                                    <div class="dropdown">
										<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											Actions<span class="caret"></span>
										</button>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
											<li><a href='{{ action('AdminModeratorController@getItem', $i->id) }}'>Edit</a></li>
                                            <li><a href='{{ action('AdminModeratorController@getCompanyModerate', $i->id) }}'>Company moderate</a></li>
											<li><a href='{{ action('AdminModeratorController@getAdModerate', $i->id) }}'>Ad moderate</a></li>
											<li>
												<a href='{{ action('AdminModeratorController@getModerateBlogRight', $i->id) }}'>
													@if ($i->moderate_blog) 
														turn off moderate blog
													@else 
														turn on moderate blog
													@endif
												</a>
											</li>
											<li>
												<a href='{{ action('AdminModeratorController@getModerateCommentRight', $i->id) }}'>
													@if ($i->maderate_comment) 
														turn off comment blog
													@else 
														turn on comment blog
													@endif
												</a>
											</li>
											<li>
												<a href='{{ action('AdminModeratorController@getModerateBanner', $i->id) }}'>
													@if ($i->moderate_banner) 
														turn off banner
													@else 
														turn on banner
													@endif
												</a>
											</li>
										</ul>
									</div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{ $items->links() }}
            </div>
        </div>
    </div>
</div>
@stop
