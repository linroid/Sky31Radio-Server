@extends('admin.layouts.master', ['active'=>'home'])

@section('content')
<h3>你好，{{ Auth::user()->nickname }}</h3>
<hr/>
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-{{ option('style') }}">
			<div class="panel-heading">
				<i class="mdi-action-trending-up"></i> 统计
			</div>
			<table class="table">
				<tr>
					<td>节目</td>
					<td>{{ Program::count() }}</td>
				</tr>
				{{--<tr>--}}
				    {{--<td>评论</td>--}}
				    {{--<td>123</td>--}}
				{{--</tr>--}}
				<tr>
                    <td>管理员</td>
                    <td>{{ User::administrators()->count() }}</td>
                </tr>
                <tr>
                    <td>主播</td>
                    <td>{{ User::anchors()->count() }}</td>
                </tr>
                <tr>
                    <td>普通用户</td>
                    <td>{{ User::normals()->count() }}</td>
                </tr>

			</table>
		</div>

	</div>
	<div class="col-md-4">
        <div class="panel panel-{{ option('style') }}">
            <div class="panel-heading">
                <i class="mdi-image-wb-sunny"></i> 四季节目
            </div>
            <table class="table">
                @foreach(Album::seasons()->get() as $album)
                <tr>
                    <td>{{$album->name}}</td>
                    <td>{{$album->programs->count()}}</td>
                </tr>
                @endforeach
            </table>
        </div>

    </div>
    <div class="col-md-3">
            <div class="panel panel-{{ option('style') }}">
                <div class="panel-heading">
                    <i class="mdi-social-people-outline"></i> 专题活动
                </div>
                <table class="table">
                     @foreach(Album::activities()->get() as $album)
                    <tr>
                        <td>{{$album->name}}</td>
                        <td>{{$album->programs->count()}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>

        </div>
@endsection
