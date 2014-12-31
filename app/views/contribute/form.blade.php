{{ Form::open(['method' => 'POST', 'files' => true, 'url'=>'/contribute', 'class'=>'form-horizontal']) }}
<fieldset>
    <div class="form-group has-{{ option('style') }}">
        {{ Form::label('title', '节目名称:', ['class'=>'col-lg-2 control-label']) }}
        <div class="col-lg-5">
            {{ Form::text('title', '', ['class' => 'form-control']) }}
            <span class="material-input"></span>
            {{ $errors->first('title', '<div class="text-danger">:message</div>') }}
        </div>
    </div>
    <div class="form-group has-{{ option('style') }}">
            {{ Form::label('author', '姓名:', ['class'=>'col-lg-2 control-label']) }}
            <div class="col-lg-2">
                {{ Form::text('author', '', ['class' => 'form-control']) }}
                <span class="material-input"></span>
                {{ $errors->first('author', '<div class="text-danger">:message</div>') }}
            </div>
        </div>
    <div class="form-group has-{{ option('style') }}">
                {{ Form::label('contact', '联系方式:', ['class'=>'col-lg-2 control-label']) }}
                <div class="col-lg-2">
                    {{ Form::text('contact', '', ['class' => 'form-control']) }}
                    <span class="material-input"></span>
                    {{ $errors->first('author', '<div class="text-danger">:message</div>') }}
                </div>
            </div>
    <div class="form-group has-{{ option('style') }}">
        {{ Form::label('type', '分类:', ['class'=>'col-lg-2 control-label']) }}
        <div class="col-sm-2">
            <select class="form-control" id="type" name="type">
                <option value="season" @if(isset($model) && $model->album->type=='season') selected @endif>四季节目</option>
                <option value="activity" @if(isset($model) && $model->album->type=='activity') selected @endif>活动专栏</option>
            </select>
        </div>
        <div class="col-sm-3">
            <select class="form-control" name="album_id">
                @foreach(isset($model) ? $albums[$model->album->type] : $albums['season'] as $album)
                <option value="{{ $album['id'] }}" @if(isset($model) && $model->album_id==$album['id']) selected @endif>{{ $album['name'] }}</option>
                @endforeach
            </select>
            <span class="material-input"></span>
            {{ $errors->first('album_id', '<div class="text-danger">:message</div>') }}
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
    <div class="form-group has-{{ option('style') }}">
        {{ Form::label('audio', '声音:', ['class'=>'col-lg-2 control-label']) }}
        <div class="col-lg-3">
            <div class="form-control-wrapper fileinput {{ isset($model)&&!empty($model->audio->src) ? 'hidden':''}}">
                <input type="text" readonly="" class="form-control empty"/>
                <input type="file" name="audio" id="audioFile" multiple="" class=""/>
                <div class="floating-label">选择音频...</div><span class="material-input"></span>
                <span class="material-input"></span>
            </div>
            @if(isset($model) && !empty($model->audio->src))
            <div class="input-group" role="alert">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span><span class="sr-only">取消</span>
                </button>
                <audio controls>
                  <source src="{{ $model->audio->url }}" type="audio/mpeg">
                  您的浏览器版本太低，不支持预览音频
                </audio>
            </div>
            @endif
            {{ $errors->first('audio', '<div class="text-danger">:message</div>') }}
        </div>

    </div>

    <div class="form-group has-{{ option('style') }}">
        {{ Form::label('article', '节目稿:', ['class'=>'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::textarea('article', isset($model) ? $model->article : '', ['class' => 'form-control', 'id' => 'umeditor', 'style'=>'height:300px;']) }}
        </div>
        {{ $errors->first('article', '<div class="text-danger">:message</div>') }}
    </div>
    <div class="form-group">
        <div class="col-lg-8 col-lg-offset-4">
            <button class="btn btn-lg btn-default withripple" onclick="window.history.go(-1)">取消<div class="ripple-wrapper"></div></button>
            {{ Form::submit('投稿', ['class' => 'btn btn-lg btn-'.option('style')]) }}
        </div>
    </div>
</fieldset>
{{ Form::close() }}
@section('style')
{{ HTML::style('umeditor/themes/default/css/umeditor.css') }}
@endsection
@section('script')
{{ HTML::script('umeditor/umeditor.config.js') }}
{{ HTML::script('umeditor/umeditor.min.js') }}
{{ HTML::script('umeditor/lang/zh-cn/zh-cn.js') }}
<script type="application/javascript">
    //实例化编辑器
    var um = UM.getEditor('umeditor',{
    });

    var albums = {{ json_encode($albums) }};
    $('select[name=type]').change(function(){
        var type = $(this).val();
        var html = '';
        $('select[name=album_id]').empty();
        $.each(albums[type], function(i, album){
            console.log(album);
            html += '<option value="'+album.id+'">'+album.name+'</option>';
        });
        $('select[name=album_id]').html(html);

    })
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
@endsection