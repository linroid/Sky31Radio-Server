@extends('admin::layouts.master', ['active'=>'user'])

@section('content')

    <h4 class="page-header">
        编辑专题
        &middot;
        <small> <a href="javascript:window.history.go(-1)">返回</a> </small>
    </h4>
    <div class="well col-lg-6">
        @include('admin::user.form', ['model'=>$user])
    </div>
@stop