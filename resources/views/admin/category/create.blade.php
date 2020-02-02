@extends('admin.templates.default')

@section('content')
  <div class="col-md-6 col-md-offset-3">
    <div class="box box-info">
      <div class="box-header with-border">
        <div class="box-title">Add a category</div>
      </div>

      <form action="{{ route('category.store') }}" method="post">
        @csrf
        <div class="box-body">
          <div class="form-group row {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input name="name" type="text" class="form-control form-control-sm" value="{{ old('name') }}" placeholder="Name">
              @if ($errors->has('name'))
                  <p class="help-block">
                    {{$errors->first('name')}}
                  </p>
              @endif
            </div>
          </div>

          <div class="form-group row {{ $errors->has('description') ? 'has-error' : ''}}">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
              <input name="description" type="text" class="form-control form-control-sm" value="{{ old('description') }}" placeholder="Description">
              @if ($errors->has('description'))
                <p class="help-block">
                  {{$errors->first('description')}}
                </p>
              @endif
            </div>
          </div>
        </div>

        <div class="box-footer">
          <a href=" {{route('category.index')}} " class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right">Save</button>
        </div>
      </form>
    </div>
  </div>
@endsection