@extends('admin::layouts.master', ['active'=>'user'])
@section('content')
    <h4 class="page-header">
        用户管理
		&middot;
		<small>{{ link_to_route('admin.user.create', '添加用户') }}</small>
	</h4>
    <table class="table table-responsive">
        <thead>
            <th>编号</th>
            <th>Email</th>
            <th>昵称</th>
            <th>身份</th>
            <th>创建时间</th>
            <th class="text-center">操作</th>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->nickname }}</td>
            <td>
                @if($user->role == 'admin') 管理员
                @elseif($user->role == 'anchor') 主播
                @elseif($user->role == 'normal') 普通用户
                @endif
            </td>
            <td>{{ $user->created_at}}</td>
                <td class="text-center">
                    <a href="{{ route('admin.user.edit', $user->id) }}">编辑</a>
                    &middot;
                    @include('admin::partials.modal', ['data' => $user, 'name' => 'user'])
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center">
        {{ $users->links() }}
    </div>
@endsection