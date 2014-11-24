@extends('admin::layouts.master')
@section('content')
    <h4 class="page-header">
		{{$album->name}} ({{ $programs->getTotal() }})
		&middot;
		<small>{{ link_to_route('admin.program.create', '添加节目') }}</small>
	</h4>
    <table class="table table-responsive">
        <thead>
            <th>编号</th>
            <th>标题</th>
            <th>播放量</th>
            <th>作者</th>
            <th>创建用户</th>
            <th>节目稿?</th>
            <th>创建时间</th>
            <th class="text-center">操作</th>
        </thead>
        <tbody>
            @foreach ($programs as $program)
            <tr>
                {{--<td>{{ link_to_route('admin.program.show', $program->id, $program->id) }}</td>--}}
                <td>{{ $program->id }}</td>
                <td>{{ $program->title }}</td>
                <td>待统计</td>
                <td>{{ $program->author }}</td>
                <td>{{ $program->user->nickname }}</td>
                <td>{{ empty($program->article) ? '没有' : '有'}}</td>
                <td>{{ $program->created_at }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.program.edit', $program->id) }}">编辑</a>
                    &middot;
                    @include('admin::partials.modal', ['data' => $program, 'name' => 'program'])
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center">
        {{ $programs->links() }}
    </div>
@endsection