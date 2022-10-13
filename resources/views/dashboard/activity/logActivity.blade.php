@extends('admin.layouts.app')
@section('content')

<div class="dash-home-cards">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="ProfileHader d-flex flex-wrap align-items-center">
						<h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Log Activity Lists</h3>
					</div>
				</div>
				<div class="card-body table-responsive">
					<table class="table table-bordered">
						<thead>
							<th>serial</th>
							<th>URL</th>
							<th>Method</th>
							<th>User Ip</th>
							<th width="300px">User Agent</th>
							<th>User Id</th>
							<th>Time</th>
							<th>Action</th>
						</thead>
						@if($logs->count())
						<tbody>
							@foreach($logs as $key => $log)
							<tr>
								<td>{{ $log->id }}</td>
								<td class="text-success">{{ $log->url }}</td>
								<td><label class="label label-info">{{ $log->method }}</label></td>
								<td class="text-warning">{{ $log->ip }}</td>
								<td class="text-danger">{{ $log->agent }}</td>
								<td>{{ $log->user_id }}</td>
								<td>{{ $log->created_at}}</td>
								<td> <a href="{{ url('delete/'.$log->id) }}" title="delete record" class=" btn-danger btn" data-method="DELETE" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
						@endif
					</table>
					{!! $logs->links() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection