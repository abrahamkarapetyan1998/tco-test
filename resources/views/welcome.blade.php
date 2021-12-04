@extends('layouts.app')

@section('content')
<h1 class="text-center">Categories</h1>
<div class="container">
    <div class="row">

        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 85%">Name</th>
                <th scope="col">Actions</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)

                <tr>
                  <td>{{$category->id}}</th>
                  <td>{{$category->name}}</td>
                  <td>
                    <a href="{{route('category.show', $category->slug)}}" class="btn btn-primary">View Products</a>
                  </td>

                </tr>
                @endforeach

            </tbody>
          </table>
    </div>
</div>
@endsection
