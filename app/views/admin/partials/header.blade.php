<?php
    $active = isset($active) ? $active : '';
    $is_active = function ($name) use($active){
        if($active == $name){
            return 'active';
        }else{
            return '';
        }
    };
?>
<div class="navbar navbar-{{ option('style') }}">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('admin.home') }}">{{ option('site_title') }}后台管理</a>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav">
            <li class=" {{ $is_active('home') }}"><a href="{{ route('admin.home') }}">首页</a></li>

            <li class="dropdown {{ $is_active('season') }}">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">四季节目 <b class="caret"></b></a>
                <ul class="dropdown-menu dropdown-menu-{{ option('style') }}">
                    @foreach(Album::seasons()->get() as $album)
                    <li><a href="{{ admin('album/'.$album->id) }}">{{ $album->name }}</a></li>
                    @endforeach
                    @if(Auth::user()->is('admin'))
                    <li class="divider"></li>
                    {{--<li class="dropdown-header">管理</li>--}}
                    <li><a href="{{ admin('album') }}?type=season">管理</a></li>
                    @endif

                </ul>
            </li>
            <li class="dropdown  {{ $is_active('activity') }}">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">专题活动 <b class="caret"></b></a>
                <ul class="dropdown-menu dropdown-menu-{{ option('style') }}">
                    @foreach(Album::activities()->get() as $album)
                        <li><a href="{{ admin('album/'.$album->id) }}">{{ $album->name }}</a></li>
                    @endforeach
                    @if(Auth::user()->is('admin'))
                    <li class="divider"></li>
                    {{--<li class="dropdown-header">Dropdown header</li>--}}
                    <li><a href="{{ admin('album') }}?type=activity">管理</a></li>
                    @endif
                </ul>
            </li>
            {{--<li class=" {{ $is_active('comment') }}">--}}
                {{--<a href="{{ route('admin.comment') }}">评论管理 <span class="badge">12</span></a>--}}
            {{--</li>--}}
            @if( Auth::user()->is('admin') )
                <li class=" {{ $is_active('lucky') }}">{{ link_to_route('admin.lucky.index', '中奖幸运儿') }}</li>
                <li class=" {{ $is_active('contribution') }}">{{ link_to_route('admin.contribution.index', '投稿管理') }}</li>
                <li class=" {{ $is_active('user') }}">{{ link_to_route('admin.user.index', '用户管理') }}</li>
                <li class=" {{ $is_active('setting') }}"><a href="{{ admin('setting') }}">站点设置</a></li>
            @endif
            <li><a href="{{ url() }}">电台首页</a></li>
        </ul>
        {{--<form class="navbar-form navbar-left">--}}
            {{--<input type="text" class="form-control col-lg-8" placeholder="Search">--}}
        {{--</form>--}}
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"> {{ Auth::user()->nickname }} <b class="caret"></b></a>
                <ul class="dropdown-menu dropdown-menu-{{ option('style') }}">
                    <li>{{ link_to_route('admin.user.edit', '资料设置', Auth::id()) }}</li>
                    <li class="divider"></li>
                    <li><a href="{{ admin('logout') }}">退出</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>