@extends('admin.layout')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Advert Bar categories</h3>
            </div>
			<div style="float:right;width:30%;padding: 10px;">
                <form action="{{ action('AdminAdvBarController@getIndex', array(2)) }}" class="c-reviews-form" method='get' >
					<div style="width:75%;float:left;">
						<input type="text" name='name' style="width:95%;">
					</div>
					<div style="">
						<button class="c-button c-button-blue" name="submit"><i class="c-icon icon-56"></i> <span>{{TransWord::getArabic('Search')}}</span></button>
					</div>
					
					<div class="clear"></div>
				</form>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 10px">
							<a href="?sort_name=id&sort_val={{
								(Input::has('sort_name') && Input::get('sort_name') == 'id') &&
								Input::get('sort_val') == 'down' ? 'up' : 'down'
							}}">
							#
							</a>
							</th>
                            <th><a href="?sort_name=name&sort_val={{
								(Input::has('sort_name') && Input::get('sort_name') == 'name') &&
								Input::get('sort_val') == 'down' ? 'up' : 'down'
							}}">Name</a></th>
                            <th><a href="?sort_name=bar&sort_val={{
								(Input::has('sort_name') && Input::get('sort_name') == 'bar') &&
								Input::get('sort_val') == 'down' ? 'up' : 'down'
							}}">Bar</a></th>
                            <th style="width: 40px">
                                <a href='{{ action('AdminAdvBarController@getItem', array(2)) }}'>Add new</a>
                            </th>
                        </tr>
                        @foreach ($cat_2 as $i)
                            <tr>
                                <td>{{ $i->id }}</td>
                                <td>{{ $i->name }}</td>
                                <td>{{ $ar_cat1[$i->parent_id] }}</td>
                                <td>
                                    <div class="dropdown">
										<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											Actions<span class="caret"></span>
										</button>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
											<li><a href='{{ action('AdminAdvBarController@getItem', array(2, $i->id)) }}'>Edit</a></li>
											<li><a href='{{ action('AdminAdvBarController@getDelete', array($i->id)) }}'>Delete</a></a></li>
										</ul>
									</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
					<tfoot>
						<tr>
							<td colspan=4>{{ $cat_2->links() }}</td>
						</tr>
					<tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@stop
