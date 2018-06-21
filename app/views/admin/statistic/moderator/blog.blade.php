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
							<th>id</th>
                            <th>Full name</th>
                            <th>Created count</th>
                            <th>Approved count</th>
                            <th>Canceled count</th>
                        </tr>
						<?php $total_count = Blog::where(array('status_id'=>1))->count();?>
                        @foreach ($moderators as $i)
                            <tr>
								<td>{{ $i->id }}</td>
                                <td>{{ $i->full_name }}</td>
                                <td>{{ $total_count }}</td>
                                <td>{{ Blog::withTrashed()->where(array('moderator_id'=>$i->id, 'status_id'=>2))->count() }}</td>
                                <td>{{ Blog::withTrashed()->where(array('moderator_id'=>$i->id, 'status_id'=>3))->count() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
