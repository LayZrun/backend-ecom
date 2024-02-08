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
<table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>title</th>
                    <th>category</th>
                    <th>price</th>
                    <th>description</th>
                    <th>image</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($products as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->category}}</td>
                    <td>${{$item->price}}</td>
                    <td>{{$item->description}}</td>
                    <td>
                        <img src="{{ asset("" .$item-> image) }} " width="100px" alt="">
                    </td>
                    <td>
                        <a href="{{ route ("products.edit", $item->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route ("products.delete", $item->id) }}" onclick="return confirm('Are you sure?')"  class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>


