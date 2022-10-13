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
                    <form action="{{ url('dashboard/myprofile/update/'.$GetUser->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{$GetUser->name}}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">DOB</label>
                            <input type="date" name="dob" value="{{$GetUser->dob}}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Address</label>
                            <input type="text" name="address" value="{{$GetUser->address}}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Phone</label>
                            <input type="text" name="phone" value="{{$GetUser->phone}}" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>profile file:</label>
                          <input type="file" class="form-control" name="image">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-bg">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection