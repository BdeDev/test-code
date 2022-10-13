@extends('admin.layouts.app')
@section('content')
<div class="dash-home-cards">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="ProfileHader d-flex flex-wrap align-items-center">
            <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Update</h3>
          </div>
        </div>
        <div class="card-body">
    <form method="post" action="{{url('dashboard/users/update/'.$GetData->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Name:</label>
            <input type="text" class="form-control" name="name" value="{{$GetData->name}}"> 
            {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
        </div>
        <div class="form-group">
            <label>DOB:</label>
            <input type="date" class="form-control" name="dob" value="{{$GetData->dob}}"> 
            {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
        </div>
        <div class="form-group">
            <label>Address:</label>
            <input type="text" class="form-control" name="address" value="{{$GetData->address}}"> 
            {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
        </div>
        <div class="form-group">
            <label>Phone:</label>
            <input type="text" class="form-control" name="phone" value="{{$GetData->phone}}"> 
            {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
        </div>
       

        <div class="form-group">
            <label>Email:</label>
            <input type="email" class="form-control" name="email" value="{{ $GetData->email }}" disabled>
            {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
        </div>

       
          <div class="form-group">
            <label>profile file:</label>
            <input type="file" class="form-control" name="image">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-bg" name="submit" value="submit">
        </div>
    </form>
</div>
</div>
</div>
</div>
</div>

@endsection