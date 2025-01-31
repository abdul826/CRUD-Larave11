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
                <a class="btn btn-primary" href="{{route('product.create')}}">Create</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))
            <div id="success-message" class="col-md-10 alert alert-success">
                {{Session::get('success')}}
            </div>
            @endif
            <div class="col-md-8 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-white bg-dark">List Product</h5>
                      </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Sku</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if ($products->isNotEmpty())
                                @foreach ($products as $product)

                                    <tr>
                                        <th scope="row">{{$product->id}}</th>
                                        <td>
                                            @if ($product->image != '')
                                            
                                                <img width="50" src="{{asset('uploads/products/'.$product->image)}}" alt="Image">
                                            @endif
                                        </td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->sku}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>
                                            <a href="{{route('product.edit', $product->id)}}" class="btn btn-primary">Edit</a>
                                            <a href="#" onclick="deleteProduct({{$product->id}});" class="btn btn-danger">Delete</a>

                                            <form id="delete-product-from-{{$product->id}}" action="{{route('product.destroy', $product->id)}}" method = "POST">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                    
                                @endforeach
                                    
                                @endif
                              
                            </tbody>
                          </table>
                    </div>
                  </div>
            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>

<script>
    function deleteProduct(id){
        
        if(confirm("Are you sure to delete the product ?")){
            document.getElementById('delete-product-from-' + id).submit();
        }
    }

     // Check if success message exists
     window.onload = function() {
        var successMessage = document.getElementById('success-message');
        
        if (successMessage) {
            // Hide the success message after 3 seconds (3000 milliseconds)
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 3000);
        }
    };
</script>