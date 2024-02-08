<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="d-flex justify-content-center">
  <nav class="navbar navbar-light bg-light">
  <a href="{{ route('products.show') }}" class="btn btn-primary">showAll</a>
  <a href="{{ route('products.create') }}" class="btn btn-primary">createnew</a>
  </nav>
  </div>

    <div class="container">
            <h3>create book</h3>
            <form action="{{ route('products.store') }}" enctype="multipart/form-data" method="POST">
            
                {{ csrf_field()}}
                <div class="form-group mb-2">
                <input type="text" class="form-control" name="title" placeholder="title" value="{{old('title')}}">
                @error('title')
                <span class="text-danger"> {{ $message}}</span>
                @enderror
                </div>
                <div class="form-group mb-2">
                    <select class="form-select" aria-label="Default select example" name="category">
                        <option value="MEN" {{ old('category') == 'MEN' ? 'selected' : '' }}>MEN</option>
                        <option value="WOMEN" {{ old('category') == 'WOMEN' ? 'selected' : '' }}>WOMEN</option>
                        <option value="KIDS" {{ old('category') == 'KIDS' ? 'selected' : '' }}>KIDS</option>
                        <option value="ACCESSORIES" {{ old('category') == 'ACCESSORIES' ? 'selected' : '' }}>ACCESSORIES</option>
                        <option value="WATCH" {{ old('category') == 'WATCH' ? 'selected' : '' }}>WATCH</option>
                        <option value="SHOES" {{ old('category') == 'SHOES' ? 'selected' : '' }}>SHOES</option>
                    </select>
                    @error('category')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <input type="number" class="form-control" name="price" placeholder="($)price in US" value="{{ old('price') }}">
                    @error('price')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <textarea class="form-control" name="description" cols="30" rows="10" placeholder="description...."></textarea>
                </div>
                <div class="form-group mb-2">
                    <input type="file"  class="form-control" name="image" id="image">
                    @error('image')
                    <span class="text-danger"> {{ $message}}</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <button type="summit" class="btn btn-primary">Add product</button>
                </div>
        </form>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>