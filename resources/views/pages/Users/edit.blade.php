@extends('core.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('User Management')</h1>
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
        <h2 class="float-left">@lang('Edit User')</h2>
        <a href="{{ route('users.index') }}" class="btn btn-primary float-right" >@lang('Back')</a>
    </div>
</div>

<div class="container">
    <div class="card py-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            {!! Form::open(['route' => ['users.update', $user->id], 'method' => 'put']) !!}
            <div class="form-group @if ($errors->has('name')) is-invalid @endif">
                {!! Form::label('name', trans('Name')) !!}
                {!! Form::text('name', $user->name, [
                    'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control',
                    'placeholder' =>  trans('Name')
                    ]) !!}
                @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
            </div>
            <div class="form-group @if ($errors->has('email')) is-invalid @endif">
                {!! Form::label('name', trans('Email')) !!}
                {!! Form::text('email', $user->email, [
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
                {!! Form::select('role', $roles, $userRole, ['class' => 'form-control']) !!}
            </div>
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
</div>
@endsection
