@extends('admin.layout')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Company categories</h3>
            </div>
			<div style="float:right;width:30%;padding: 10px;">
                <form action="{{ action('AdminCompanyCatController@getIndex', array(2)) }}" class="c-reviews-form" method='get' >
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
                            <th><a href="?sort_name=type&sort_val={{
								(Input::has('sort_name') && Input::get('sort_name') == 'type') && 
								Input::get('sort_val') == 'down' ? 'up' : 'down'
							}}">Type</a></th>
                            <th style="width: 40px">
                                <a href='{{ action('AdminCompanyCatController@getCat') }}'>Add new</a>
                            </th>
                        </tr>
                        @foreach ($cats as $i)
                            <tr>
                                <td>{{ $i->id }}</td>
                                <td>{{ $i->name }}</td>
                                <td>{{ $ar_types[$i->type_id] }}</td>
                                <td>
                                    <a href='{{ action('AdminCompanyCatController@getCat', $i->id) }}'>Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{ $cats->links() }}
            </div>
        </div>
    </div>
</div>
@stop
