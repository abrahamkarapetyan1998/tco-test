@extends('layouts.app')

@section('content')
    <h1 class="text-center">My Products</h1>

    <div class="container">
        <div class="row">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" >Name</th>
                        <th scope="col">Category</th>
                        <th scope="col" style="width: 20%">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{$product->id}}</th>
                        <td>{{$product->category->name ?? ''}}</td>
                        <td>{{$product->name}}</td>
                          <td class="d-flex justify-content-around">
                            <a href="{{route('products.show', $product->id)}}" class="btn btn-primary ">Show</a>

                                <a href="{{route('products.edit', $product->id)}}" class="btn btn-success">Edit</a>
                                <form method="POST" action="{{route('products.destroy', $product->id)}}" >
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-icon btn-danger show_confirm">Delete</button>
                                </form>

                          </td>

                        </tr>
                        @endforeach

                    </tbody>
                  </table>
            </div>
        </div>
@endsection
