@extends('admin.layout')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Set date</h3>
    </div>
    {{ Form::open(array('url'=>action('AdminReportCompanyVipController@getIndex'), 'method' => 'GET', 'role'=>'form')) }}
        <div class="box-body">
            <div class="form-group">
                <label for="begin">Begin date</label>
				<input class="form-control " id="begin"  name="begin" type="date" value="{{ $begin }}" >
            </div>
            <div class="form-group">
                <label for="end">End date</label>
                <input class="form-control " id="end"  name="end" type="date" value="{{ $end }}" >
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    {{ Form::close() }}
</div>

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
                            <th style="width: 10px">USER ID </th>
                            <th>Transaction Type</th>
                            <th>Name </th>
                            <th>Category/Subcategory </th>
                            <th>Cost, AED </th>
                            <th>Created at</th>
							<th>Time</th>
                        </tr>
                        @foreach ($items as $i)
                            <tr>
                                <td><a href='/catalog-company/company-view/{{ $i->id }}' target='_blank'>{{ $i->id_spec }}</a></td>
                                <td>TOP</td>
                                <td>{{ $i->title }}</td>
                                <td>
									@foreach ($i->relCat as $cat)
										<p>
											{{ 
												(isset($ar_type[$cat->type_id]) ? $ar_type[$cat->type_id].' - ' : null).
												(isset($ar_cat[$cat->cat_id]) ? $ar_cat[$cat->cat_id].' - ' : null).
												(isset($ar_subcat[$cat->subcat_id]) ? $ar_subcat[$cat->subcat_id] : null)
											}}
										</p>
									@endforeach
								</td>
                                <td>FREE</td>
                                <td>{{ $i->created_at }}</td>
								<td>{{ $i->created_time_spec }}</td>
                            </tr>
                        @endforeach
                    </tbody>
					<tfoot>
						<tr>
							<td colspan='5'>{{ $items->links() }}</td>
						</tr>
					</tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
