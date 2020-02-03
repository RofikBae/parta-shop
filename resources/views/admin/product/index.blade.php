@extends('admin.templates.default')

@section('content')
@include('admin.templates.partials._alert')
<h1>Product</h1>
<table class="table">
  <a href="{{ route('product.create') }}" class="btn btn-primary">Add Product</a>
    <thead class="thead-dark">
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">Slug</th>
        <th scope="col">Description</th>
        <th scope="col">Category</th>
        <th scope="col">Price</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @php
          $no = 1;
          $page = request()->has('page') ? $request->page : 1;
          $perPage = config('app.paginate');
          $no = $perpage * ($page - 1) + 1;
      @endphp
      @foreach ($products as $product)
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          <td><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#{{$product->slug}}"><i class="fa fa-image"></i></button></td>
          <td>{{$product->name}}</td>
          <td>{{$product->slug}}</td>
          <td>{{$product->description}}</td>
          <td>
            @foreach ($product->categories as $category)
                <span class="label label-primary">{{$category->name}}</span>
            @endforeach  
          </td>
          <td>{{$product->price}}</td>
          <td>
              <a href="{{ route('product.edit',$product) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
              <button id="delete" data-name="{{$product->name}}" href="{{ route('product.destroy',$product) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
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
    {{ $products->render('vendor.pagination.adminlte') }}
  </tfoot>

  @foreach ($products as $product)    
    <!-- Modal -->
    <div class="modal fade" id="{{$product->slug}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Product Image</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <img src="{{$product->getImage()}}" class="img-fluid" style="width: 570px" alt="No image yet">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  @endforeach

@endsection

@push('script')
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    $('button#delete').on('click', function(){
      var href = $(this).attr('href');
      var name = $(this).data('name');

      swal({
          title: "Are you sure to delete "+name+" product?",
          text: "You won't be able to revert this!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            document.getElementById('deleteForm').action=href;
            document.getElementById('deleteForm').submit();
            swal(name+" has been deleted!", {
              icon: "success",
            });
          } 
        });
    });

    $(".alert").fadeTo(2000, 200).slideUp(500, function(){
      $(".alert").slideUp(500);
    });
  </script>
@endpush