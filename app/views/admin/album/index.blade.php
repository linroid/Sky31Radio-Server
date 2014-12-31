@extends('admin::layouts.master')
@section('content')
    <h4 class="page-header">
		{{ Input::has('type') ? (Input::get('type')=='season'?'四季节目':'活动专题'):'全部专题' }} ({{ $albums->getTotal() }})
		&middot;
		<small>{{ link_to_route('admin.album.create', '添加专题') }}</small>
	</h4>
    <table class="table table-responsive">
        <thead>
            <th>编号</th>
            <th>名称</th>
            <th>类型</th>
            <th>创建时间</th>
            <th class="text-center">操作</th>
        </thead>
        <tbody>
            @foreach($albums as $album)
            <tr>
            <td>{{ $album->id }}</td>
            <td>{{ $album->name }}</td>
            <td>{{ $album->type=='season'?'四季节目':'专题活动'}}</td>
            <td>{{ $album->created_at}}</td>
                <td class="text-center">
                    <a href="{{ route('admin.album.show', $album->id) }}">所有节目</a>
                    @if(Auth::user()->is('admin'))
                    &middot;
                    <a href="{{ route('admin.album.edit', $album->id) }}">编辑</a>
                    &middot;
                    @include('admin::partials.modal', ['data' => $album, 'name' => 'album'])
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center">
        {{ $albums->links() }}
    </div>
@endsection