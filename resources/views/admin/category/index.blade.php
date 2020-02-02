@extends('admin.templates.default')

@section('content')
@include('admin.templates.partials._alert')
<h1>Category</h1>
<table class="table">
  <a href="{{ route('category.create') }}" class="btn btn-primary">Add Category</a>
    <thead class="thead-dark">
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Name</th>
        <th scope="col">Slug</th>
        <th scope="col">Description</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($categories as $category)
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>{{$category->name}}</td>
          <td>{{$category->slug}}</td>
          <td>{{$category->description}}</td>
          <td>
              <a href="{{ route('category.edit',$category) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
              <button id="delete" data-name="{{$category->name}}" href="{{ route('category.destroy',$category) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
          </td>
        </tr>
        @endforeach
      <form action="" method="post" id="deleteForm">
        @csrf
        @method('delete')
        <input type="submit" value="" style="display:none">
      </form>
    </tbody>
  </table>
  <tfoot class="box-footer">
    {{ $categories->render('vendor.pagination.adminlte') }}
  </tfoot>
@endsection

@push('script')
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    $('button#delete').on('click', function(){
      var href = $(this).attr('href');
      var name = $(this).data('name');

      swal({
          title: "Are you sure to delete "+name+" category?",
          text: "You won't be able to revert this!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            document.getElementById('deleteForm').action=href;
            document.getElementById('deleteForm').submit();
            swal("Poof! Your imaginary file has been deleted!", {
              icon: "success",
            });
          } 
        });
    });

    $(".alert").fadeTo(2000, 500).slideUp(500, function(){
      $(".alert").slideUp(500);
    });
  </script>
@endpush