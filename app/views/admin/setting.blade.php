@extends('admin.layouts.master', ['active'=>'setting'])
@section('content')
    <h4 class="page-header">
        系统设置
	</h4>
	<div class="well col-lg-6">
    {{ Form::open(['method' => 'PUT', 'files' => true, 'route' => ['admin.update'], 'class'=>'form-horizontal']) }}
        <fieldset>
            <div class="form-group has-{{ option('style') }}">
                {{ Form::label('site_title', '站点名称:', ['class'=>'col-lg-2 control-label']) }}
                <div class="col-lg-5">
                    {{ Form::text('site_title', option('site_title'), ['class' => 'form-control']) }}
                    <span class="material-input"></span>
                    {{ $errors->first('site_title', '<div class="text-danger">:message</div>') }}
                </div>
            </div>
            <div class="form-group has-{{ option('style') }}">
                {{ Form::label('style', '主题颜色:', ['class'=>'col-lg-2 control-label']) }}
                <div class="col-sm-3">
                    <select class="form-control" id="style" name="style">
                        <option class="text-success"  value="success" @if(option('style')=='success') selected @endif>绿色</option>
                        <option class="text-primary" value="primary" @if(option('style')=='primary') selected @endif>深蓝色</option>
                        <option class="text-danger" value="danger" @if(option('style')=='danger') selected @endif>红色</option>
                        <option class="text-warning" value="warning" @if(option('style')=='warning') selected @endif>橙色</option>
                        <option class="text-info" value="info" @if(option('style')=='info') selected @endif>天蓝色</option>
                        <option class="text-black" value="black" @if(option('style')=='black') selected @endif>黑色</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-8 col-lg-offset-4">
                    <button class="btn btn-lg btn-default withripple" onclick="window.history.go(-1)">取消<div class="ripple-wrapper"></div></button>
                    {{ Form::submit('保存', ['class' => 'btn btn-lg btn-'.option('style')]) }}
                </div>
            </div>
        </fieldset>
    {{ Form::close() }}
	</div>
@endsection