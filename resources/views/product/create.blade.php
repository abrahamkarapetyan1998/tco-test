@extends('layouts.app')

@section('content')
    <h1 class="text-center">Create Product</h1>
    <div class="container">
        <div class="row">
            <form method="POST" id="create-product" enctype="multipart/form-data" action="{{route('products.store')}}">
                @csrf
                <div class="form-group mt-2">
                  <label for="name">Name</label>
                  <input type="text" data-parsley-required data-parsley-maxlength="255"  class="form-control" id="name"  name="name" value="">
                  @error('name')
                    {{$message}}
                  @enderror
                </div>
                <div class="form-group mt-2">
                  <label for="category_select">Category</label>
                  <select class="form-control" data-parsley-required  data-parsley-type="number" id="category_select" name="category_id">
                    @foreach ($categories as $key => $category)
                        <option value="{{$key}}">{{$category}}</option>
                    @endforeach
                  </select>
                  @error('category_id')
                    {{$message}}
                  @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="image">Image</label>
                    <input type="file" value="" data-parsley-required data-parsley-filemaxmegabytes="4" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpg, image/png" id="image" class="form-control-file" name="image">
                    @error('image')
                        {{$message}}
                    @enderror
                </div>
                <div class="form-group mt-2">
                  <label for="description">Description</label>
                  <textarea class="form-control" data-parsley-required  name="description" id="description" rows="3"></textarea>
                  @error('description')
                    {{$message}}
                    @enderror
                </div>
                <button class="btn btn-success mt-3">Create</button>
              </form>
        </div>
    </div>

@endsection
@push('js')

<script>
    $('#create-product').parsley()

</script>

@endpush
