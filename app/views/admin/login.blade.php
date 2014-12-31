@extends('admin.layouts.master')

@section('content')
<div style="margin-top: 100px;"></div>
    <div class="col-md-4 col-md-offset-4">
     	{{ Form::open(['url'=>admin('login')]) }}
            <legend>
                登录后台
            </legend>
            <div class="form-group">
                {{ Form::label('email', 'Email:') }}
                {{ Form::text('email', null, ['class' => 'form-control']) }}
                {{ $errors->first('email', '<div class="text-danger">:message</div>') }}
            </div>
            <div class="form-group">
                {{ Form::label('password', 'Password:') }}
                {{ Form::password('password', ['class' => 'form-control']) }}
                {{ $errors->first('password', '<div class="text-danger">:message</div>') }}
            </div>
            <div class="form-group">
                {{ Form::submit('登录', ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close()}}
    </div>
@endsection