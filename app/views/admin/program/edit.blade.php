@extends('admin::layouts.master')

@section('content')

    <h4 class="page-header">
        编辑节目
        &middot;
        <small> <a href="javascript:window.history.go(-1)">返回</a> </small>
    </h4>
    <div class="well col-lg-10 center-block">
        @include('admin::program.form', array('model' => $program))
    </div>
@stop