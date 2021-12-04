@extends('layouts.app')

@section('content')
    <h1 class="text-center">{{$product->name}}</h1>
    <div class="container">
        <div class="row">
            <div class="card mb-3">
                <img class="card-img"   src="{{asset('/storage/products/'.$product->image)}}" alt="Card image">
                 <div class="card-body">
                    <h5 class="card-title">{{$product->title}}</h5>
                    <p class="card-text"><b>Description:</b> {{$product->description}}</p>
                    <p class="card-text"><b>Category:</b> {{$product->category->name}}</p>
                    <p class="card-text"><b>Created At:</b> {{$product->created_at}}</p>
                </div>
              </div>
        </div>
    </div>
@endsection
