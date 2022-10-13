@extends('admin.layouts.app')
@section('content')
<div class="dash-home-cards">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="ProfileHader d-flex flex-wrap align-items-center">
            <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Users</h3>
            <a class="btn btn-bg" href="{{ url('/dashboard/users/add') }}">
              <i class="fa fa-plus mr-1"></i>Add User
            </a>
          </div>
        </div>
        <div class="card-body table-responsive">
          <table id="ThemeTable" class="table table-bordered projects">
            <thead>
              <th>Id</th>
              <th>Name</th>
              <th>Email</th>
              <th>Created On</th>
              <th>Role</th>
              <th>Profile file</th>
              <th>Action</th>
            </thead>
            <tbody>
              @foreach($count as $users)
              <tr>
                <td>{{ $users->id }}</td>
                <td>{{ $users->name }}</td>
                <td class="text-success">{{ $users->email }}</td>
                <td><label class="label label-info">{{ $users->created_at }}</label></td>
                <td>{{$users->getRole()}}</td>
                <td>
                  @if('public/uploads/'.$users->image)
                  <img src="{{url('public/uploads/'.$users->image)}}" width="40px" height="40px" style="border-radius:50%">
                  @else
                  <img src="{{ asset('public/images/ .png') }}" width="40px" height="40px" style="border-radius:50%">
                  @endif
                </td>
                <td>
                <a href="{{url('/dashboard/users/show/'.$users->id)}}" title="view user" class="btn-success btn " data-method="view" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fa fa-eye"></i></a>
                  <a href="{{url('dashboard/users/edit/'.$users->id)}}" title="edit users" class="btn btn-bg" data-method="Edit" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fa fa-pencil"></i></a>
                  <a href="{{url('dashboard/users/delete/'.$users->id)}}" onclick="return confirm('Are you sure?')" title="delete user" class=" btn-danger btn" data-method="DELETE" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection