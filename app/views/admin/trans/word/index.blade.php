@extends('admin.layout')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $title }}</h3>
            </div>
			 <div style="float:right;width:30%;padding: 10px;">
                <form action="{{ action('AdminTransWordsController@getIndex') }}" class="c-reviews-form" method='get' >
					<div style="width:75%;float:left;">
						<input type="text" name='wordname' style="width:95%;">
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
									Input::get('sort_val') == 'down' ? 'up' : 'down'}}">
								#
								</a>
							</th>
                            <th><a href="?sort_name=name&sort_val={{
									(Input::has('sort_name') && Input::get('sort_name') == 'name') &&
									Input::get('sort_val') == 'down' ? 'up' : 'down'}}">English</a></th>
                            <th>Arabic</th>
                            <th style="width: 40px">
                                <a href='{{ action("AdminTransWordsController@getItem") }}'>Add new</a>
                            </th>
                        </tr>
                        @foreach ($items as $i)
                            <tr>
                                <td>{{ $i->id }}</td>
                                <td>{{ $i->word }}</td>
                                <td>
									<a href='{{ action("AdminTransWordsController@getTranslation", array(2, $i->id)) }}'>
										@if ($i->relArabic()) 
											{{ $i->relArabic() }}
										@else 
											not translated
										@endif
									</a>
								</td>
                                <td>
                                    <div class="dropdown">
										<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											Actions<span class="caret"></span>
										</button>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
											<li><a href='{{ action('AdminTransWordsController@getItem',  $i->id) }}'>Edit</a></li>
											<li><a href='{{ action('AdminTransWordsController@getDelete',  $i->id) }}'>Delete</a></a></li>
										</ul>
									</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
					<tfoot>
						<tr>
							<td colspan=4>{{ $items->links() }}</td>
						</tr>
					<tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@stop
