@extends('admin.layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Add</h2>
        </div>
        <div class="card-body">

    <form method="post" action="{{url('/dashboard/users/adds')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Name:</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}"> 
            {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
        </div>

        <div class="form-group">
          <label >Role</label>
            <select name="role" class="form-control">
            <option>Choose your role</option>
            <option value="0">Admin</option>
            <option value="1">User</option>
          </select>
          {!!$errors->first("role", "<span class='text-danger'>:message</span>")!!}
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
            {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
        </div>

        <div class="form-group">
            <label>Password:</label>
            <input type="password" class="form-control" name="password">
            {!!$errors->first("password", "<span class='text-danger'>:message</span>")!!}
        </div>
         <div class="form-group">
            <label>Profile Photo:</label>
            <input type="file" class="form-control" name="image">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-bg" name="submit" value="submit">
        </div>
    </form>
</div>
</div>
@endsection