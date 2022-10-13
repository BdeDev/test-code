@extends('admin.layouts.app')

@section('content')

<div class="dash-home-cards">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="ProfileHader d-flex flex-wrap align-items-center">
						<h3 class="font_600 font-18 font-md-20 mr-auto pr-20">My profile</h3>
					</div>
				</div>

				<div class="card-body table-responsive">
					<table id="ThemeTable" class="table table-bordered project
                    ">
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>Email</th>
							<th>Role</th>
							<th>Profile file</th>
							<th>Created ON</th>
							<th>Updated On</th>
							<th>Action</th>
						</tr>
						<tr>
							<td>{{$userinfo->id}}</td>
							<td>{{$userinfo->name}}</td>
							<td class="text-success">{{$userinfo->email}}</td>
							<td>{{$userinfo->getRole()}}</td>
							<td>
								@if($userinfo->image)
								<img src="{{url('public/uploads/'.$userinfo->image)}}" width="40px" height="40px" style="border-radius:50%">
								@else
								<img src="{{ asset('public/images/avatar.png') }}" width="40px" height="40px" style="border-radius:50%">
								@endif
							</td>
							<td>{{$userinfo->created_at}}</td>
							<td>{{$userinfo->updated_at}}</td>
							<td><a class=" btn btn-bg" href="{{url('dashboard/myprofile/edit/'.$userinfo->id)}}"><i class="fa fa-fw fa-edit"></i></a></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>

</div>

@endsection