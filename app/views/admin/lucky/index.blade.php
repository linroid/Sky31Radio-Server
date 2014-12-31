@extends('admin::layouts.master', ['active'=>'lucky'])
@section('content')
    <h4 class="page-header">
		幸运用户
	</h4>
    <table class="table table-responsive">
        <thead>
            <th>编号</th>
            <th>姓名</th>
            <th>学校</th>
            <th>院系</th>
            <th>手机号码</th>
            <th>兑换码</th>
        </thead>
        <tbody>
            @foreach ($luckys as $visitor)
            <tr>
                {{--<td>{{ link_to_route('admin.program.show', $program->id, $program->id) }}</td>--}}
                <td>{{ $visitor->id }}</td>
                <td>{{ $visitor->name }}</td>
                <td>{{ $visitor->school }}</td>
                <td>{{ $visitor->info }}</td>
                <td>{{ $visitor->phone }}</td>
                <td>{{ $visitor->lucky_key }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center">
        {{ $luckys->links() }}
    </div>
@endsection