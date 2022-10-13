@extends('admin.layouts.app')
@section('content')
<div class="dash-home-cards">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="ProfileHader d-flex flex-wrap align-items-center">
            <h3 class="font_600 font-18 font-md-20 mr-auto pr-20">Manage database backup files </h3>
            <a class="btn btn-bg" href="{{ url('/backup/create') }}">
              <i class="fa fa-plus mr-1"></i>Create Backup
            </a>
          </div>

        </div>
        <div class="card-body table-responsive">
          <table id="ThemeTable" class="table table-bordered projects">
            <thead>
              <tr>
                <th>Serial</th>
                <th>Name</th>
                <th>size</th>
                <th class="actions">extension</th>
                <th>Date&Time of Creation</th>
                <th colspan="3px">Action</th>
              </tr>
            </thead>
            @php $serial=1 @endphp
            <tbody>
              @foreach($names as $file)
              <tr>
                <td>{{$serial++}}</td>
                <td>{{$file['filename']}}</td>
                <td>{{$file['filesize']}}</td>
                <td>{{$file['ext']}}</td>
                <td>{{date("F d Y H:i:s.", $file['time'])}}</td>

                <td><a href="{{url('backup/download/'.$file['filename'])}}" title="download" class="btn btn-bg" data-method="Download" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fa fa-download"></i></a>
                  <a href="{{url('backup/restore/'.$file['filename'])}}" onclick="return confirm('Are you sure?')" title="restore" class="btn btn-bg" data-method="restore" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fas fa-sync"></i></a>
                  <a href="{{url('backup/delete/'.$file['filename'])}}" onclick="return confirm('Are you sure?')" title="delete" class=" btn-danger btn" data-method="DELETE" data-trigger-confirm="1" data-pjax-target="#user-grid"><i class="fa fa-trash"></i></a></td>

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