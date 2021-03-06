<a data-toggle="modal" href="#modal-delete-{{ $data->id }}">
  删除
</a>
<div id="modal-delete-{{ $data->id }}" class="modal text-left fade">
  <div class="modal-dialog">
    <div class="modal-content">
      {{ Form::open(['method' => 'DELETE', 'route' => ["admin.$name.destroy", $data->id]])}}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">删除数据</h4>
      </div>
      <div class="modal-body">
        <p>
            @if(!empty($message))
                {{ $message }}
            @else
            确认删除这个数据?
            @endif
        </p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">是的</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
      {{ Form::close() }}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->