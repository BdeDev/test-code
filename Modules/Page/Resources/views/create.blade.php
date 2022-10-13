@extends('admin.layouts.app')

@section('template_title')
    Create Page
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class=" font_600 font-18 font-md-20 mr-auto pr-20">Create Page</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('page::form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
