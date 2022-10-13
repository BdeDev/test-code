@extends('admin.layouts.app')

@section('template_title')
    {{ $page->title ?? 'Show Page' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class=" font_600 font-18 font-md-20 mr-auto pr-20">Show Page</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-bg" href="{{ route('page') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $page->title }}
                        </div>
                         <div class="form-group">
                            <strong>Description:</strong>
                            {{ $page->description }}
                        </div>
                        <div class="form-group">
                            <strong>Type:</strong>
                            {{ $page->getType() }}
                        </div>
                    

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
