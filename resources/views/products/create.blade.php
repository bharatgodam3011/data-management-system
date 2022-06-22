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
                    <li class="breadcrumb-item active">Create</li>
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
                            Create New Product
                        </h3>
                    </div>
                    <div class="card-body">
                        @if (count($errors) > 0)
                          <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                               @foreach ($errors->all() as $error)
                                 <li>{{ $error }}</li>
                               @endforeach
                            </ul>
                          </div>
                        @endif                        

                        {!! Form::open(array('route' => 'products.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}

                        <div class="form-group">
                            <label for="name">Name</label>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>

                        <div class="form-group">
                            <label for="email">Category</label>
                            {!! Form::select('category', $categories,'', array('class' => 'form-control')) !!}
                        </div>


                        <div class="form-group">
                            <label for="email">Description</label>
                            {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control')) !!}
                        </div>

                        <div class="form-group">
                            <label for="email">Image</label>
                            {!! Form::file('image') !!}
                        </div>

                        <div class="form-group">
                            <label for="email">Price</label>
                            {!! Form::number('price', null, array('placeholder' => 'Price','class' => 'form-control')) !!}
                        </div>                        

                        

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </div>    

                        {!! Form::close() !!}

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