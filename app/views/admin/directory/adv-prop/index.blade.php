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
                            <th style="width: 10px"><a href="?sort_name=id&sort_val={{
								(Input::has('sort_name') && Input::get('sort_name') == 'id') && 
								Input::get('sort_val') == 'down' ? 'up' : 'down'
							}}">
							#
							</a></th>
                            <th><a href="?sort_name=name&sort_val={{
								(Input::has('sort_name') && Input::get('sort_name') == 'name') && 
								Input::get('sort_val') == 'down' ? 'up' : 'down'
							}}">Name</a></th>
                            <th>Icon</th>
                            <th>Type</th>
                            <th>Is many</th>
                            <th>Options</th>
							<th>Cats</th>
                            <th style="width: 40px">
                                <a href='{{ action('AdminAdvPropController@getItem') }}'>Add new</a>
                            </th>
                        </tr>
                        @foreach ($items as $i)
                            <tr>
                                <td>{{ $i->id }}</td>
                                <td>{{ $i->name }}</td>
                                <td style="text-align:center"><span class="{{ $i->icon }}" style="font-size: 40px;"></span></td>
                                <td>{{ $ar_types[$i->type_id] }}</td>
                                <td>{{ $i->is_many_name }}</td>
                                <td>
									@forelse ($i->relPropOption as $b)
										<p> {{ $b->name }}  </p>
									@empty 
										hasn't option
									@endforelse
								</td>
								<td> 
									@forelse ($i->relPropCat as $b)
										<p> 
											@if ($b->cat1_id > 0)
												{{ $ar_cat[$b->cat1_id] }}
											@endif
											@if ($b->cat2_id > 0)
												->{{ $ar_cat[$b->cat2_id] }}
											@endif
											@if ($b->cat3_id > 0)
												->{{ $ar_cat[$b->cat3_id] }}
											@endif
											@if ($b->cat4_id > 0)
												->{{ $ar_cat[$b->cat4_id] }}
											@endif
										</p>
									@empty 
										hasn't categories
									@endforelse
								</td>
                                <td>
                                    <div class="dropdown">
                  										<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  											Actions<span class="caret"></span>
                  										</button>
                  										<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                  											<li><a href='{{ action('AdminAdvPropController@getItem', array($i->id)) }}'>Edit</a></li>
                  											<li><a href='{{ action('AdminAdvPropController@getDelete', array($i->id)) }}'>Delete</a></li>
                                        <li><a href='{{ action('AdminAdvPropController@getCat', array($i->id)) }}'>Cats</a></li>
                                        @if ($i->is_option)
                                          <li><a href='{{ action('AdminAdvPropController@getOption', array($i->id)) }}'>Options</a></li>
                                        @endif
                  										</ul>
                  									</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
				<div class="box-footer clearfix">
                    {{ $items->appends(Input::except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
