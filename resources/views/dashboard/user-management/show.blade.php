@extends('admin.layouts.app')
@section('content')
<section class="content container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header ">
					<div class="float-left">
						<span class=" font_600 font-18 font-md-20 mr-auto pr-20"> {{$show->name}}</span>
					</div>
					@if(Auth::check() && Auth::user()->role=='0')
					<div class="float-right">
						<form method="post" action="{{url('shadow/switch/'.$show->id)}}">
							@csrf
							<div><button class="btn btn-bg" type="submit">Shadow</button></div>
						</form>
					</div>
					@endif
				</div>
				<div class="card-body col-md-12">
					<div class="form-group">
						<div class="row">
							<div class="col-md-4">
								@if(Auth::user()->image)
								<img alt="img"  title="" class=" isTooltip" src="{{url('public/uploads/'.$show->image)}}">
								@else
								<img alt="img" class=" isTooltip" src="{{ asset('public/images/avatar.png') }}">
								@endif
							</div>
							<div class="col-md-8">
								<strong>Information</strong><br>
								<div class="table-responsive">
									<table class="table table-user-information">
										<tbody>
											<tr>
												<td>
													<strong>
														<span class="text-dark">Name:</span>
														{{$show->name}}
													</strong>
												</td>
											</tr>
											<tr>
												<td>
													<strong>

														<span class="text-dark"></span>

														Email : {{$show->email}}
													</strong>
												</td>
												<td class="text-primary">

												</td>
											</tr>
											<tr>
												<td>
													<strong>
														<span class="text-dark">DOB: </span>
														{{$show->dob}}
													</strong>
												</td>
											</tr>
											<tr>
												<td>
													<strong>
														<span class="text-dark">Address: </span>
														{{$show->address}}
													</strong>
												</td>
											</tr>
											<tr>
												<td>
													<strong>
														<span class="text-dark">Phone:</span>
														{{$show->phone}}
													</strong>
												</td>
											</tr>
											<tr>
												<td>
													<strong>

														<span class="text-dark"></span>
														Created On :
														{{$show->created_at}}
													</strong>
												</td>
												<td class="text-primary">

												</td>
											</tr>


											<tr>
												<td>
													<strong>

														<span class="text-dark"></span>
														Role:
														{{$show->getRole()}}

													</strong>
												</td>
												<td class="text-primary">

												</td>
											</tr>

											<tr>
												<td>
													<strong>

														<span class="text-darks"></span>
														Modified On :{{$show->updated_at}}

													</strong>
												</td>
												<td class="text-primary">

												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<x-comment />
				</div>
			</div>
		</div>
	</div>
</section>
@endsection