@extends('admin.layouts.app')

@section('template_title')
Page
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title" class="font_600 font-18 font-md-20 mr-auto pr-20">
                            {{ __('Page') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('add_page') }}" class="btn btn-bg btn-sm float-right" data-placement="left">
                                {{ __('Create New') }}
                            </a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="datatable">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th class="actions">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pages as $key=>$page)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $page->title }}</td>
                                    <td>{{ $page->description }}</td>
                                    <td>{{ $page->getType() }}</td>
                                    <td class="actions">
                                        <form action="{{ route('page.destroy') }}" method="POST" onsubmit='return confirm("are you sure ?")'>
                                            <a class="btn-success btn" href="{{ route('page.show',$page->id) }}"><i class="fa fa-fw fa-eye"></i> </a>
                                            <a class="btn btn-bg" href="{{ route('page.edit',$page->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{$page->id}}">
                                            <button type="submit" class=" btn-danger btn btn-sm"><i class="fa fa-fw fa-trash"></i> </button>
                                        </form>
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
</div>
@endsection


@push('styles')
<!-- Data Table CSS -->
<link rel="stylesheet" href="{{asset('public/dataTables/dataTables.min.css')}}">
@endpush
@push('scripts')
<!-- Data Table Script -->
<script src="{{asset('public/dataTables/dataTables.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endpush