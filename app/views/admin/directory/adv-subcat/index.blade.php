@extends('admin.layout')
@section('content')

    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Advert sub-categories</h3>
            </div>
			<div style="float:right;width:30%;padding: 10px;">
                <form action="{{ action('AdminAdvSubcatController@getIndex', array(4)) }}" class="c-reviews-form" method='get' >
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
                            <th style="width: 10px"><a href="?sort_name=idt&sort_val={{
								(Input::has('sort_name') && Input::get('sort_name') == 'idt') &&
								Input::get('sort_val') == 'down' ? 'up' : 'down'
							}}">#</a></th>
                            <th><a href="?sort_name=namet&sort_val={{
								(Input::has('sort_name') && Input::get('sort_name') == 'namet') &&
								Input::get('sort_val') == 'down' ? 'up' : 'down'
							}}">Name</a></th>
                            <th><a href="?sort_name=bart&sort_val={{
								(Input::has('sort_name') && Input::get('sort_name') == 'bart') &&
								Input::get('sort_val') == 'down' ? 'up' : 'down'
							}}">Category</a></th>
                            <th style="width: 40px">
                                <a href='{{ action('AdminAdvSubcatController@getItem', array(4)) }}'>Add new</a>
                            </th>
                        </tr>
                        @foreach ($cat_4 as $i)
                            <tr>
                                <td>{{ $i->id }}</td>
                                <td>{{ $i->name }}</td>
                                <td>{{ $ar_cat3[$i->parent_id] }}</td>
                                <td>
                                    <div class="dropdown">
										<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											Actions<span class="caret"></span>
										</button>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
											<li><a href='{{ action('AdminAdvSubcatController@getItem', array(4, $i->id)) }}'>Edit</a></li>
											<li><a href='{{ action('AdminAdvSubcatController@getDelete', array($i->id)) }}'>Delete</a></a></li>
										</ul>
									</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
					<tfoot>
						<tr>
							<td colspan=4>{{ $cat_4->links() }}</td>
						</tr>
					<tfoot>
                </table>
            </div>
        </div>
    
@stop
