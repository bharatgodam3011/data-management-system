@extends('layouts.app')
@section('content-header')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Users</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/users">Users</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection
@section('main-content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">

                <div class="card">
                    <div class="card-header">
                        <h3 >
                            Create New User
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

                        {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}

                        <div class="form-group">
                            <label for="name">Name</label>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            {!! Form::text('email', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>

                        <div class="form-group">
                            <label for="email">Password</label>
                            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                        </div>

                        <div class="form-group">
                            <label for="email">Role</label>
                            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control')) !!}

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