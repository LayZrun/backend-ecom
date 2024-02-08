<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<div class="d-flex justify-content-center">
  <nav class="navbar navbar-light bg-light">
  <a href="{{ route('products.show') }}" class="btn btn-primary">showAll</a>
  <a href="{{ route('products.create') }}" class="btn btn-primary">createnew</a>
  </nav>
  </div>
    <div class="container">
        <h3>edit book</h3>
        <form action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" method="POST">
            @csrf 
            <div class="form-group mb-2">
               <input type="text" class="form-control" name="title" placeholder="title" value="{{$product->title}}">
             @error('title')
             <span class="text-danger"> {{ $message}}</span>
             @enderror
            </div>
            <div class="form-group mb-2">
                <!-- <input type="text" class="form-control" name="category" placeholder="category" value="{{$product->category}}"> -->
                <select class="form-select" aria-label="Default select example" name="category" value="{{old('title')}}">
                    <option selected>Open this select menu</option>
                    <option value="MEN">MEN</option>
                    <option value="WOMEN">WOMEN</option>
                    <option value="KIDS">KIDS</option>
                    <option value="ACCESSORIES">ACCESSORIES</option>
                    <option value="WATCH">WATCH</option>
                    <option value="SHOES">SHOES</option>
                </select>

                @error('category')
                <span class="text-danger"> {{ $message}}</span>
                @enderror
            </div>
            <div class="form-group mb-2">
                <input type="number" class="form-control" name="price" placeholder="($)price in US" value="{{$product->price}}">
                @error('price')
                <span class="text-danger"> {{ $message}}</span>
                @enderror
            </div>
            <div class="form-group mb-2">
                <textarea cclass="form-control" name="description" cols="30" rows="10" placeholder="description....">{{$product->description}}</textarea>
                @error('description')
                <span class="text-danger"> {{ $message}}</span>
                @enderror
            </div>
            <div class="form-group mb-2">
                <!-- <label for="image" class="form-control">Select an image:</label> -->
                <input type="file"  class="form-control" name="image" id="image">
                
                @error('image')
                <span class="text-danger"> {{ $message}}</span>
                @enderror
                
            </div>
            <div class="form-group mb-2">
                <img src="{{ asset("uplaods/" . $product-> image) }} " width="200px" alt="">
            </div>
            <div class="form-group mb-2">
                <button type="summit" class="btn btn-primary">Update</button>
                
            </div>
        </form>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>