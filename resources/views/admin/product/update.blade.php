@extends('admin.templates.default')

@section('content')
  <div class="col-md-6 col-md-offset-3">
    <div class="box box-info">
      <div class="box-header with-border">
        <div class="box-title">Edit product</div>
      </div> 

      <form action="{{ route('product.update',$product) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="box-body">
          <div class="form-group row {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input name="name" type="text" class="form-control form-control-sm" value="{{ old('name') ?? $product->name }}" placeholder="">
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
              <textarea name="description" id="" rows="5" class="form-control" value="">{{ old('description') ?? $product->description }}</textarea>
              @if ($errors->has('description'))
                <p class="help-block">
                  {{$errors->first('description')}}
                </p>
              @endif
            </div>
          </div>

          <div class="form-group row {{ $errors->has('price') ? 'has-error' : ''}}">
            <label for="price" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
              <input name="price" type="text" class="form-control form-control-sm" value="{{ old('price') ?? $product->price }}" placeholder="">
              @if ($errors->has('price'))
                  <p class="help-block">
                    {{$errors->first('price')}}
                  </p>
              @endif
            </div>
          </div>

          <div class="form-group row {{ $errors->has('category') ? 'has-error' : ''}}">
            <label for="category" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">
              <select name="category[]" id="" class="select2 form-control" multiple="multiple">
                @foreach ($categories as $category)
                  <option value="{{$category->id}}"
                    @if ($product->categories->contains($category))
                        selected
                    @endif
                    >{{$category->name}}
                  </option>
                @endforeach
              </select>
              @if ($errors->has('category'))
                  <p class="help-block">
                    {{$errors->first('category')}}
                  </p>
              @endif
            </div>
          </div>
       
          <div class="form-group row {{ $errors->has('image') ? 'has-error' : ''}}">
            <label for="image" class="col-sm-2 col-form-label">Image</label>
            <div class="col-sm-10">
              <input name="image" type="file" class="form-control form-control-sm" value="{{ old('image') }}" placeholder="">
              @if ($errors->has('image'))
                  <p class="help-block">
                    {{$errors->first('image')}}
                  </p>
              @endif
            </div>
          </div>
       
        </div>
        <div class="box-footer">
          <a href=" {{route('product.index')}} " class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right">Save</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('select2style')
    <link rel="stylesheet" href="{{asset('lte\bower_components\select2\dist\css\select2.min.css')}}">
@endpush

@push('script')
    <script src="{{asset('lte\bower_components\select2\dist\js\select2.full.min.js')}}"></script>
    <script>
      $(function(){
        $('.select2').select2()
      });
    </script>
@endpush
