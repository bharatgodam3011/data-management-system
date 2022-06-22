@extends('layouts.app')
@section('content-header')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Products</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection
@section('main-content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">

                <div class="card">
                    <div class="card-header">
                        <h3 >
                            View Product
                        </h3>
                    </div>
                    <div class="card-body">
                        <div  class="form-group">
                            <h3> <strong>Product Name :</strong> {{ $product->name }} </h3>
                        </div> 

                        <div class="form-group"> 
                            <img src="{{asset('images/'.$product->image)}}" class="img img-thumbnail" height="200px" width="200px">
                        </div> 

                        <p>
                            <strong>Product Description : </strong> {{ $product->description }}
                        </p>

                        <p>
                            <strong>Product Category : </strong> {{ $product->category->name }}
                        </p> 

                        <p>
                            <strong>Product Price : </strong> {{ $product->price }}
                        </p> 

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
@endpush

@push('scripts')

@endpush