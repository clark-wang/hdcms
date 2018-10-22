<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('org/Dashkit-1.1.2')}}/fonts/feather/feather.min.css">
{{--<link rel="stylesheet" href="{{asset('org/Dashkit-1.1.2')}}/libs/highlight/styles/vs2015.min.css">--}}
{{--<link rel="stylesheet" href="{{asset('org/Dashkit-1.1.2')}}/libs/quill/dist/quill.core.css">--}}
{{--<link rel="stylesheet" href="{{asset('org/Dashkit-1.1.2')}}/libs/select2/dist/css/select2.min.css">--}}
{{--<link rel="stylesheet" href="{{asset('org/Dashkit-1.1.2')}}/libs/flatpickr/dist/flatpickr.min.css">--}}
<!-- Theme CSS -->
    <!-- Values are "toggle", "light", and "dark". See "Getting Started" for more information -->
    <!-- Toggle Mode: For demo only, but allows a user to seamlessly toggle between light/dark modes -->
    <link href="{{asset('org/Dashkit-1.1.2')}}/css/theme-dark.min.css" rel="" data-toggle="theme"
          data-theme-mode="dark">
    <link href="{{asset('org/Dashkit-1.1.2')}}/css/theme.min.css" rel="" data-toggle="theme" data-theme-mode="light">
    <style>
        body {
            display: none;
        }
    </style>
    <script>
        var themeMode = (localStorage.getItem('dashkitThemeMode')) ? localStorage.getItem('dashkitThemeMode') : 'light';
        themeMode = 'light';
        var themeFile = document.querySelector('[data-toggle="theme"][data-theme-mode="' + themeMode + '"]');
        themeFile.rel = 'stylesheet';
        // Enable body content
        themeFile.addEventListener('load', function () {
            document.body.style.display = 'block';
        });
    </script>
    @include('layouts._hdjs')
    @include('layouts._message')
    <title>{{system_config('site.webname')}}</title>
    @stack('css')
</head>
<body>
@include('member.layouts._header')
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-block text-center pt-5">
                    <div class="avatar avatar-xxl">
                        <img src="{{auth()->user()->icon}}" class="avatar-img rounded-circle">
                    </div>
                    <div class="text-center mt-4">
                        <h3 class="text-secondary">{{auth()->user()->name}}</h3>
                    </div>
                </div>
                <div class="card-body text-center pt-1 pb-2">
                    <div class="nav flex-column nav-pills ">
                        <a href="{{route('member.user.edit',[auth()->user(),'type'=>'icon'])}}"
                           class="nav-link {{active_class(if_query('type','icon'),'active','text-muted')}}">
                            头像设置
                        </a>
                        <a href="{{route('member.user.edit',[auth()->user(),'type'=>'info'])}}"
                           class="nav-link {{active_class(if_query('type','info'),'active','text-muted')}}">
                            个人信息
                        </a>
                        <a href="{{route('member.user.edit',[auth()->user(),'type'=>'password'])}}"
                           class="nav-link {{active_class(if_query('type','password'),'active','text-muted')}}">
                            修改密码
                        </a>
                    </div>
                </div>
                <hr>
                <div class="card-body text-center pt-1">
                    <div class="nav flex-column nav-pills ">
                        <a href="{{route('member.fans',auth()->user())}}"
                           class="nav-link {{active_class(if_route('member.fans'),'active','text-muted')}}">
                            粉丝列表
                        </a>
                        <a href="{{route('member.follower',auth()->user())}}"
                           class="nav-link {{active_class(if_route('member.follower'),'active','text-muted')}}">
                            关注列表
                        </a>
                        <a href="{{route('member.notification.index',auth()->user())}}"
                           class="nav-link {{active_class(if_route('member.notification.index'),'active','text-muted')}}">
                            消息中心
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            @yield('content')
        </div>
    </div>
</div>
<script>
    require(['hdjs', 'bootstrap']);
</script>
@stack('js')
</body>
</html>