@if(isset($model))
    {{ Form::open(['method' => 'PUT', 'files' => true, 'route' => ['admin.user.update', $model->id], 'class'=>'form-horizontal']) }}
@else
    {{ Form::open(['method' => 'POST', 'files' => true, 'route' => ['admin.user.store'], 'class'=>'form-horizontal']) }}
@endif
<fieldset>
    <div class="form-group has-{{ option('style') }}">
        {{ Form::label('avatar', '头像:', ['class'=>'col-lg-2 control-label']) }}
        <div class="col-lg-3">
            <div class="form-control-wrapper fileinput {{ isset($model)&&!empty($model->avatar) ? 'hidden':''}}">
                <input type="text" readonly="" class="form-control empty"/>
                <input type="file" name="avatar" id="audioFile" multiple="" class=""/>
                <div class="floating-label">选择图片...</div><span class="material-input"></span>
                <span class="material-input"></span>
            </div>
            @if(isset($model) && !empty($model->avatar))
            <div class="input-group" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">取消</span></button>
                <img src="{{ $model->avatar }}" class="img-thumbnail"/>
            </div>
            @endif
            {{ $errors->first('avatar', '<div class="text-danger">:message</div>') }}
        </div>
    </div>
    <div class="form-group has-{{ option('style') }}">
        {{ Form::label('nickname', '昵称:', ['class'=>'col-lg-2 control-label']) }}
        <div class="col-lg-5">
            {{ Form::text('nickname', isset($model) ? $model->nickname : '', ['class' => 'form-control']) }}
            <span class="material-input"></span>
            {{ $errors->first('nickname', '<div class="text-danger">:message</div>') }}
        </div>
    </div>
    <div class="form-group has-{{ option('style') }}">
        {{ Form::label('role', '身份:', ['class'=>'col-lg-2 control-label']) }}
        <div class="col-sm-3">
            <select class="form-control" id="role" name="role">
                <option value="admin" @if(isset($model) && $model->role=='admin') selected @endif>管理员</option>
                <option value="anchor" @if(isset($model) && $model->role=='anchor') selected @endif>主播</option>
                <option value="normal" @if(isset($model) && $model->role=='normal') selected @endif>普通用户</option>
            </select>
        </div>
    </div>
    <div class="form-group has-{{ option('style') }}">
        {{ Form::label('name', 'Email:', ['class'=>'col-lg-2 control-label']) }}
        <div class="col-lg-5">
            {{ Form::text('email', isset($model) ? $model->email : '', ['class' => 'form-control']) }}
            <span class="material-input"></span>
            {{ $errors->first('email', '<div class="text-danger">:message</div>') }}
        </div>
    </div>

    <div class="form-group has-{{ option('style') }}">
        {{ Form::label('password', '密码:', ['class'=>'col-lg-2 control-label']) }}
        <div class="col-lg-5">
            {{ Form::password('password', null, ['class' => 'form-control']) }}
            <span class="material-input"></span>
            {{ $errors->first('password', '<div class="text-danger">:message</div>') }}
        </div>
    </div>
    <div class="form-group has-{{ option('style') }}">
            {{ Form::label('password_confirmation', '确认密码:', ['class'=>'col-lg-2 control-label']) }}
            <div class="col-lg-5">
                {{ Form::password('password_confirmation', null, ['class' => 'form-control']) }}
                <span class="material-input"></span>
                {{ $errors->first('password_confirmation', '<div class="text-danger">:message</div>') }}
            </div>
        </div>
    <div class="form-group">
        <div class="col-lg-8 col-lg-offset-4">
            <button class="btn btn-lg btn-default withripple" onclick="window.history.go(-1)">取消<div class="ripple-wrapper"></div></button>
            {{ Form::submit(isset($model) ? '更新' : '保存', ['class' => 'btn btn-lg btn-'.option('style')]) }}
        </div>
    </div>
</fieldset>
{{ Form::close() }}
<script type="text/javascript">
 @if(isset($model))
    $('.close').click(function(){
        var resultContainer = $(this).parent();
        var uploadContainer = resultContainer.parent().children("div:first-child");

        resultContainer.addClass('hidden');
        uploadContainer.removeClass('hidden');
        console.log(uploadContainer);
    })
    @endif
</script>