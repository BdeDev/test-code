@extends('admin.layouts.app')

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class=" font_600 font-18 font-md-20 mr-auto pr-20">Update Page </span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('page.update', $page->id) }}" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        @include('page::form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection