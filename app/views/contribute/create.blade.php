@extends('admin::layouts.master')

@section('content')

    <h4 class="page-header">
        投稿
        &middot;
        <small> <a href="javascript:window.history.go(-1)">返回</a> </small>
    </h4>
    <div class="well col-lg-10 center-block">
        @include('contribute.form')
    </div>
@stop