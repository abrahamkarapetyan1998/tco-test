@extends('layouts.app')

@section('content')
    <h1 class="text-center">Edit {{$product->name}}</h1>
    <div class="container">
        <div class="row">
            <form method="POST" id="edit-product" action="{{route('products.update', $product->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group mt-2">
                  <label for="name">Name</label>
                  <input type="text" data-parsley-required data-parsley-maxlength="255" class="form-control"  id="name" name="name" value="{{$product->name}}">
                @error('name')
                  {{$message}}
                @enderror
                </div>
                <div class="form-group mt-2">
                  <label for="category">Category</label>
                  <select class="form-control" id="category_select" data-parsley-required  data-parsley-type="number"  name="category_id">
                    @foreach ($categories as $key => $category)
                        <option value="{{$key}}">{{$category}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group mt-2">
                    <label for="image">Image</label>
                    <input type="file" data-parsley-filemaxmegabytes="4" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpg, image/png" value="{{asset('storage/products/'.$product->image)}}" class="form-control-file" id="image" name="image">
                  </div>
                  @error('image')
                  {{$message}}
                  @enderror
                <div class="form-group mt-2">
                  <label for="description">Description</label>
                  <textarea class="form-control" data-parsley-required id="description" rows="3">{{$product->description}}</textarea>
                  @error('description')
                  {{$message}}
                @enderror
                </div>

                <input type="submit" class="btn btn-success mt-3" value="Edit">
              </form>
        </div>
    </div>
    @endsection
    @push('js')

        <script>
            $('#edit-product').parsley()

        </script>
    @endpush


