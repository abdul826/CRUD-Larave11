<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Laravel 11 CRUD</title>
  </head>
  <body>

    <nav class="py-3 bg-dark">
        <h3 class="text-center text-white">Simple CRUD Operation</h3>
    </nav>

    <div class="container">
          <div class="row justify-content-center mt-4">
            <div class="col-md-8 d-flex justify-content-end">
                <a class="btn btn-primary" href="{{route('product.index')}}">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-white bg-dark">Edit Product</h5>
                      </div>
                    <div class="card-body">
                        <form action="{{route('product.update', $product->id)}}" method = "POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                              <label for="name" class="form-label">Name</label>
                              <input value="{{old('name', $product->name)}}" type="text" class="@error('name') is-invalid @enderror form-control" id="name" aria-describedby="emailHelp" name="name">
                            </div>
                            @error('name')
                            <p class="invalid-feedback">{{$message}}</p>
                            @enderror

                            <div class="mb-3">
                              <label for="sku" class="form-label">Sku</label>
                              <input value="{{old('sku',$product->sku)}}" type="text" class="@error('sku') is-invalid @enderror form-control" id="sku" name="sku">
                            </div>
                            @error('sku')
                            <p class="invalid-feedback">{{$message}}</p>
                            @enderror

                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input value="{{old('price',$product->price)}}" type="text" class="@error('price') is-invalid @enderror form-control" id="price" name="price">
                            </div>
                            @error('price')
                            <p class="invalid-feedback">{{$message}}</p>
                            @enderror

                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" rows="3" name="description">{{old('description',$product->description)}}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                @if ($product->image != '')
                                    <img class="mt-2 w-50" src="{{asset('uploads/products/'.$product->image)}}" alt="Image">
                                @endif
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            
                          </form>
                    </div>
                  </div>
            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>