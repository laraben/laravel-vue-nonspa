@extends('core.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('Users Management')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row mb-3">
    <div class="col-md-10 offset-1">
        <h2 class="float-left">{{ count($users) }} @lang('Users')</h2>
        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addUserModal">@lang('+ Add User')</button>
    </div>
</div>
<div class="row">
    <div class="col-md-10 offset-1">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fas fa-check"></i> {{ $message }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td style="width: 4.16%">{{ $user->id }}</td>
                            <td style="width: 31.26%">{{ $user->name }}</td>
                            <td style="width: 31.26%">{{ $user->email }}</td>
                            <td style="width: 16.66%">{{ $user->getRoleNames()->first() }}</td>
                            <td style="width: 16.66%">
                                <a class="btn btn-info btn-sm" href="{{ route('users.edit', ['user' => $user->id])}}">
                                    <i class="fas fa-pencil-alt"></i>
                                    Edit
                                </a>
                                {!! Form::open(['route' => ['users.destroy',$user->id], 'method'=>'Delete' , 'style'=>'display:inline-block']) !!}
                                    <button type="submit" class="btn btn-danger btn-sm" onsubmit="confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel">
    <div class="modal-dialog" role="document">
        {!! Form::open(['method' => 'post']) !!}

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="roleModalLabel">@lang('Add User')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <!-- name Form Input -->
                <div class="form-group @if ($errors->has('name')) is-invalid @endif">
                    {!! Form::label('name', trans('Name')) !!}
                    {!! Form::text('name', null, [
                        'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control',
                        'placeholder' =>  trans('Name')
                        ]) !!}
                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                </div>
                <div class="form-group @if ($errors->has('email')) is-invalid @endif">
                    {!! Form::label('name', trans('Email')) !!}
                    {!! Form::text('email', null, [
                        'class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control',
                        'placeholder' =>  trans('Email')
                        ]) !!}
                    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                </div>
                <div class="form-group @if ($errors->has('password')) is-invalid @endif">
                    {!! Form::label('name', trans('Password')) !!}
                    {!! Form::password('password',[
                        'class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control',
                        'placeholder' =>  trans('Password')
                        ]) !!}
                    @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                </div>
                <div class="form-group">
                    {!! Form::label('name', trans('Role')) !!}
                    {!! Form::select('role', $roles, null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                <!-- Submit Form Button -->
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
