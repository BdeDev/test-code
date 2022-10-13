<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title" value="{{ isset($page) ? $page->title : '' }}" >
            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description" rows="6" >{{ isset($page) ? $page->description : '' }}</textarea>
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label>type</label>
            <select class="form-control mt-3" name="type_id" id="type_id">
                <option value="">Select type</option>
                @foreach(@$types as $key=>$type)
                <option value="{{ @$key }}" @if($page->type_id == $key) selected='selected' @endif >{{ @$type }}</option>
                @endforeach
            </select>
            {!! $errors->first('type_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-bg">Submit</button>
    </div>
</div>