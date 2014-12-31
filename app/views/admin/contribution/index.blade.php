@extends('admin::layouts.master', ['active'=>'contribution'])
@section('content')
    <h4 class="page-header">
		投稿管理 ({{ $contributions->getTotal() }})
	</h4>
    <table class="table table-responsive">
        <thead>
            <th>编号</th>
            <th>标题</th>
            <th>姓名</th>
            <th>联系方式</th>
            <th>节目稿?</th>
            <th>状态</th>
            <th>创建时间</th>
            <th class="text-center">操作</th>
        </thead>
        <tbody>
            @foreach ($contributions as $contribution)
            <tr>
                {{--<td>{{ link_to_route('admin.program.show', $program->id, $program->id) }}</td>--}}
                <td>{{ $contribution->id }}</td>
                <td>{{ $contribution->program->title }}</td>
                <td>{{ $contribution->program->author }}</td>
                <td>{{ $contribution->contact }}</td>
                <td>{{ empty($contribution->program->article) ? '没有' : '有'}}</td>
                <td>{{ empty($contribution->passed_at) ? '未通过':'已通过' }}</td>
                <td>{{ $contribution->created_at }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.program.edit', $contribution->program->id) }}">编辑&通过</a>
                    &middot;
                    @include('admin::partials.modal', ['data' => $contribution, 'name' => 'contribution'])
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center">
        {{ $contributions->links() }}
    </div>
@endsection