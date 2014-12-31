@if(isset($model))
    {{ Form::open(['method' => 'PUT', 'files' => true, 'route' => ['admin.album.update', $model->id], 'class'=>'form-horizontal']) }}
@else
    {{ Form::open(['method' => 'POST', 'files' => true, 'route' => ['admin.album.store'], 'class'=>'form-horizontal']) }}
@endif
<fieldset>
    <div class="form-group has-{{ option('style') }}">
        {{ Form::label('type', '分类:', ['class'=>'col-lg-2 control-label']) }}
        <div class="col-sm-3">
            <select class="form-control" id="type" name="type">
                <option value="season" @if(isset($model) && $model->type=='season') selected @endif>四季节目</option>
                <option value="activity" @if(isset($model) && $model->type=='activity') selected @endif>专题活动</option>
            </select>
        </div>
    </div>
    <div class="form-group has-{{ option('style') }}">
        {{ Form::label('name', '名称:', ['class'=>'col-lg-2 control-label']) }}
        <div class="col-lg-5">
            {{ Form::text('name', isset($model) ? $model->name : '', ['class' => 'form-control']) }}
            <span class="material-input"></span>
            {{ $errors->first('name', '<div class="text-danger">:message</div>') }}
        </div>
    </div>
 <div class="form-group has-{{ option('style') }}">
        {{ Form::label('cover', '封面图:', ['class'=>'col-lg-2 control-label']) }}
        <div class="col-lg-3">
            <div class="form-control-wrapper fileinput {{ isset($model)&&!empty($model->cover) ? 'hidden':''}}">
                <input type="text" readonly="" class="form-control empty"/>
                <input type="file" name="cover" id="audioFile" multiple="" class=""/>
                <div class="floating-label">选择图片...</div><span class="material-input"></span>
                <span class="material-input"></span>
            </div>
            @if(isset($model) && !empty($model->cover))
            <div class="input-group" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">取消</span></button>
                <img src="{{ $model->cover }}" class="img-thumbnail"/>
            </div>
            @endif
            {{ $errors->first('cover', '<div class="text-danger">:message</div>') }}
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